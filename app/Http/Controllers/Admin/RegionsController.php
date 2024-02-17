<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionsController extends Controller
{
    public function index() {
        if(auth()->user()->role === "superadmin"){
            $data['regions'] = Region::orderBy("created_at", "desc")->get();
        } else {
            $data['regions'] = Region::orderBy("created_at", "desc")->where("user_id", auth()->user()->secret_code)->get();
        }

        return view('admin/regions', $data);
    }
    
    public function create() {
        $request = request();

        $data = Validator::make($request->all(), [
            "name" => "required|string",
            "status" => "required|string",
        ]);

        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }
        
        if(auth()->user()->role == "superadmin") {
            $regionData = $request->except('_token');
            $regionData["code"] = "RG".rand(1000, 500000);
            $regionData["user_id"] = auth()->user()->secret_code;
            
            try {
                Region::create($regionData);
                return response()->json(['message' => "Region added Successfully", "success" => true], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), "success" => false], 400);
            }
        }else{
            return response()->json(['message' => "You don't have enough access for this action.", "success" => false], 400);
        }
    }
    
    public function update(Request $req, $code) {
        $request = request();
        Validator::extend('users', function ($attribute, $value, $parameters, $validator) {
            return \App\Models\Region::where('email', $value)->doesntExist();
        });

        $data = Validator::make($request->all(), [
            "name" => "required|string",
            "status" => "required|string",
        ]);
        
        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }

        if(Region::where("code", $code)->first() === false) {
            return response()->json(['message' => "Region not found.", "status" => false], 400);
        }

         if(auth()->user()->role == "superadmin") {
            $regionData = $request->except('_token');
            $regionData["user_id"] = auth()->user()->secret_code;
            
            try {
                Region::where("code", $code)->update($regionData);
                return response()->json(['message' => "Region updated Successfully", "success" => true], 200);
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
                Region::where("code", $sec_code)->delete();
                return redirect()->back()->with(['success' => "Region deleted Successfully"]);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()]);
            }
        }else{
                return redirect()->back()->with(['error' => "You don't have enough access for this action."]);
        }
    }
}
