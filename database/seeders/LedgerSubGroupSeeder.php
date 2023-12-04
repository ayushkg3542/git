<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LedgerSubGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ledger_sub_group_masters')->insert([
            ['group_id'=> '1', 'sub_group_name' => 'Cash'],
            ['group_id'=> '2', 'sub_group_name' => 'Medicine Purchase'],
            ['group_id'=> '3', 'sub_group_name' => 'Medicine Sale'],
            ['group_id'=> '4', 'sub_group_name' => 'Courier']
        ]);
    }
}
