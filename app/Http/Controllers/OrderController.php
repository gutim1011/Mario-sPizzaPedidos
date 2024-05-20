<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }

    public function data()
    {
        return view('order.data');
    }

    public function menu()
    {
        $viewData = [];

        return view('order.menu')->with('viewData', $viewData);
    }
}
