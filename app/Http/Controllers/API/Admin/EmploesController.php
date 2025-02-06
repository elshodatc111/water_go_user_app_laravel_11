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

class EmploesController extends BaseController{
    public function emploes($id){
        $User = User::where('company_id',$id)->get();
        return $this->sendResponse($User, 'All emploes successfully.');
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => ['required'],
            'name' => ['required'],
            'type' => ['required'],
            'password' => ['required'],
            'phone' => ['required', 'unique:users,phone', 'regex:/^\+998\d{9}$/'],
            'email' => ['required', 'unique:users,email'],
        ], [
            'phone.regex' => 'Telefon raqami +998XXXXXXXXX formatida bo‘lishi kerak.',
            'email.unique' => 'Email oldin ro\'yxatga olingan.',
        ]);        
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());    
        }
        $Company = Company::find($request->company_id);
        if($Company){
            $input['company_id'] = $request->company_id;
            $input['name'] = $request->name; 
            $input['type'] = $request->type; 
            $input['phone'] = $request->phone;
            $input['email'] = $request->email;
            $input['password'] = bcrypt($request->password);
            $user = User::create($input);
            return $this->sendResponse($user, 'Yangi foydalanuvchi ro\'yhatga olindi');
        }else{
            return $this->sendError('Not fount company.');
        }
    }

}
