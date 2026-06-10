<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/Admin/AdminProductController.php. Origem: Camada administrativa. Conteudo: Recebe requisicoes, consulta models e retorna views ou redirecionamentos da funcionalidade.

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
{
    $products = Product::latest()->get();
    return view('admin.products.create', compact('products'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|url',
        ]);

        Product::create($request->only(['name', 'category', 'description', 'price', 'image']));

        return redirect()->route('admin.products.create')
                         ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|url',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'category', 'description', 'price', 'image']));

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produto removido com sucesso!');
    }
}
