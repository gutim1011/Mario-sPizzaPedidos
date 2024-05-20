<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Tomando pedido';

        return view('order.index');
    }

    public function data(Request $request)
    {
        $phone = $request->input('phone');
        $viewData =[];
        $user = Client::where('phone', $phone)->first();
        $viewData['client']= $user;
        if ($user) {
            $viewData['phone']= $user->phone;
            $viewData['name']=$user->name;
            $viewData['address']=$user->address;
        } else{
            $viewData['phone']= $phone;
            $viewData['name']='';
            $viewData['address']='';

        }
        return view('order.data')->with('viewData',$viewData);
    }

    public function menu()
    {
        $viewData = [];
        $viewData['entradas'] = Product::where('type', 'Entrada')->get();
        $viewData['burritos'] = Product::where('type', 'Burrito')->get();
        $viewData['sandwiches'] = Product::where('type', 'Sandwich')->get();
        $viewData['arepas'] = Product::where('type', 'Arepa')->get();
        $viewData['papas'] = Product::where('type', 'Papa')->get();

        return view('order.menu')->with('viewData', $viewData);
    }

    public function menuPizza()
    {
        $viewData = [];
        $viewData['clasicFlavors']= ['hawaiana','Ranchera Salame','Jamon y Queso','Napolitana'];
        $viewData['specialFlavors'] = ['Peperoni','Maiz tocineta', 'Ranchera mix','Paisa','Trs estaciones','Rustica','Camila'];
        $viewData['estofadaFlavors'] = ['Carnes','Champiñones','Delifood'];
 
        return view('order.pizza')->with('viewData', $viewData);
    }
}
