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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string("fullName")->nullable();
            $table->string("gender")->nullable();
            $table->date("dateOfBirth")->nullable();
            $table->string("profilePicture")->nullable();
            $table->string("emailAddress")->nullable();
            $table->string("phoneNumber")->nullable();
            $table->string("department")->nullable();
            $table->string("yearsOfExperience")->nullable();
            $table->string("licenseNumber")->nullable();
            $table->string("consultationFee")->nullable();
            $table->string("availableOnMon")->nullable();
            $table->string("availableOnTue")->nullable();
            $table->string("availableOnWed")->nullable();
            $table->string("availableOnThurs")->nullable();
            $table->string("availableOnFri")->nullable();
            $table->string("availableOnSat")->nullable();
            $table->string("status")->default("Available");
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
        Schema::dropIfExists('doctors');
    }
};
