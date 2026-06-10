<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/Backend/AdminController.php. Origem: Camada administrativa. Conteudo: Recebe requisicoes, consulta models e retorna views ou redirecionamentos da funcionalidade.

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function admin()
{
    $orders = Order::with(['user', 'items.product'])
                   ->latest()
                   ->paginate(10);

    return view('admin/admin', compact('orders'));
}

    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])
                       ->latest()
                       ->paginate(10);

        return view('admin.admin', compact('orders'));
    }

    public function sales()
    {
        // Total de vendas
        $totalSales = Order::where('status', '!=', 'cancelado')->sum('total');

        // Mês de baro (maior venda do mês atual)
        $topOrderThisMonth = Order::where('status', '!=', 'cancelado')
                                  ->whereMonth('created_at', now()->month)
                                  ->whereYear('created_at', now()->year)
                                  ->orderBy('total', 'desc')
                                  ->first();

        // Vendas por categoria
        $salesByCategory = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                                    ->where('orders.status', '!=', 'cancelado')
                                    ->selectRaw('products.category, SUM(order_items.price * order_items.quantity) as total_revenue, SUM(order_items.quantity) as total_sold')
                                    ->groupBy('products.category')
                                    ->orderByDesc('total_revenue')
                                    ->get();

        // Produtos mais vendidos
        $topProducts = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                                ->where('orders.status', '!=', 'cancelado')
                                ->selectRaw('products.id, products.name, products.image, products.category, products.price, SUM(order_items.quantity) as total_sold, SUM(order_items.price * order_items.quantity) as total_revenue')
                                ->groupBy('products.id', 'products.name', 'products.image', 'products.category', 'products.price')
                                ->orderByDesc('total_sold')
                                ->limit(5)
                                ->get();

        // Total geral de vendas no mês atual
        $monthlySales = Order::where('status', '!=', 'cancelado')
                             ->whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year)
                             ->sum('total');

        return view('admin.sales', compact(
            'totalSales',
            'topOrderThisMonth',
            'salesByCategory',
            'topProducts',
            'monthlySales'
        ));
    }
}
