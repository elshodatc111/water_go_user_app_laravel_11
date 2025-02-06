<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\JsonResponse;

class RegisterControllers extends BaseController{

    public function login(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'mobile_token' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            if($user->type!='admin'){
                return $this->sendError('Unauthorised.', ['error'=>'Sizga kirishga ruxsat mavjud emas']);
            }
            if($user->status!=1){
                return $this->sendError('Unauthorised.', ['error'=>'Sizga bloklangansiz']);
            }
            $user->tokens()->delete();
            $token = $user->createToken('Admin')->plainTextToken;
            $user->mobile_token = $request->mobile_token;
            $user->save();
            $success = [
                'name' => $user->name,
                'phone' => $user->phone,
                'type' => $user->type,
                'token' => $token,
            ];
            return $this->sendResponse($success, 'User successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Login yoki parol xato']);
        } 
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'phone' => ['required', 'unique:users,phone', 'regex:/^\+998\d{9}$/'],
            'email' => ['required', 'unique:users,email'],
        ], [
            'phone.regex' => 'Telefon raqami +998XXXXXXXXX formatida bo‘lishi kerak.',
            'email.unique' => 'Email oldin ro\'yxatga olingan.',
        ]);        
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());    
        }
        $input['company_id'] = 1;
        $input['name'] = $request->name; 
        $input['phone'] = $request->phone;
        $input['email'] = $request->email;
        $input['password'] = bcrypt("12345678");
        $user = User::create($input);
        return $this->sendResponse($user, 'Yangi foydalanuvchi ro\'yhatga olindi');
    }

    public function updatePassword(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = $request->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->sendError('Error', ['error' => 'Joriy parol noto‘g‘ri']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return $this->sendResponse([], 'Parol muvaffaqiyatli yangilandi.');
    }
    

    public function logout(Request $request): JsonResponse{
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse([], 'Foydalanuvchi tizimdan muvaffaqiyatli chiqdi.');
    }



}
