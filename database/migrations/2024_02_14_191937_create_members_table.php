<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("address");
            $table->string("code");
            $table->string("phone");
            $table->string("dob");
            $table->string("marital_status");
            $table->string("passport");
            $table->string("nin");
            $table->string("status");
            $table->string("zone_id");
            $table->string("manager_id");
            $table->string("secret_key");
            $table->timestamps();

            // $table->foreign('manager_id')->references('secret_code')->on('users');
            // $table->foreign('zone_id')->references('code')->on('zones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
