<?php

use Illuminate\Database\Seeder;

/**
 * Class TagSeeder
 */
class TagSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('tags');

        $table->insert([
            'id' => 1,
            'name' => 'Cute'
        ]);

        $table->insert([
            'id' => 2,
            'name' => 'Fluffy'
        ]);

        $table->insert([
            'id' => 3,
            'name' => 'Dangerous'
        ]);

        $table->insert([
            'id' => 4,
            'name' => 'Magical'
        ]);

        $table->insert([
            'id' => 5,
            'name' => 'Young'
        ]);

        $table->insert([
            'id' => 6,
            'name' => 'Old'
        ]);

        $table->insert([
            'id' => 7,
            'name' => 'Skinned'
        ]);

        $table->insert([
            'id' => 8,
            'name' => 'Alive'
        ]);
    }
}