<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class categorieseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'mon_categorie' => 'Plats principaux', 
                'description' => 'Les plats principaux du menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'mon_categorie' => 'Desserts', 
                'description' => 'Les desserts gourmands',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'mon_categorie' => 'entre', 
                'description' => 'Les plate entre',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
