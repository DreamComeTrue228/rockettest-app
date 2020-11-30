<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->get();

        return view("products.index", [
            "products" => Product::query()->get()
        ]);
    }

    public function show($slug)
    {
        $product = Product::query()->where("slug", $slug)->first();
        $currencies = Currency::query()->get()->toJson();
        return view("products.show", [
            "product" => $product,
            "currencies" => $currencies
        ]);
    }
}
