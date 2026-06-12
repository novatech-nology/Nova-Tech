<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/ProductController.php. Origem: Camada de controllers. Conteudo: Recebe requisicoes, consulta models e retorna views ou redirecionamentos da funcionalidade.

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }
}
