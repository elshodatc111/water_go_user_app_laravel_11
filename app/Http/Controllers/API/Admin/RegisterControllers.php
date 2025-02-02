<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;

class RegisterControllers extends BaseController{

    public function login(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            if($user->type!='admin'){
                return $this->sendError('Unauthorised.', ['error'=>'Sizga kirishga ruxsat mavjud emas']);
            }
            $success['name'] =  $user->name;
            $success['phone'] =  $user->phone;
            $success['type'] =  $user->type;
            $success['token'] =  $user->createToken('Admin')->plainTextToken; 
            return $this->sendResponse($success, 'User successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Login yoki parol xato']);
        } 
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => ['required'],
            'name' => ['required'],
            'phone' => ['required', 'unique:users,phone', 'regex:/^\+998\d{9}$/'],
            'type' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required'],
        ], [
            'phone.regex' => 'Telefon raqami +998XXXXXXXXX formatida bo‘lishi kerak.',
            'email.unique' => 'Email oldin ro\'yxatga olingan.',
        ]);
        
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());    
        }
        if(Company::find($request->company_id)){
            if(Auth::user()->type=='admin'){
                $input['company_id'] = $request->company_id;
                $input['name'] = $request->name; 
                $input['phone'] = $request->phone;
                $input['type'] = $request->type;
                $input['email'] = $request->email;
                $input['password'] = bcrypt($request->password);
                $user = User::create($input);
                return $this->sendResponse($user, 'Yangi foydalanuvchi ro\'yhatga olindi');
            }else{
                return $this->sendError('Unauthorised.', ['error'=>'Sizga bu amalyotni bajarishga ruxsat berilmagan']);
            }
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Siz tanlagan kompaniya topilmadi']);
        }

        
    }

    public function emploes($company_id){
        $Company = Company::find($company_id);
        if($Company){
            $success['company'] =  $Company;
            $success['users'] =  User::where('company_id',$company_id)->where('type','!=','admin')->get(); 
            return $this->sendResponse($success, 'Company All User successfully.');
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Kompaniya topilmadi']);
        }
    }

    public function emploes_user($user_id){
        $user = User::find($user_id);
        if($user){
            $success['user'] =  User::find($user_id); 
            return $this->sendResponse($success, 'Company All User successfully.');
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Foydalanuvhi topilmadi']);
        }
    }




}
