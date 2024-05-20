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
}
