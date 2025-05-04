<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['Role_name' => 'client'],
            ['Role_name' => 'restaurant'],
            ['Role_name' => 'livreur'],
            ['Role_name' => 'admin'],
        ]);
        
    }
}
