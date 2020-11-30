<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::query()->insert([
            ["name" => "Тенге", "code" => "KZT", "country_name" => "Kazakhstan", "value" => 1.00],
            ["name" => "Рубль", "code" => "RUB", "country_name" => "Russia", "value" => 5.59],
            ["name" => "US Доллар", "code" => "USD", "country_name" => "USA", "value" => 423.87],
            ["name" => "Евро", "code" => "EUR", "country_name" => "European Union", "value" => 505.25],
        ]);
    }
}
