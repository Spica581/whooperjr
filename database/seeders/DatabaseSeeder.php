<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('CAMPUS')->insert([
            ['CampusName' => 'Main Campus'],
            ['CampusName' => 'North Campus'],
        ]);

        DB::table('SEX')->insert([
            ['SexName' => 'Male'],
            ['SexName' => 'Female'],
        ]);

        DB::table('CIVIL_STATUS')->insert([
            ['CSName' => 'Single'],
            ['CSName' => 'Married'],
        ]);
    }
}