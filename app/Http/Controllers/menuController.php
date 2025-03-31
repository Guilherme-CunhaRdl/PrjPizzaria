<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu');
    }

    public function PagPedido()
    {
        return view('pedido');
    }

    public function PagHistoria()
    {
        return view('historia');
    }
}
