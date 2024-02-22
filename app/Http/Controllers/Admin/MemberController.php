<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MembersExport;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Region;
use App\Models\Zone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function index() {
        if(auth()->user()->role === "superadmin"){
            $data['members'] = Member::with(["zone"])->orderBy("created_at", "desc")->get();
        } else {
            $data['members'] = Member::with(["zone"])->orderBy("created_at", "desc")->where("manager_id", auth()->user()->secret_code)->get();
        }
        $data['regions'] = Region::where("status", "active")->orderBy("created_at", "desc")->get();
        // dd($data);
        
        return view('admin/members', $data);
    }
    public function getMembers(Request $request) {
         $searchQuery = $request->input('search.value');

        // Perform filtering based on search query

        try {
        $filteredData = Member::where('firstname', 'like', '%' . $searchQuery . '%')
        ->orWhere('lastname', 'like', '%' . $searchQuery . '%')
        ->orWhere('address', 'like', '%' . $searchQuery . '%')
        ->orWhere('code', 'like', '%' . $searchQuery . '%')
        ->orWhere('phone', 'like', '%' . $searchQuery . '%')
        ->orWhere('dob', 'like', '%' . $searchQuery . '%')
        ->orWhere('marital_status', 'like', '%' . $searchQuery . '%')
        ->orWhere('status', 'like', '%' . $searchQuery . '%')
            ->get();
                return response()->json(['message' => "Members generated successfully.", "data" => $filteredData, "status" => true], 200);
                } catch (\Exception $e) {
                return response()->json(['message' => $e, "status" => false], 403);
            }

        }
    public function export(Request $request, $type) {
        if ($type === 'csv') {
            return Excel::download(new MembersExport, 'Members Aefnigeria.csv');
        }else{
            $query = Member::select(
                '*',
                'zones.name as zone_name',
                'regions.name as region_name',
                DB::raw("DATE_FORMAT(members.created_at, '%d %M %Y') as created_at"), DB::raw("DATE_FORMAT(members.updated_at, '%d %M %Y') as updated_at")
            )
            ->join("zones", "zones.code", "members.zone_id")
            ->join("regions", "regions.code", "=", "zones.region_id");
            
            if(auth()->user()->role === 'superadmin'){
                $members = $query->get();
            } else {
                $members = $query
                ->where("members.manager_id", auth()->user()->secret_code)
                ->get();
            }
            // dd($members);
            
            $output='';
            $output .= implode(',', array_keys($members->first()->toArray())) . "\n";

            foreach ($members as $row) {
                $output.=  implode(",",$row->toArray());
            }
            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="Members Aefnigeria.xlsx"',
            );
            return Response::make(rtrim($output, "\n"), 200, $headers);
        }
    }
    
        public function zones(Request $req, $id) {
        try {
            $zones = Zone::where("status", "active")->where("region_id", $id)->orderBy("created_at", "desc")->get();
            return response()->json(['message' => "Zones generated.", "data" => $zones, "status" => true], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e, "status" => false], 403);
        }
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
            "zone_id" => "required|string",
        ]);

        if($data->fails()){
            return response()->json(['message' => $data->errors()->first(), "status" => false], 403);
        }
        
        if(auth()->user()->role == "superadmin" || auth()->user()->role == "admin") {
            $userData = $request->except('_token', 'region_id');
            $userData["code"] = "MSM".rand(1000, 500000);
            $userData["secret_key"] = "MSM".rand(1000, 500000);
            $userData["manager_id"] = auth()->user()->secret_code;


            $image = request()->passport;
            $destinationPath = public_path('members');
            $base64Image = str_replace('data:image/jpeg;base64,', '', $image);
            $imageData = base64_decode($base64Image);
            $filename = uniqid() . '.jpg';
            $filePath = public_path('members/' . $filename);
            file_put_contents($filePath, $imageData);
            $userData["passport"] = 'members/'.$filename;

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
    
    public function update(Request $request, $code) {
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

        if(Member::where("code", $code)->first() === false) {
            return response()->json(['message' => "Member not found.", "status" => false], 400);
        }

         if(auth()->user()->role == "superadmin" || auth()->user()->role == "admin") {
            $memberData = $request->except('_token', 'region_id');
            
            if(request()->hasFile("passport")) {
                $image = request()->passport;
                $destinationPath = public_path('members');
                $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $image->getMimeType());
                $image->move($destinationPath, $fileName);
                $documentNames = 'members/'.$fileName;
                $memberData["passport"] = $documentNames;
            }
            if(request()->hasFile("nin")) {
                $nin_image = request()->nin;
                $destinationPath = public_path('members');
                $fileName = Str::random(40).'.'.str_replace(["image/", "/"], "", $nin_image->getMimeType());
                $nin_image->move($destinationPath, $fileName);
                $documentNames = 'members/'.$fileName;
                $memberData["nin"] = $documentNames;
            }

            $memberData["manager_id"] = auth()->user()->secret_code;
            
            try {
                $memberData = $request->except('_token', 'region_id');
                Member::where("code", $code)->update($memberData);
                return response()->json(['message' => "Member updated Successfully", "success" => true], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), "success" => false], 400);
            }
            
        }else{
            return response()->json(['message' => "You don't have enough access for this action.", "success" => false], 400);
        }
    }
    
    public function delete(Request $r, $sec_code) {
        if(auth()->user()->role == "superadmin" || auth()->user()->role == "admin") {
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
