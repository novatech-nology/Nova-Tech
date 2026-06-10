<?php
// Comentario Nova Tech: Arquivo database/migrations/2026_05_30_114952_create_orders_table.php. Origem: Migrations do banco de dados. Conteudo: Cria ou altera estruturas do banco de dados usadas pelo sistema Nova Tech.
?>
// database/migrations/xxxx_create_orders_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pendente', 'confirmado', 'enviado', 'entregue', 'cancelado'])
                  ->default('pendente');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // preço no momento da compra
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};