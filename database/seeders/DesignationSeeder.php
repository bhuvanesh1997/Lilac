<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('designations')->insert([
            ['name' => 'Manager', 'created_at' => now()],
            ['name' => 'Developer', 'created_at' => now()],
            ['name' => 'Designer', 'created_at' => now()],
        ]);
    }
}
