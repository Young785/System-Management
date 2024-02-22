<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ZonesController extends Controller
{
    public function index() {
        $data['regions'] = Region::where("status", "active")->orderBy("created_at", "desc")->get();

        if(auth()->user()->role === "superadmin"){
            $data['zones'] = Zone::orderBy("created_at", "desc")->get();
        } else {
            $data['zones'] = Zone::orderBy("created_at", "desc")->where("user_id", auth()->user()->secret_code)->get();
        }

        return view('admin/zones', $data);
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
            $regionData["code"] = "ZE".rand(1000, 500000);
            $regionData["user_id"] = auth()->user()->secret_code;
            $regionData["region_id"] = $request->region_id;
            
            try {
                Zone::create($regionData);
                return response()->json(['message' => "Zone added Successfully", "success" => true], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), "success" => false], 400);
            }
        }else{
            return response()->json(['message' => "You don't have enough access for this action.", "success" => false], 400);
        }
    }
    
    public function update(Request $req, $code) {
        $request = request();

        $data = Validator::make($request->all(), [
            "name" => "required|string",
            "region" => "required|string",
            "status" => "required|string",
        ]);
        
        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }

        if(Zone::where("code", $code)->first() === false) {
            return response()->json(['message' => "Zone not found.", "status" => false], 400);
        }

         if(auth()->user()->role == "superadmin") {
            $region = $request;
            $regionData["region_id"] = $request->region;

            $regionData = $request->except('_token', 'region');
            $regionData["user_id"] = auth()->user()->secret_code;
            
            try {
                Zone::where("code", $code)->update($regionData);
                return response()->json(['message' => "Zone updated Successfully", "success" => true], 200);
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
                Zone::where("code", $sec_code)->delete();
                return redirect()->back()->with(['success' => "Zone deleted Successfully"]);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()]);
            }
        }else{
                return redirect()->back()->with(['error' => "You don't have enough access for this action."]);
        }
    }
}
