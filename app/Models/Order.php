<?php
// Comentario Nova Tech: Arquivo app/Models/Order.php. Origem: Camada de models Eloquent. Conteudo: Representa uma tabela do banco via Eloquent e declara campos, relacoes e regras do modelo.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'address',
        'items',
    ];

    public function getAddressAttribute($value)
    {
        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $value;
    }

    public function setAddressAttribute($value): void
    {
        $this->attributes['address'] = is_string($value)
            ? $value
            : json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getItemsAttribute($value)
    {
        if ($this->relationLoaded('items')) {
            return $this->relations['items'];
        }

        $decoded = json_decode($value, true);

        return collect(json_last_error() === JSON_ERROR_NONE ? $decoded : []);
    }

    public function setItemsAttribute($value): void
    {
        $this->attributes['items'] = is_string($value)
            ? $value
            : json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
