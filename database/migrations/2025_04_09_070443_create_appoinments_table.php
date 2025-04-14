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
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();
            $table->string("department");
            $table->string("doctorName");
            $table->date("appoinmentDate");
            $table->string("appoinmentTime");
            $table->string("patientName");
            $table->string("reasonForVisit");
            $table->string("diagnosis")->nullable();
            $table->string("medicine")->nullable();
            $table->string("symptoms")->nullable();
            $table->string("report")->nullable();
            $table->timestamps();

            // Foreign Key reference - Who created appoinment i.e receptionist
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->
                references('id')->
                on('users')->
                onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appoinments');
    }
};
