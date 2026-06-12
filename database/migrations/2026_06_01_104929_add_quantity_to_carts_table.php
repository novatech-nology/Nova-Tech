<?php
// Comentario Nova Tech: Arquivo database/migrations/2026_06_01_104929_add_quantity_to_carts_table.php. Origem: Migrations do banco de dados. Conteudo: Cria ou altera estruturas do banco de dados usadas pelo sistema Nova Tech.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->default(1)->after('product_id');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
