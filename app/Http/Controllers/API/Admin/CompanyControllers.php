<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Company;

class CompanyControllers extends BaseController{

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'image' => 'required|mimes:jpg,png|max:2048',
            'discription' => 'required',
            'work_time' => 'required',
            'price' => 'required',
            'tarif' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            if (!file_exists(public_path('image/banner'))) {
                mkdir(public_path('image/banner'), 0777, true);
            }
            $image->move(public_path('image/banner'), $imageName);
            $imagePath = 'image/banner/' . $imageName;

            $Company = Company::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'image' => $imagePath,
                'discription' => $request->discription,
                'work_time' => $request->work_time,
                'status' => 'true',
                'balans' => 0,
                'price' => $request->price,
                'tarif' => $request->tarif,
                'star_count' => 0,
                'star' => 5,
            ]);
            $success['company'] =  $Company;
            return $this->sendResponse($success, 'Create Company successfully.');
        }
        return $this->sendError('Unauthorised.', ['error'=>'Rasm topilmadi']);
    }
    
}

