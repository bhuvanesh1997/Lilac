<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'John Doe', 'fk_department' => 1, 'fk_designation' => 2, 'phone_number' => '1234567890', 'created_at' => now()],
            ['name' => 'Jane Smith', 'fk_department' => 2, 'fk_designation' => 1, 'phone_number' => '0987654321', 'created_at' => now()],
        ]);
    }
}
