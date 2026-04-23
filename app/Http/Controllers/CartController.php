<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $id],
            ['quantity' => DB::raw('quantity + 1')]
        );

        return back()->with('success', 'Produto adicionado ao carrinho!');
    }
}
