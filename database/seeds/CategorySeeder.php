<?php

use Illuminate\Database\Seeder;

/**
 * Class PetSeeder
 */
class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Cat',
            'description' => 'A small domesticated carnivorous mammal with soft fur, a short snout, and retractile claws.'
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Dog',
            'description' => 'A domesticated carnivorous mammal that typically has a long snout, an acute sense of smell, non-retractile claws, and a barking, howling, or whining voice.'
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'name' => 'Guinea pig',
            'description' => 'A domesticated tailless South American cavy, originally raised for food. It no longer occurs in the wild and is now typically kept as a pet or for laboratory research.'
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'name' => 'Tiger',
            'description' => 'A very large solitary cat with a yellow-brown coat striped with black, native to the forests of Asia but becoming increasingly rare.'
        ]);
    }
}