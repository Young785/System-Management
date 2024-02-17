<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ManagersController extends Controller
{
    public function index() {
        $data['managers'] = User::where("role", "admin")->get();

        return view('admin/managers', $data);
    }
    
    public function create() {
        $request = request();

        $data = Validator::make($request->all(), [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "email|string",
            "role" => "string",
            "password" => "string",
        ]);
        
        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }
        
        if(auth()->user()->role == "superadmin") {
            $userData = $request->except('_token');
            $userData["secret_code"] = "MS".rand(1000, 500000);
            
            try {
                User::create($userData);
                return response()->json(['message' => "Admin added Successfully", "success" => true], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), "success" => false], 400);
            }
        }else{
            return response()->json(['message' => "You don't have enough access for this action.", "success" => false], 400);
        }
    }
    
    public function update() {
        $request = request();
        Validator::extend('users', function ($attribute, $value, $parameters, $validator) {
            return \App\Models\User::where('email', $value)->doesntExist();
        });

        $data = Validator::make($request->all(), [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "email|string"
        ]);
        
        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }


        if($request->password && auth()->user()->role == "superadmin") {
            $request['password'] = Hash::make($request->password);
            $userData = $request->except('_token');
        }else{
            $userData = $request->except('_token', 'password');
        }

        try {
            User::where("secret_code", $request->secret_code)->update($userData);
            return response()->json(['message' => "Admin Profile updated Successfully", "success" => true], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), "success" => false], 400);
        }
    }
    
    public function delete(Request $r, $sec_code) {
        if(auth()->user()->role == "superadmin") {
            try {
                User::where("secret_code", $sec_code)->delete();
                return redirect()->back()->with(['success' => "Admin deleted Successfully"]);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()]);
            }
        }else{
                return redirect()->back()->with(['error' => "You don't have enough access for this action."]);
        }
    }
}
