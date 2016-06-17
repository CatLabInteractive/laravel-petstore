<?php

use App\Models\Pet;
use Illuminate\Database\Seeder;

/**
 * Class PetSeeder
 */
class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [ 'Abby', 'Angel', 'Annie', 'Baby', 'Bailey', 'Bandit', 'Bear', 'Bella', 'Bob', 'Boo', 'Boots',
            'Bubba', 'Buddy', 'Buster', 'Cali', 'Callie', 'Casper', 'Charlie', 'Chester', 'Chloe', 'Cleo', 'Coco',
            'Cookie', 'Cuddles', 'Daisy', 'Dusty', 'Felix', 'Fluffy', 'Garfield', 'George', 'Ginger', 'Gizmo', 'Gracie',
            'Harley', 'Jack', 'Jasmine', 'Jasper', 'Kiki', 'Kitty', 'Leo', 'Lilly', 'Lily', 'Loki', 'Lola', 'Lucky',
            'Lucy', 'Luna', 'Maggie', 'Max', 'Mia', 'Midnight', 'Milo', 'Mimi', 'Miss kitty', 'Missy', 'Misty',
            'Mittens', 'Molly', 'Muffin', 'Nala', 'Oliver', 'Oreo', 'Oscar', 'Patches', 'Peanut', 'Pepper', 'Precious',
            'Princess', 'Pumpkin', 'Rascal', 'Rocky', 'Sadie', 'Salem', 'Sam', 'Samantha', 'Sammy', 'Sasha', 'Sassy',
            'Scooter', 'Shadow', 'Sheba', 'Simba', 'Simon', 'Smokey', 'Snickers', 'Snowball', 'Snuggles', 'Socks',
            'Sophie', 'Spooky', 'Sugar', 'Tiger', 'Tigger', 'Tinkerbell', 'Toby', 'Trouble', 'Whiskers', 'Willow',
            'Zoe', 'Zoey' ];

        shuffle($names);

        foreach ($names as $name) {
            $this->createPet($name);
        }
    }

    /**
     * @param $name
     */
    private function createPet($name)
    {
        $categoryId = mt_rand(1, 4);

        $statuses = [ Pet::STATUS_AVAILABLE, Pet::STATUS_SOLD, Pet::STATUS_ENDING ];
        $status = $statuses[mt_rand(0, count($statuses) - 1)];

        $id = DB::table('pets')->insertGetId([
            'name' => $name,
            'category_id' => $categoryId,
            'status' => $status
        ]);

        $photos = $this->getRandomPhotos();
        foreach ($photos as $photo) {
            DB::table('photos')->insert([
                'pet_id' => $id,
                'url' => $photo
            ]);
        }

        $tags = $this->getRandomTags();
        foreach ($tags as $v) {
            DB::table('pet_tag')->insert([
                'pet_id' => $id,
                'tag_id' => $v
            ]);
        }
    }

    /**
     * @return array
     */
    private function getRandomTags()
    {
        $amount = mt_rand(0, 8);

        $values = [ 1, 2, 3, 4, 5, 6, 7, 8 ];
        shuffle($values);

        $out = [];
        for ($i = 0; $i < $amount; $i ++) {
            $out[] = array_shift($values);
        }

        return $out;
    }

    /**
     * @return array
     */
    private function getRandomPhotos()
    {
        $url = 'https://kittehs.catlab.eu/'; // Visit it now!

        $values = [
            'cats/367.jpg', 'cats/371.jpg', 'cats/330.jpg', 'cats/303378_372909242762203_157659253_n.jpg',
            'cats/280.jpg', 'cats/c5ee8.jpg', 'cats/computer_crash.jpg', 'cats/tequilacat.jpg', 'cats/ransom.jpg',
            'cats/lechat.gif', 'cats/giantkitteh.gif', 'cats/249.jpg', 'cats/222.jpg', 'cats/025.jpg', 'cats/021.jpg',
            'cats/007.jpg', 'cats/037.jpg', 'cats/062.jpg', 'cats/141.jpg', 'cats/124.jpg', 'cats/119.jpg', 'cats/105.jpg'
        ];

        shuffle($values);

        $amount = mt_rand(1, 12);

        $out = [];
        for ($i = 0; $i < $amount; $i ++) {
            $out[] = $url . array_shift($values);
        }

        return $out;
    }
}