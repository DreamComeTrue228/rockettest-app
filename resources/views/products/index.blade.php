@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="card col-sm-3 m-1">
                    <div class="card-body">
                        <h3 class="card-title">{{ $product->categories->name }}</h3>
                        <h5 class="card-title">
                            <a class="btn btn-link" href="{{ route("products.show", $product->slug) }}">
                                {{ $product->title }}
                            </a>
                        </h5>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit($product->body, 30) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
