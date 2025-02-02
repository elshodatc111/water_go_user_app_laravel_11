<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;


class RegisterController extends BaseController{

    public function phone(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^\+998\d{9}$/'],
        ], [
            'phone.regex' => 'Telefon raqami +998XXXXXXXXX formatida bo‘lishi kerak.',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());    
        }
        $code = 99999;
        $success['phone'] =  $request->phone;
        $success['code'] =  $code;
        $firstFour = substr($request->phone, 0, 4)."...".substr($request->phone, -3);
        $User = User::where('phone',$request->phone)->first();

        if($User){
            $User->password = $code;
            $User->save();
        }else{
            $input['phone'] =  $request->phone;
            $input['email'] =  'user'.time().'@gmail.com';
            $input['password'] = bcrypt($code);
            $user = User::create($input);
        }
        return $this->sendResponse($success, $firstFour.' telefon raqamga tasdiqlash kodi yuborildi tasdiqlash kodini kiriting.');
    }

    public function check(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'code' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if(Auth::attempt(['phone' => $request->phone, 'password' => $request->code])){ 
            $user = Auth::user(); 
            $user->password = 'test';
            $user->save();
            $success['token'] =  $user->createToken('Users')->plainTextToken; 
            $success['name'] =  $user->name;
            return $this->sendResponse($success, 'User successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Tasdiqlash kodi noto\'g\'ri']);
        } 
    }

    public function profile(){
        $user = Auth::user(); 
        $success['name'] =  $user->name;
        $success['phone'] =  $user->phone;
        return $this->sendResponse($success, 'User profile successfully.');
    }

    
}
