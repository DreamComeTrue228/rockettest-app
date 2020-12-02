<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("products.index", [
            "products" => Product::query()
                ->with("categories")->get()
        ]);
    }

    /**
     * @param $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $product = Product::query()->where("slug", $slug)->first();
        $currencies = Currency::query()->get()->toJson();
        return view("products.show", [
            "product" => $product,
            "currencies" => $currencies,
        ]);
    }
}
