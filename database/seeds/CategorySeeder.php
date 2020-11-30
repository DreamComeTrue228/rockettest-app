<?php

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 20) as $i) {
            $name = $faker->name;

            $categories[] = [
                "name" => $name,
                "slug" => Str::slug($name),
                "parent_id" => $i > 5 ? rand(1, 5) : 0
            ];
        }

        if (isset($categories)) {
            Category::query()->insert($categories);
        }
    }
}
