<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class CompanyController extends BaseController{
    public function companies(){
        $Company = Company::where('status_admin',true)->orderBy('reyting', 'desc')->select('id','name','time','price','image_url','reyting','reyting_count')->get();
        $success['company'] =  $Company;
        return $this->sendResponse($success, 'Get all Company successfully.');
    }

    public function company($id){
        $Company = Company::where('id',$id)->first();
        if($Company){
            $success['company'] =  $Company;
            return $this->sendResponse($success, 'Company successfully.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

    public function order_create(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'count'      => 'required|integer',
            'addres'     => 'required|string',
            'latuda'     => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $Company = Company::where('id',$request->company_id)->first();
        if($Company){
            $order = new Order();
            $order->company_id = $request->company_id;
            $order->user_id    = Auth()->user()->id;
            $order->count      = $request->count;
            $order->addres     = $request->addres;
            $order->latuda     = $request->latuda;
            $order->longitude  = $request->longitude;
            $order->status     = 'new';
            $order->create_time = Carbon::now()->format('Y-m-d H:i');
            $order->save();
            $success['order'] =  $order;
            return $this->sendResponse($success, 'Buyurtma qabul qilindi.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

    public function active_order(){
        $Order = Order::where('user_id',Auth()->user()->id)
            ->whereNotIn('status', ['success', 'cancel'])
            ->join('companies', 'orders.company_id', '=', 'companies.id')
            ->select('orders.id','companies.name','companies.price','orders.status','orders.count','orders.create_time','orders.pedding_time','orders.succes_time','orders.cancel_time')
            ->get();
        $success['order'] =  $Order;
        return $this->sendResponse($success, 'Barcha aktive buyurtmalar.');
    }

    public function end_order(){
        $Order = Order::where('user_id',Auth()->user()->id)
            ->whereNotIn('status', ['new', 'pedding'])
            ->join('companies', 'orders.company_id', '=', 'companies.id')
            ->select('orders.id','companies.name','companies.price','orders.status','orders.count','orders.create_time','orders.pedding_time','orders.succes_time','orders.cancel_time','orders.cancel_discription')
            ->get();
        $success['order'] =  $Order;
        return $this->sendResponse($success, 'Barcha yakunlangan buyurtmalar.');
    }
    
    public function order_show($id){
        $Order = Order::where('orders.id', $id)
        ->join('companies', 'orders.company_id', '=', 'companies.id')
        ->select(
            'companies.name as company',
            'companies.price',
            'orders.status',
            'orders.count',
            'orders.addres',
            'orders.create_time',
            'orders.pedding_time',
            'orders.succes_time',
            'orders.cancel_time',
            'orders.reyting_status',
            'orders.currer_id',
            'companies.phone'
        )->first();
        $Currer = User::find($Order->currer_id);
        $success['order'] =  $Order;
        $success['currer'] =  $Currer?$Currer->name:'null';
        return $this->sendResponse($success, 'Barcha yakunlangan buyurtmalar.');
    }

    public function order_cancel(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'cancel_discription' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $Order = Order::where('id',$request->id)->first();
        if($Order){
            $Order->status = 'cancel';
            $Order->cancel_time = Carbon::now()->format('Y-m-d H:i');
            $Order->status = 'cancel';
            $Order->cancel_discription = $request->cancel_discription;
            $Order->save();
            $success['order'] =  $Order;
            return $this->sendResponse($success, 'Buyurtma bekor qilindi.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

    public function order_comment(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'reyting_discription' => 'required|string',
            'reyting' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $Order = Order::where('id',$request->id)->first();
        if($Order){
            $Company = Company::find($Order->company_id);
            $reytings = (($Company->reyting * $Company->reyting_count) + $request->reyting) / ($Company->reyting_count + 1);
            $Company->reyting = floor($reytings * 10) / 10;;
            $Company->reyting_count = $Company->reyting_count + 1;
            $Company->save();
            
            $Order->reyting_status = true;
            $Order->reyting_discription = $request->reyting_discription;
            $Order->reyting = $request->reyting;
            $Order->save();
            $success['order'] =  $Order;
            return $this->sendResponse($success, 'Buyurtma baxolandi.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }



}
