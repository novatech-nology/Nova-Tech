<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome', [
        'products' => Product::all()
    ]);
})->name('home');

Route::get('/loja', function () {
    $productsByBrand = Product::all()->groupBy('category');

    return view('loja', compact('productsByBrand'));
})->name('loja');

/*
|--------------------------------------------------------------------------
| CLIENTE (AUTENTICADO)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminController::class, 'admin'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | PRODUTOS (CRUD COMPLETO)
        |--------------------------------------------------------------------------
        */

        Route::prefix('produtos')->name('products.')->group(function () {

            Route::get('/', [ProductController::class, 'index'])
                ->name('index');

            Route::get('/criar', [ProductController::class, 'create'])
                ->name('create');

            Route::post('/salvar', [ProductController::class, 'store'])
                ->name('store');

            // 🔥 ADICIONADO (IMPORTANTE PARA FUTURO)
            Route::get('/editar/{id}', [ProductController::class, 'edit'])
                ->name('edit');

            Route::put('/atualizar/{id}', [ProductController::class, 'update'])
                ->name('update');

            Route::delete('/deletar/{id}', [ProductController::class, 'destroy'])
                ->name('destroy');
        });
    });

require __DIR__.'/auth.php';
