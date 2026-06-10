<?php
// Comentario Nova Tech: Arquivo database/migrations/2026_04_29_220348_add_address_columns_to_users_table.php. Origem: Migrations do banco de dados. Conteudo: Cria ou altera estruturas do banco de dados usadas pelo sistema Nova Tech.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'cep'))
                $table->string('cep')->nullable()->after('email');
            if (!Schema::hasColumn('users', 'logradouro'))
                $table->string('logradouro')->nullable()->after('cep');
            if (!Schema::hasColumn('users', 'numero'))
                $table->string('numero', 10)->nullable()->after('logradouro');
            if (!Schema::hasColumn('users', 'cidade'))
                $table->string('cidade')->nullable()->after('numero');
            if (!Schema::hasColumn('users', 'estado'))
                $table->string('estado')->nullable()->after('cidade');
            // 'role' removido — já existe na migration original
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cep', 'logradouro', 'numero', 'cidade', 'estado']);
        });
    }
};
