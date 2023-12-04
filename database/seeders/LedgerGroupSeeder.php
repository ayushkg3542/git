<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LedgerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ledger_group_masters')->insert([
            ['group_name' => 'Cash'],
            ['group_name' => 'Medicine Purchase'],
            ['group_name' => 'Medicine Sale'],
            ['group_name' => 'Courier'],
            ['group_name' => 'Direct Expenses'],
        ]);
    }
}
