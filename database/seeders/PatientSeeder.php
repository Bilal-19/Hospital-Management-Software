<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fakeRecord = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            DB::table('patients')->insert([
                "fullName" => $fakeRecord->firstName(),
                "age" => $fakeRecord->numberBetween(5,80),
                "gender" => $fakeRecord->randomElement(["Male", "Female"]),
                "emailAddress" => $fakeRecord->unique()->email(),
                "phoneNumber" => $fakeRecord->phoneNumber(),
                "reasonForVisit" => $fakeRecord->randomElement(
                    [
                        "General Check-up",
                        "Fever or Cold",
                        "Headache or Migraine",
                        "Stomach Pain",
                        "Skin Allergy or Rash",
                        "High Blood Pressure",
                        "Diabetes Follow-up",
                        "Chest Pain",
                        "Injury or Wound Dressing",
                        "Prescription Refill"
                    ]
                ),
                "medicalHistory" => $fakeRecord->realText(50),
                "user_id" => 2
            ]);
        }
    }
}
