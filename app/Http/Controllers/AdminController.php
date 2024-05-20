<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page';
        $viewData['products'] = Product::all();

        return view('admin.index')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'type' => $request->input('type'),
            'size' => $request->input('size'),
        ]);

        Session::flash('success', 'Element created successfully.');

        return redirect()->back();
    }

    public function edit($id): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Edit Product - Online Store';
        $viewData['product'] = Product::findOrFail($id);

        return view('admin.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('products', 'public');
            $product->images = $imagePath;
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        $product->save();

        return redirect()->route('admin.index');
    }

    public function delete($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->images);
        $product->delete();

        return back();
    }
}
