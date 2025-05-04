<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use Carbon\Carbon;
use Faker\Factory as Faker;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
    
        \App\Models\User::factory(10)->create();
        \App\Models\Restaurant::factory(10)->create();
    
        Menu::factory()->count(10)->create();
        DB::table('categories')->insert([
            [
                'mon_categorie' => 'Plats principaux',
                'description' => 'Les plats principaux du menu',
                'menu_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'mon_categorie' => 'Desserts',
                'description' => 'Les desserts gourmands',
                'menu_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'mon_categorie' => 'Entrées',
                'description' => 'Les plats d\'entrée',
                'menu_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    
    
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table('plats')->insert([
                'nom_plat' => $faker->word,
                'desciption' => $faker->sentence,
                'prix' => $faker->randomFloat(2, 10, 50),
                'temps_Preparation' => $faker->numberBetween(10, 60),
                'disponible' => $faker->boolean,
                'image' => 'default-image.jpg',
                'categorie_id' => $faker->numberBetween(1, 3),
                'menu_id' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}    
