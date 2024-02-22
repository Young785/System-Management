<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index() {
        $data['user'] = User::where("secret_code", auth()->user()->secret_code)->first();
        return view('admin/profile', $data);
    }
    public function update() {
        $request = request();
        Validator::extend('users', function ($attribute, $value, $parameters, $validator) {
            return \App\Models\Member::where('email', $value)->doesntExist();
        });

        $data = Validator::make($request->all(), [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|string",
        ]);
        
        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }
        if(User::where("secret_code", auth()->user()->secret_code)->first() === false) {
            return response()->json(['message' => "User not found.", "status" => false], 400);
        }

        // if(request()->hasFile("user_image")) {
        //     $image = request()->passport;
        //     $destinationPath = public_path('users');
        //     $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $image->getMimeType());
        //     $image->move($destinationPath, $fileName);
        //     $documentNames = 'users/'.$fileName;
        //     $userData["passport"] = $documentNames;
        // }
        if($request->password) {
            $data = Validator::make($request->all(), [
                "password" => "required|string|confirmed",
            ]);
            
            if($data->fails()){
                return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
            }
            $userData = $request->except('_token', 'password_confirmation');
            $userData['password'] = Hash::make($request->password);
        }else{
            $userData = $request->except('_token', 'password', 'password_confirmation');
        }

        if ($request->hasFile("user_image")) {
            $user_image = request()->user_image;
            $destinationPath = public_path('users');
            $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $user_image->getMimeType());
            $user_image->move($destinationPath, $fileName);
            $userData["user_image"] = $fileName;
        }
        try {
            User::where("secret_code", auth()->user()->secret_code)->update($userData);
            return response()->json(['message' => "Account updated Successfully", "success" => true], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), "success" => false], 400);
        }
    }
}
