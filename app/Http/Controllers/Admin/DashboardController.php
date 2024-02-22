<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Region;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $managers = User::where("role", "admin");
        $members = Member::orderBy("created_at", "DESC");
        $regions = Region::orderBy("created_at", "DESC");
        $zones = Zone::orderBy("created_at", "DESC");
        if(auth()->user()->role === 'superadmin'){
            $data['managers'] = $managers->count();
            $data['members'] = $members->count();
            $data['regions'] = $regions->count();
            $data['zones'] = $zones->count();
        } else {
            $data['members'] = $members->where("manager_id", auth()->user()->secret_code)->count();
            $data['regions'] = $regions->count();
            $data['zones'] = $zones->count();
        }
        return view('admin.dashboard', $data);
    }
}
