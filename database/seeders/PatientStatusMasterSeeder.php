<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patient_status_masters')->insert([
            ['status' => 'New Registration'],
            ['status'=> 'Treatment Scheduled'],
            ['status'=> 'Treatment Completed']
        ]);
    }
}
