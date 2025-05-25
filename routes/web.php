<?php

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
Route::get('/menu/pedido/{id}', [ProdutoController::class, 'verPizzaEspecifica'])->name('infoPizza');


//BAgulho do ADM
Route::get('/admin/loginAdmin',[AdmLoginController::class, 'index'])->name('loginAdmin');
Route::post('/admin/loginAdmin', [AdmLoginController::class, 'login'])->name('loginAdmin.submit');
Route::get('/admin/dbAdmin','App\Http\Controllers\AdminController@DashBoardP')->name('dashboardAdm');
Route::get('/admin/dbAdminCardapio',[ProdutoController::class, 'index'])->name('cardapio.index');
Route::get('/admin/dbAdminCliente','App\Http\Controllers\AdminController@DashBoardCLiente');
Route::get('/admin/dbAdminPedido', [PedidoController::class, 'index'])->name('admin.pedidos');
Route::get('/admin/dbAdminCardapio/{id}', [ProdutoController::class, 'deletarPizza'])->name('deletarPizza');

Route::post('/admin/pizzas', [ProdutoController::class, 'inserirPizza'])->name('pizzas.store');
// routes/web.php
Route::put('/admin/pizzas/{id}', [ProdutoController::class, 'update'])->name('pizzas.update');

// ROTAS DO PEDIDO 
Route::put('/admin/pedidos/{pedido}/status', [PedidoController::class, 'updateStatus'])->name('pedidos.updateStatus');
Route::get('/pedidos/{id}/detalhes', [PedidoController::class, 'detalhes'])->name('pedidos.detalhes');