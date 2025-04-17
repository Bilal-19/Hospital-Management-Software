<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receptionist', function (Blueprint $table) {
            $table->id();
            $table->string("fullName");
            $table->string("emailAddress");
            $table->string("phoneNumber")->nullable();
            $table->string("gender")->nullable();
            $table->string("shiftTiming")->nullable();
            $table->string("department")->nullable();
            $table->date("joiningDate")->nullable();
            $table->timestamps();

             // Foreign Key
             $table->unsignedBigInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receptionist');
    }
};
