@extends("layouts.app")

@section("content")
    <div class="container">
        <product-show
            :product="{{ $product }}"
            :category="{{ $product->categories }}"
            :currencies="{{ $currencies }}"
        ></product-show>
    </div>
@endsection
