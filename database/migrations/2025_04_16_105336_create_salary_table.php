<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->string("salaryMonth");
            $table->string("basicSalary");
            $table->string("houseRentAllowance");
            $table->string("travelAllowance");
            $table->string("medicalAllowance");
            $table->string("grossEarning");
            $table->timestamps();

            $table->unsignedBigInteger("employeeId");
            $table->foreign('employeeId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary');
    }
};
