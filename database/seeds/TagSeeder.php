<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
        	['name' => 'american'],
			['name' => 'asian'],
			['name' => 'baked-goods'],
			['name' => 'beef'],
			['name' => 'breakfast'],
			['name' => 'dessert'],
			['name' => 'entree'],
			['name' => 'gluten-free'],
			['name' => 'italian'],
			['name' => 'mediterranean'],
			['name' => 'mexican'],
			['name' => 'paleo'],
			['name' => 'poultry'],
			['name' => 'seafood'],
			['name' => 'snack'],
			['name' => 'vegetarian'],
        ];
        foreach ($tags as $tag) {
        	Tag::create($tag);
        }
    }
}
