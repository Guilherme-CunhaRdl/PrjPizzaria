<?php
namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['usuario', 'itens.pizza'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('admin.dbAdminPedido', compact('pedidos'));
    }

    public function updateStatus(Request $request, Pedido $pedido)
{
    $request->validate([
        'status' => 'required|in:pendente,preparo,entrega,entregue,cancelado'
    ]);

    try {
        $pedido->update(['status' => $request->status]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status atualizado com sucesso'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar status: ' . $e->getMessage()
        ], 500);
    }
}

public function detalhes($id)
{
    $pedido = Pedido::with(['usuario', 'itens.pizza'])
        ->findOrFail($id);

    return response()->json([
        'id' => $pedido->id,
        'data' => $pedido->created_at->format('d/m/Y'),
        'hora' => $pedido->created_at->format('H:i'),
        'pagamento' => $pedido->metodo_pagamento,
        'entrega' => $pedido->endereco_entrega ? 'Delivery' : 'Retirada',
        'status' => $pedido->status,
        'cliente' => [
            'nome' => $pedido->usuario->nomeUsuario,
            'telefone' => $pedido->usuario->telefone
        ],
             'itens' => $pedido->itens->map(function($item) {
            return [
                'nome' => $item->pizza->nomePizza,
                'tamanho' => $item->tamanho,
                'quantidade' => $item->quantidade,
                'preco_unitario' => $item->preco_unitario,
                'subtotal' => $item->quantidade * $item->preco_unitario
            ];  
        }),
        'resumo' => [
            'subtotal' => $pedido->total - $pedido->taxa_entrega,
            'taxa_entrega' => $pedido->taxa_entrega,
            'desconto' => 0, // Altere se tiver desconto
            'total' => $pedido->total
        ],
        'observacoes' => $pedido->observacoes
    ]);
}
}


