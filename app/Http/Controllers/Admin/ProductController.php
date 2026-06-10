<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/Admin/ProductController.php. Origem: Camada administrativa. Conteudo: Recebe requisicoes, consulta models e retorna views ou redirecionamentos da funcionalidade.

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.create', compact('products'));
    }

    public function create()
    {
        $products = Product::latest()->get();
        return view('admin.products.create', compact('products'));
    }

    public function store(Request $request)
    {
        Product::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $request->image,
        ]);

        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $product  = Product::findOrFail($id);
        $products = Product::latest()->get();
        return view('admin.products.edit', compact('product', 'products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $request->image,
        ]);

        return redirect()->route('admin.products.create')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Produto removido com sucesso!');
    }
}
