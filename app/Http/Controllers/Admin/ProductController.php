<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|url',
            'category' => 'required'
        ]);

        Product::create($data);

        return redirect()
            ->back()
            ->with('success', 'Produto salvo com sucesso!');
    }
}
namespace App\Http\Controllers;

use App\Models\Product; // Não esqueça de importar o Model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // 1. Pegamos todos os produtos do banco
        // 2. Usamos o groupBy('category') para organizar por marca
        $productsByBrand = Product::all()->groupBy('category');

        // 3. Enviamos para a view 'loja' (ou o nome do seu arquivo blade)
        // O compact('productsByBrand') é o que cria a variável na View
        return view('loja', compact('productsByBrand'));
    }
}
