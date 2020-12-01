@extends("layouts.app")

@section("content")
    <div class="container">
        <product-show
            :product="{{ $product }}"
            :category="{{ $product->categories }}"
            :currencies="{{ $currencies }}"
            app-url="{{ env("APP_URL") }}"
            public-id="{{ env("CP_PUBLIC_ID") }}"
        ></product-show>
    </div>
@endsection
