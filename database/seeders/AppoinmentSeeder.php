<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AppoinmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fakeRecord = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            DB::table('appoinments')->insert([
                "department" => $fakeRecord->randomElement([
                    'Cardiology',
                    'Neurology',
                    'Pediatrics',
                    'Orthopedics',
                    'Dermatology',
                    'General Medicine',
                ]),
                "doctorName" => "Dr. Salik",
                "appoinmentDate" => $fakeRecord->date("Y-m-d", "2024-12-31"),
                "appoinmentTime" => $fakeRecord->time(),
                "patientName" => $fakeRecord->firstName(),
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
                "user_id" => 1
            ]);
    }
}
}
