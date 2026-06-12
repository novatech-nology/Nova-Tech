<?php
// Comentario Nova Tech: Arquivo app/Models/OrderItem.php. Origem: Camada de models Eloquent. Conteudo: Representa uma tabela do banco via Eloquent e declara campos, relacoes e regras do modelo.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'quantity',
        'subtotal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
