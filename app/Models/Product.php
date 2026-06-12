<?php
// Comentario Nova Tech: Arquivo app/Models/Product.php. Origem: Camada de models Eloquent. Conteudo: Representa uma tabela do banco via Eloquent e declara campos, relacoes e regras do modelo.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
}