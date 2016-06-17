<?php

use App\Models\Pet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PetSeeder::class);
    }
}
