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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string("code")->unique();
            $table->string("name");
            $table->string("region_id");
            $table->string("user_id");
            $table->enum("status", ['active', 'inactive'])->default("active");
            $table->timestamps();

            $table->foreign('user_id')->references('secret_code')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('region_id')->references('code')->on('regions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
};
