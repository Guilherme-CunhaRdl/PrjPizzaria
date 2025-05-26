<?php

use App\Http\Controllers\AdminController;
use App\Models\Pedido;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmLoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','App\Http\Controllers\HomeController@index')->name('home');
Route::get('/nivelUsuario/cadastro', [CadastroController::class, 'index']);
Route::get('/menu',[ProdutoController::class, 'verTodasPizzas']);
Route::get('/menu/pedido','App\Http\Controllers\MenuController@PagPedido');
Route::get('/historia','App\Http\Controllers\MenuController@PagHistoria');
Route::post('/nivelUsuario/cadastro', [CadastroController::class, 'FazerCadastro']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/admin/loginAdmin', [AdmLoginController::class, 'index'])->name('loginAdmin');
Route::post('/admin/loginAdmin', [AdmLoginController::class, 'login'])->name('loginAdmin.submit');

Route::get('/pedidos/{id}/detalhes', [PedidoController::class, 'detalhes'])->name('pedidos.detalhes');
Route::get('/pedidos/contagem-status', [PedidoController::class, 'contagemStatus']);
Route::get('/menu/pedido/{id}', [PedidoController::class, 'pegarPizzas'])->name('pedido.create');
Route::post('/menu/pedido/sucesso', [PedidoController::class, 'store'])->name('pedidos.store');

//BAgulho do ADM
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dbAdmin', [AdminController::class, 'dbAdmin'])->name('dashboardAdm');
    Route::get('/dbAdminCardapio', [ProdutoController::class, 'index'])->name('cardapio.index');
    Route::get('/dbAdminPedido', [PedidoController::class, 'index'])->name('admin.pedidos');
    Route::get('/dbAdminCardapio/{id}', [ProdutoController::class, 'deletarPizza'])->name('deletarPizza');
    Route::post('/pizzas', [ProdutoController::class, 'inserirPizza'])->name('pizzas.store');
    Route::put('/pizzas/{id}', [ProdutoController::class, 'update'])->name('pizzas.update');

    Route::put('/pedidos/{pedido}/status', [PedidoController::class, 'updateStatus'])->name('pedidos.updateStatus');
    Route::get('/clientes/{id}/detalhes', [AdminController::class, 'detalhesCliente'])->name('admin.clientes.detalhes');
    Route::get('/dbAdminCliente', [AdminController::class, 'dbAdminCliente']);
    Route::get('/pedidos/{id}/detalhes', [AdminController::class, 'detalhesPedido'])->name('admin.pedidos.detalhes');
});