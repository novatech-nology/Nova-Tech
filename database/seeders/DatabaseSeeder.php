<?php
// Comentario Nova Tech: Arquivo database/seeders/DatabaseSeeder.php. Origem: Seeders do banco de dados. Conteudo: Popula o banco com dados iniciais ou auxiliares para desenvolvimento.

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(UserSeeder::class);
    }
}
