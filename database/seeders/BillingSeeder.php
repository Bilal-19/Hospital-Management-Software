<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fakeRecord = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            DB::table('receipt')->insert([
                "patientName" => $fakeRecord->firstName(),
                "doctorName" => "Dr. Salik",
                "serviceName" => $fakeRecord->randomElement(
                    [
                        "General Consultation",
                        "Follow-up Visit",
                        "Emergency Care",
                        "Vaccination",
                        "Dressing Change",
                        "Physiotherapy",
                        "ECG Monitoring",
                        "IV Therapy",
                        "Nebulization",
                        "Blood Pressure Check"
                    ]
                ),
                "serviceAmount" => $fakeRecord->numberBetween(50, 100),
                "testName" => $fakeRecord->randomElement(
                    [
                        "Complete Blood Count (CBC)",
                        "Blood Sugar (Fasting)",
                        "Urine Routine Examination",
                        "Lipid Profile",
                        "Thyroid Function Test",
                        "Liver Function Test",
                        "Kidney Function Test",
                        "Malaria Test",
                        "COVID-19 PCR",
                        "Chest X-ray"
                    ]
                ),
                "testCost" => $fakeRecord->numberBetween(50, 100),
                "medicineName" => $fakeRecord->randomElement([
                    "Paracetamol 500mg",
                    "Ibuprofen 400mg",
                    "Amoxicillin 250mg",
                    "Cefixime 200mg",
                    "Multivitamin Syrup",
                    "Omeprazole 20mg",
                    "Cetirizine 10mg",
                    "Metformin 500mg",
                    "Losartan 50mg",
                    "Azithromycin 250mg"
                ]),
                "medicinePrice" => $fakeRecord->numberBetween(50, 100),
                "totalAmount" => $fakeRecord->numberBetween(50, 100),
                "paymentMode" => $fakeRecord->randomElement([
                    "cash",
                    "credit",
                    "insurance"
                ]),
                "user_id" => 5
            ]);
        }
    }
}
