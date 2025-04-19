<?php

namespace Database\Seeders;

use App\Models\Plat;
use Carbon\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class plateSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('plats')->insert([
                'nom_plat' => $faker->word,
                'desciption' => $faker->sentence,
                'prix' => $faker->randomFloat(2, 10, 50), 
                'temps_Preparation' => $faker->numberBetween(10, 60), 
                'disponible' => $faker->boolean,
                'image' => 'default-image.jpg',
                'categorie_id' => $faker->numberBetween(1,2),
                'created_at' => now(),
                'updated_at' => now(),
                'menu_id'=> $faker->numberBetween(1,10)
            ]);


    }
}
}
