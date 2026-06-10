<?php
// Comentario Nova Tech: Arquivo database/migrations/2026_06_02_174534_add_checkout_fields_to_orders_table.php. Origem: Migrations do banco de dados. Conteudo: Cria ou altera estruturas do banco de dados usadas pelo sistema Nova Tech.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status'); // pix ou credit_card
            $table->string('address')->nullable()->after('payment_method');
            $table->string('city')->nullable()->after('address');
            $table->string('state', 2)->nullable()->after('city');
            $table->string('zipcode', 9)->nullable()->after('state');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'address', 'city', 'state', 'zipcode']);
        });
    }
};
