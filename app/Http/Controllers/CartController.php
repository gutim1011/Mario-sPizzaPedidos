<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get('products', []);

        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }

        $viewData = [];
        $viewData['title'] = 'Cart - Pizzeria';
        $viewData['subtitle'] = 'Shopping Cart';
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;
        $viewData['quantities'] = $productsInSession;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request): RedirectResponse
    {
        $products = $request->session()->get('products', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (isset($products[$productId])) {
            $products[$productId] += $quantity;
        } else {
            $products[$productId] = $quantity;
        }

        $request->session()->put('products', $products);

        return redirect()->route('order.menu');
    }

    public function purchase(Request $request): View|RedirectResponse
    {
        $productsInSession = $request->session()->get('products', []);
        if ($productsInSession) {
            $order = new Order();
            $order->total = 0;
            $order->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->id];
                $orderItem = new OrderItem();
                $orderItem->quantity = $quantity;
                $orderItem->total = $product->price * $quantity;
                $orderItem->product_id = $product->id;
                $orderItem->order_id = $order->id;
                $orderItem->save();
                $total += $product->price * $quantity;
            }
            $order->total = $total;
            $order->save();

            $request->session()->forget('products');

            $viewData = [];
            $viewData['title'] = 'Purchase - Pizzeria';
            $viewData['subtitle'] = 'Purchase Status';
            $viewData['order'] = $order;

            return view('cart.purchase')->with('viewData', $viewData);
        } else {
            return redirect()->route('cart.index');
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('products');

        return back();
    }

    public function addPizza(Request $request): RedirectResponse
    {
        $size = $request->input('size');
        $type = $request->input('type');
        $flavor1 = $request->input('flavor1');
        $halves = $request->input('halves') ? true : false;
        $flavor2 = $halves ? $request->input('flavor2') : null;

        // Crear el nombre del producto dinámicamente
        $productName = $flavor1;
        if ($halves) {
            $productName .= '-' . $flavor2;
        }

        // Buscar el producto si ya existe
        $product = Product::where('name', $productName)
                            ->where('size', $size)
                            ->where('type', 'Pizza')
                            ->first();

        if (!$product) {
            // Crear el producto si no existe
            $price = $this->calculatePizzaPrice($size, $type, $halves);
            $product = Product::create([
                'name' => $productName,
                'description' => '',
                'size' => $size,
                'type' => 'Pizza',
                'price' => $price
            ]);
        }

        // Añadir el producto al carrito
        $products = $request->session()->get('products', []);
        $productId = $product->id;
        $quantity = $request->input('quantity', 1);

        if (isset($products[$productId])) {
            $products[$productId] += $quantity;
        } else {
            $products[$productId] = $quantity;
        }

        $request->session()->put('products', $products);

        return redirect()->route('order.menu');
    }

    private function calculatePizzaPrice($size, $type, $halves)
    {
        // Lógica para calcular el precio de la pizza según el tamaño y el tipo
        $basePrices = [
            'clasica' => [4 => 19900, 6 => 33900, 8 => 45900, 10 => 57900, 12 => 69900],
            'especial' => [4 => 21900, 6 => 36900, 8 => 49900, 10 => 62900, 12 => 75900],
            'estofada' => [4 => 26900, 6 => 45900, 8 => 59900, 10 => 73900, 12 => 87900],
        ];

        $price = $basePrices[$type][$size];
        if ($halves) {
            $price += 4000;
        }

        return $price;
    }
}
