@extends('layouts.app')

@section('content')

<style>
    .store-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        background-color: #d1d1d1;
        padding: 40px 20px;
        min-height: 100vh;
        font-family: Arial, sans-serif;
    }

    .brand-column {
        background-color: #e6e6e6;
        width: 350px;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .brand-title {
        font-weight: bold;
        font-size: 1.2rem;
        text-transform: uppercase;
        margin-bottom: 30px;
        letter-spacing: 2px;
    }

    .product-list {
        width: 100%;
        overflow-y: auto;
        max-height: 700px;
    }

    .product-card {
        background-color: white;
        border: 1px solid #ccc;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }

    .product-card img {
        max-width: 120px;
        margin-bottom: 10px;
    }

    .product-price {
        font-weight: bold;
    }

    .btn-buy {
        background: transparent;
        border: 1px solid #000;
        padding: 5px 15px;
        cursor: pointer;
    }

    .btn-buy:hover {
        background: #000;
        color: #fff;
    }
</style>

<div class="store-container">

    @foreach($productsByBrand ?? [] as $brand => $products)

        <div class="brand-column">
            <div class="brand-title">{{ $brand }}</div>

            <div class="product-list">

                @foreach($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

                        <h5>{{ $product->name }}</h5>

                        <p class="product-price">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-buy">
                                Adicionar ao Carrinho
                            </button>
                        </form>
                    </div>
                @endforeach

            </div>
        </div>

    @endforeach

</div>

@endsection
