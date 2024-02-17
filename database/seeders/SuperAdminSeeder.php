<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data['first_name'] = "Ariyo";
        $data['last_name'] = "Ayomikun";
        $data['secret_code'] = "MS52521";
        $data['email'] = "ayomikunariyo@gmail.com";
        $data['password'] = Hash::make("12345678");
        $data['role'] = "superadmin";
        $data['email_verified_at'] = NOW();
        
        User::create($data);
    }
}
