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
        $data['managers'] = User::where("role", "admin")->count();
        $data['members'] = Member::count();
        $data['regions'] = Region::count();
        $data['zones'] = Zone::count();
        return view('admin.dashboard', $data);
    }
}
