<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return Pedido::with('usuario', 'itens')->get();
    }
}
