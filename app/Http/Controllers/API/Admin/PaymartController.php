<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Company;
use App\Models\Paymart;
use Illuminate\Support\Facades\Log;

class PaymartController extends BaseController{

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $Company = Company::find($request->company_id);
        if($Company){
            $Company->balans = $Company->balans + $request->price;
            $Company->save();
            $Paymart = Paymart::create([
                'company_id' => $request->company_id,
                'price' => $request->price,
                'description' => $request->description,
            ]);
            $success['paymart'] =  $Paymart;
            return $this->sendResponse($success, 'Create Paymart successfully.');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

    public function paymart(){
        $Paymart = Paymart::join('companies', 'paymarts.company_id', '=', 'companies.id')->select('companies.name','paymarts.price','paymarts.description','paymarts.created_at')->get();
        $success['paymart'] =  $Paymart;
        return $this->sendResponse($success, 'all Paymart.');
    }

}
