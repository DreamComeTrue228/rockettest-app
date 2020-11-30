<?php


use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1, 100) as $i) {
            $title = $faker->text(rand(50, 100));
            $products[] = [
                "title" => $title,
                "body" => $faker->realText(rand(500, 1000)),
                "slug" => Str::slug("{$i}-{$title}"),
                "category_id" => rand(1, 20),
                "quantity" => rand(1, 100),
                "price" => rand(200, 10000)
            ];
        }

        if (!empty($products)) {
            Product::query()->insert($products);
        }
    }
}
