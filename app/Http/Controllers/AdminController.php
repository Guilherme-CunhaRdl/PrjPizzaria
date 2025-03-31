<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/loginAdmin');
    }

    public function DashBoardP()
    {
        return view('admin/dbAdmin');
    }
    public function DashBoardC()
    {
        return view('admin/dbAdminCardapio');
    }

    public function DashBoardCLiente()
    {
        return view('admin/dbAdminCliente');
    }

    public function DashBoardPedido()
    {
        return view('admin/dbAdminPedido');
    }

    public function FormularioPizza()
    {
        return view('admin/formularioPizza');
    }
}
