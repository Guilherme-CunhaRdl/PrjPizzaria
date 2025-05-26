<?php
namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pizza;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        // Carrega os pedidos com relacionamentos e trata possíveis valores nulos
        $pedidos = Pedido::with([
            'usuario' => function($query) {
                $query->select('id', 'nomeUsuario'); // Apenas campos necessários
            },
            'itens' => function($query) {
                $query->with(['pizza' => function($q) {
                    $q->select('id', 'nomePizza')->withDefault([
                        'nomePizza' => '[Produto Removido]'
                    ]);
                }]);
            }
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    
        // Contagem por status em uma única consulta (mais eficiente)
        $contagemStatus = Pedido::selectRaw('
            COUNT(CASE WHEN status = "pendente" THEN 1 END) as pendente,
            COUNT(CASE WHEN status = "preparo" THEN 1 END) as preparo,
            COUNT(CASE WHEN status = "entrega" THEN 1 END) as entrega,
            COUNT(CASE WHEN status = "entregue" THEN 1 END) as entregue
        ')->first();
    
        return view('admin.dbAdminPedido', [
            'pedidos' => $pedidos,
            'contagemStatus' => $contagemStatus
        ]);
    }

    public function contagemStatus()
{
    return response()->json([
        'pendente' => Pedido::where('status', 'pendente')->count(),
        'preparo' => Pedido::where('status', 'preparo')->count(),
        'entrega' => Pedido::where('status', 'entrega')->count(),
        'entregue' => Pedido::where('status', 'entregue')->count()
    ]);
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



public function store(Request $request)
{

    \Log::debug('Dados recebidos:', $request->all());
    
    $validated = $request->validate([
        'endereco' => 'required|string',
        'pagamento' => 'required|in:dinheiro,cartao,pix',
        'observacoes' => 'nullable|string',
        'itens' => 'required|array|min:1',
        'itens.*.pizza_id' => 'required|exists:pizzas,id',
        'itens.*.tamanho' => 'required|in:pequena,media,grande',
        'itens.*.preco' => 'required|numeric|min:0',
        'itens.*.quantidade' => 'required|integer|min:1'
    ]);

    // Cria o pedido
    $pedido = Pedido::create([
        'idUsuario' => auth()->id() ?? 1, 
        'total' => array_reduce($validated['itens'], fn($carry, $item) => $carry + ($item['preco'] * $item['quantidade']), 0),
        'taxa_entrega' => 8.00, 
        'endereco_entrega' => $validated['endereco'],
        'metodo_pagamento' => $validated['pagamento'],
        'observacoes' => $validated['observacoes'] ?? null,
        'status' => 'pendente'
    ]);

    // Cria os itens do pedido
    foreach ($validated['itens'] as $item) {
        ItemPedido::create([
            'idPedido' => $pedido->id,
            'idPizza' => $item['pizza_id'],
            'tamanho' => $item['tamanho'],
            'quantidade' => $item['quantidade'],
            'preco_unitario' => $item['preco']
        ]);
    }

    return response()->json([
        'message' => 'Pedido criado com sucesso',
        'pedido_id' => $pedido->id
    ], 201);
}

public function pegarPizzas()
{
    $pizzas = Pizza::where('disponivel', true)->get();
    return view('pedido', compact('pizzas'));
}




public function sucessoPizza($id)
{
    $pedido = Pedido::with(['itens.pizza', 'usuario'])->findOrFail($id);
    return view('pedido-sucesso', compact('pedido'));
}

}


