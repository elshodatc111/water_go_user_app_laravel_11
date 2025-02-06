<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Log;


class CompanyControllers extends BaseController{

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'image_url' => 'required|mimes:jpg,png|max:2048',
            'description' => 'required',
            'time' => 'required',
            'price' => 'required|numeric',
            'tarif' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            if (!file_exists(public_path('image/banner'))) {
                mkdir(public_path('image/banner'), 0777, true);
            }
            $image->move(public_path('image/banner'), $imageName);
            $imagePath = 'image/banner/' . $imageName;
            $Company = Company::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'image_url' => $imagePath,
                'description' => $request->description,
                'time' => $request->time,
                'price' => $request->price,
                'tarif' => $request->tarif,
                'balans' => 0,
                'reyting_count' => 0,
            ]);
            $success['company'] =  $Company;
            return $this->sendResponse($success, 'Create Company successfully.');
        }
        return $this->sendError('Unauthorised.', ['error'=>'Rasm topilmadi.']);
    }

    public function update_data(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'time' => 'required',
            'price' => 'required|numeric',
            'tarif' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $Company = Company::find($request->id);
        if($Company){
            $Company->name = $request->name;
            $Company->phone = $request->phone;
            $Company->description = $request->description;
            $Company->time = $request->time;
            $Company->price = $request->price;
            $Company->tarif = $request->tarif;
            $Company->save();
            $success['company'] =  $Company;
            return $this->sendResponse($success, 'Company update successfully.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

    public function update_image(Request $request){
        Log::info($request);
        

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'image_url' => 'required|mimes:jpg,png|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            if (!file_exists(public_path('image/banner'))) {
                mkdir(public_path('image/banner'), 0777, true);
            }
            $image->move(public_path('image/banner'), $imageName);
            $imagePath = 'image/banner/' . $imageName;

            $Company = Company::find($request->id);
            if($Company){
                $Company->image_url = $imagePath;
                $Company->save();
                $success['company'] =  $Company;
                return $this->sendResponse($success, 'Company Update successfully.');
            }else{
                return $this->sendError('Not fount company.');
            }
        }
        return $this->sendError('Unauthorised.', ['error'=>'Rasm topilmadi.']);
    }

    public function status($id){
        $Company = Company::find($id);
        if($Company){
            $success['status_admin'] =  $Company->status_admin;
            $success['status_drektor'] =  $Company->status_drektor;
            return $this->sendResponse($success, 'Company status.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

    public function status_update(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status_admin' => 'required',
            'status_drektor' => 'required',
        ]);
        $Company = Company::find($request->id);
        if($Company){
            $Company->status_admin = $request->status_admin ;
            $Company->status_drektor = $request->status_drektor ;
            $Company->save();
            $success['status_admin'] = (bool) $Company->status_admin;
            $success['status_drektor'] = (bool) $Company->status_drektor;
            return $this->sendResponse($success, 'Status update successfully.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

    public function company(){
        $Company = Company::select('id','name','image_url','price','status_admin','status_drektor')->get();
        $success['company'] =  $Company;
        return $this->sendResponse($success, 'Get all Company successfully.');
    }

    public function show($id){
        $Company = Company::find($id);
        if($Company){
            $success['company'] =  $Company;
            return $this->sendResponse($success, 'Company successfully.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }
    
}

