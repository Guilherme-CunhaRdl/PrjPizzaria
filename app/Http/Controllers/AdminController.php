<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Pizza;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function dbAdminCliente()
    {
        // Consulta principal de clientes
        $clientes = Usuario::select('usuarios.*')
            ->withCount(['pedidos as total_pedidos'])
            ->withSum(['pedidos as valor_total'], 'total')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Cálculo de estatísticas
        $novosClientes = Usuario::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $ultimaSemana = Usuario::whereBetween('created_at', [
            Carbon::now()->subDays(14), 
            Carbon::now()->subDays(7)
        ])->count();

        $variacaoClientes = $ultimaSemana > 0 
            ? (($novosClientes - $ultimaSemana) / $ultimaSemana) * 100
            : ($novosClientes > 0 ? 100 : 0);

        $estatisticas = [
            'novos_clientes' => $novosClientes,
            'variacao_clientes' => $variacaoClientes,
            'clientes_fidelidade' => Usuario::whereHas('pedidos', function($q) {
                $q->where('total', '>', 100);
            })->count(),
            'clientes_mes' => Usuario::whereMonth('created_at', Carbon::now()->month)->count()
        ];

        return view('admin.dbAdminCliente', compact('clientes', 'estatisticas'));
    }

    public function detalhesCliente($id)
    {
        $cliente = Usuario::with(['pedidos' => function($query) {
            $query->orderBy('created_at', 'desc')->limit(5);
        }])->findOrFail($id);

        return response()->json([
            'nome' => $cliente->nomeUsuario,
            'email' => $cliente->emailUsuario,
            'telefone' => $cliente->cpfUsuario ?? 'Não informado',
            'endereco' => $this->formatarEndereco($cliente),
            'data_cadastro' => $cliente->created_at->format('d/m/Y'),
            'total_pedidos' => $cliente->pedidos->count(),
            'valor_total' => $cliente->pedidos->sum('total'),
            'ticket_medio' => $cliente->pedidos->avg('total') ?? 0,
            'pedidos_recentes' => $cliente->pedidos->map(function($pedido) {
                return [
                    'id' => $pedido->id,
                    'data' => $pedido->created_at->format('d/m/Y H:i'),
                    'total' => $pedido->total,
                    'status' => $pedido->status
                ];
            })
        ]);
    }

    private function formatarEndereco($cliente)
    {
        if (!$cliente->logradouroUsuario) {
            return 'Não informado';
        }

        $endereco = [
            $cliente->logradouroUsuario,
            $cliente->numeroUsuario,
            $cliente->bairroUsuario,
            $cliente->cidadeUsuario,
            $cliente->estadoUsuario
        ];

        return implode(', ', array_filter($endereco));
    }


    public function dbAdmin()
    {
        // Dados para os cards de métricas
        $hoje = Carbon::today();
        $ontem = Carbon::yesterday();
        
        $pedidosHoje = Pedido::whereDate('created_at', $hoje)->count();
        $pedidosOntem = Pedido::whereDate('created_at', $ontem)->count();
        $variacaoPedidos = $this->calcularVariacao($pedidosHoje, $pedidosOntem);

        $faturamentoHoje = Pedido::whereDate('created_at', $hoje)->sum('total');
        $faturamentoOntem = Pedido::whereDate('created_at', $ontem)->sum('total');
        $variacaoFaturamento = $this->calcularVariacao($faturamentoHoje, $faturamentoOntem);

        $novosClientes = Usuario::whereDate('created_at', $hoje)->count();
        $novosClientesOntem = Usuario::whereDate('created_at', $ontem)->count();
        $variacaoClientes = $this->calcularVariacao($novosClientes, $novosClientesOntem);

        $pedidosPendentes = Pedido::where('status', 'pendente')->count();

        // Top sabores
        $topSabores = Pizza::select(
            'pizzas.id',
            'pizzas.nomePizza',
            'pizzas.categoriaPizza',
            'pizzas.valorPequenaPizza',
            DB::raw('COUNT(itens_pedido.id) as total_pedidos')
        )
        ->join('itens_pedido', 'pizzas.id', '=', 'itens_pedido.idPizza')
        ->groupBy('pizzas.id', 'pizzas.nomePizza', 'pizzas.categoriaPizza', 'pizzas.valorPequenaPizza')
        ->orderByDesc('total_pedidos')
        ->limit(5)
        ->get();

        // Últimos pedidos
        $ultimosPedidos = Pedido::with(['usuario', 'itens.pizza'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dbAdmin', [
            'metrics' => [
                'pedidos_hoje' => $pedidosHoje,
                'variacao_pedidos' => $variacaoPedidos,
                'faturamento_hoje' => $faturamentoHoje,
                'variacao_faturamento' => $variacaoFaturamento,
                'novos_clientes' => $novosClientes,
                'variacao_clientes' => $variacaoClientes,
                'pedidos_pendentes' => $pedidosPendentes
            ],
            'topSabores' => $topSabores,
            'ultimosPedidos' => $ultimosPedidos
        ]);
    }

    private function calcularVariacao($hoje, $ontem)
    {
        if ($ontem == 0) {
            return $hoje > 0 ? 100 : 0;
        }
        return (($hoje - $ontem) / $ontem) * 100;
    }

    public function detalhesPedido($id)
{
    $pedido = Pedido::with(['usuario', 'itens.pizza'])->findOrFail($id);
    
    return response()->json([
        'id' => $pedido->id,
        'cliente' => [
            'nome' => $pedido->usuario->nomeUsuario,
            'telefone' => $pedido->usuario->cpfUsuario ?? 'Não informado',
            'endereco' => $pedido->endereco_entrega
        ],
        'data' => $pedido->created_at->format('d/m/Y'),
        'hora' => $pedido->created_at->format('H:i'),
        'metodo_pagamento' => ucfirst($pedido->metodo_pagamento),
        'status' => ucfirst($pedido->status),
        'subtotal' => number_format($pedido->total - $pedido->taxa_entrega, 2, ',', '.'),
        'taxa_entrega' => number_format($pedido->taxa_entrega, 2, ',', '.'),
        'total' => number_format($pedido->total, 2, ',', '.'),
        'observacoes' => $pedido->observacoes,
        'itens' => $pedido->itens->map(function($item) {
            return [
                'nome' => $item->pizza->nomePizza,
                'tamanho' => $item->tamanho,
                'quantidade' => $item->quantidade,
                'preco_unitario' => number_format($item->preco_unitario, 2, ',', '.')
            ];
        })
    ]);
}


}
