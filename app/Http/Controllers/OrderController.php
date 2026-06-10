<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/OrderController.php. Origem: Camada de controllers. Conteudo: Recebe requisicoes, consulta models e retorna views ou redirecionamentos da funcionalidade.

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // ETAPA 1 — Carrinho (resumo)
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.step1', compact('cartItems', 'total'));
    }

    // ETAPA 2 — Entrega (endereço)
    public function delivery(Request $request)
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $user  = Auth::user();

        return view('checkout.step2', compact('cartItems', 'total', 'user'));
    }

    // ETAPA 3 — Pagamento
    public function payment(Request $request)
    {
        $request->validate([
            'zipcode' => 'required|string|max:9',
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:100',
            'state'   => 'required|string|max:2',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Salva endereço na sessão
        session([
            'checkout_address' => [
                'zipcode' => $request->zipcode,
                'address' => $request->address,
                'city'    => $request->city,
                'state'   => $request->state,
            ]
        ]);

        return view('checkout.step3', compact('cartItems', 'total'));
    }

    // ETAPA 4 — Confirmação
    public function confirm(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:pix,credit_card',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio!');
        }

        $total   = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $address = session('checkout_address');

        if (!$address) {
            return redirect()->route('checkout.delivery')->with('error', 'Informe o endereço de entrega.');
        }

        session(['checkout_payment' => $request->payment_method]);

        return view('checkout.step4', compact('cartItems', 'total', 'address'));
    }

    // FINALIZAR — Salva pedido no banco
    public function store(Request $request)
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio!');
        }

        $total          = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $address        = session('checkout_address');
        $paymentMethod  = session('checkout_payment');

        if (!$address || !$paymentMethod) {
            return redirect()->route('checkout.index')->with('error', 'Complete todas as etapas do checkout.');
        }

        $orderItems = $cartItems->map(function ($item) {
            $price = $item->product->price;

            return [
                'product_id' => $item->product_id,
                'name'       => $item->product->name,
                'price'      => $price,
                'quantity'   => $item->quantity,
                'subtotal'   => $price * $item->quantity,
            ];
        });

        // Cria o pedido
        $order = Order::create([
            'user_id'        => Auth::id(),
            'total'          => $total,
            'status'         => 'confirmado',
            'payment_method' => $paymentMethod,
            'payment_status' => 'paid',
            'address'        => $address,
            'items'          => $orderItems->values()->all(),
        ]);

        // Salva os itens
        foreach ($cartItems as $item) {
            $price = $item->product->price;

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'name'       => $item->product->name,
                'quantity'   => $item->quantity,
                'price'      => $price,
                'subtotal'   => $price * $item->quantity,
            ]);
        }

        // Limpa carrinho e sessão
        Cart::where('user_id', Auth::id())->delete();
        session()->forget(['checkout_address', 'checkout_payment']);

       return redirect()->route('orders.index')
                 ->with('success', 'Pedido realizado com sucesso!');
    }

    // Exibe pedido finalizado
    public function show($id)
    {
        $order = Order::with('items.product')
                      ->where('user_id', Auth::id())
                      ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
    public function index()
{
    $orders = Order::with('items.product')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('orders.index', compact('orders'));
}
}
