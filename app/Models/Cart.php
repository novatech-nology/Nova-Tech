<?php
// Comentario Nova Tech: Arquivo app/Models/Cart.php. Origem: Camada de models Eloquent. Conteudo: Representa uma tabela do banco via Eloquent e declara campos, relacoes e regras do modelo.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}