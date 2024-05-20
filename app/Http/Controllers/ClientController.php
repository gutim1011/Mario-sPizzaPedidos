<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]
        );
        $user = Client::where('phone', $request->input('phone'))->first();

        if ($user) {
            Session::put('client', $user);
            return redirect()->route('order.menu');
        } else {
            $user = Client::create([
                'phone' => $request->input('phone'),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
            ]);
            Session::put('client', $user);
            Session::flash('success', 'Element created successfully.');

            return redirect()->route('order.menu');
        }
    }
}
