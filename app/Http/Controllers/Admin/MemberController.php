<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index() {
        if(auth()->user()->role === "superadmin"){
            $data['members'] = Member::orderBy("created_at", "desc")->get();
        } else {
            $data['members'] = Member::orderBy("created_at", "desc")->where("user_id", auth()->user()->secret_code)->get();
        }

        return view('admin/members', $data);
    }
    
    public function create() {
        $request = request();

        $data = Validator::make($request->all(), [
            "firstname" => "required|string",
            "lastname" => "required|string",
            "address" => "required|string",
            "phone" => "required|string",
            "marital_status" => "required|string",
            "passport" => "required",
            "nin" => "required",
            "status" => "required|string",
        ]);

        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }
        
        if(auth()->user()->role == "superadmin") {
            $userData = $request->except('_token');
            $userData["code"] = "MSM".rand(1000, 500000);
            $userData["secret_key"] = "MSM".rand(1000, 500000);
            $userData["manager_id"] = auth()->user()->secret_code;

            $image = request()->passport;
            $destinationPath = public_path('members');
            $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $image->getMimeType());
            $image->move($destinationPath, $fileName);
            $documentNames = 'members/'.$fileName;
            $userData["passport"] = $documentNames;

            $nin_image = request()->nin;
            $destinationPath = public_path('members');
            $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $nin_image->getMimeType());
            $nin_image->move($destinationPath, $fileName);
            $documentNames2 = 'members/'.$fileName;
            $userData["nin"] = $documentNames2;
            
            try {
                Member::create($userData);
                return response()->json(['message' => "Member added Successfully", "success" => true], 200);
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
            return \App\Models\Member::where('email', $value)->doesntExist();
        });

        $data = Validator::make($request->all(), [
            "firstname" => "required|string",
            "lastname" => "required|string",
            "address" => "required|string",
            "phone" => "required|string",
            "marital_status" => "required|string",
            "status" => "required|string",
        ]);
        
        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }

        if(Member::where("code", $request->code)->first() === false) {
            return response()->json(['message' => "Member not found.", "status" => false], 400);
        }

         if(auth()->user()->role == "superadmin") {
            $regionData = $request->except('_token');
            if(request()->hasFile("passport")) {
                $image = request()->passport;
                $destinationPath = public_path('members');
                $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $image->getMimeType());
                $image->move($destinationPath, $fileName);
                $documentNames = 'members/'.$fileName;
                $regionData["passport"] = $documentNames;
            }
            if(request()->hasFile("nin")) {
                $nin_image = request()->nin;
                $destinationPath = public_path('members');
                $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $nin_image->getMimeType());
                $nin_image->move($destinationPath, $fileName);
                $documentNames = 'members/'.$fileName;
                $regionData["nin"] = $documentNames;
            }

            $regionData["manager_id"] = auth()->user()->secret_code;
            
            try {
                Member::where("code", $request->code)->update($regionData);
                return response()->json(['message' => "Member updated Successfully", "success" => true], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), "success" => false], 400);
            }
            
        }else{
            return response()->json(['message' => "You don't have enough access for this action.", "success" => false], 400);
        }
    }
    
    public function delete(Request $r, $sec_code) {
        if(auth()->user()->role == "superadmin") {
            try {
                Member::where("secret_code", $sec_code)->delete();
                return redirect()->back()->with(['success' => "Member deleted Successfully"]);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()]);
            }
        }else{
                return redirect()->back()->with(['error' => "You don't have enough access for this action."]);
        }
    }
}
