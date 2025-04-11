<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fakeRecord = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            DB::table('doctors')->insert([
                "fullName" => $fakeRecord->firstName(),
                "gender" => $fakeRecord->randomElement(["Male", "Female"]),
                "dateOfBirth" => $fakeRecord->date("Y-m-d", "2024-12-31"),
                "profilePicture" => $fakeRecord->imageUrl(200, 200, 'people'),
                "emailAddress" => $fakeRecord->unique()->safeEmail(),
                "phoneNumber" => $fakeRecord->phoneNumber(),
                "department" => $fakeRecord->randomElement([
                    'Cardiology',
                    'Neurology',
                    'Pediatrics',
                    'Orthopedics',
                    'Dermatology',
                    'General Medicine',
                ]),
                "yearsOfExperience" => $fakeRecord->randomNumber(1, 10),
                "licenseNumber" => $fakeRecord->numberBetween(3500, 5000),
                "consultationFee" => $fakeRecord->numberBetween(50, 150),
                "status" => $fakeRecord->randomElement(["Available", "Unavailable"]),
                "user_id" => 1
            ]);
        }
    }
}
