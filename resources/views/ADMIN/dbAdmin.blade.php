<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | PizzaNight Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/admin.css')}}">
    <link rel="stylesheet" href="{{url('css/admPedidos')}}">
</head>

<body>
    <!-- Sidebar Fixa -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-pizza-slice"></i>
            <h1>PizzaNight</h1>
        </div>
        <nav>
            <a href="/admin/dbAdmin" class="active"><i class="fas fa-chart-pie"></i> Dashboard</a>
            <a href="/admin/dbAdminCardapio"><i class="fas fa-utensils"></i> Cardápio</a>
            <a href="/admin/dbAdminPedido"><i class="fas fa-clipboard-list"></i> Pedidos</a>
            <a href="/admin/dbAdminCliente"><i class="fas fa-users"></i> Clientes</a>
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="main-content">
        <!-- Topbar Fixa -->
        <header class="topbar">
            <div class="breadcrumb">
                <span>Dashboard</span>
                <small>Últimos 7 dias</small>
            </div>
            <div class="user-area">
                <div class="notificacao">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </div>
                <div class="user">
                    <span>Admin</span>
                    <img src="{{url('images\logo.png')}}" alt="Admin">
                </div>
            </div>
        </header>


        <section class="metrics">
    <div class="metric-card primary">
        <div class="icon">
            <i class="fas fa-pizza-slice"></i>
        </div>
        <div class="info">
            <h3>Pedidos Hoje</h3>
            <p>{{ $metrics['pedidos_hoje'] }}</p>
            <span class="variacao {{ $metrics['variacao_pedidos'] >= 0 ? 'positivo' : 'negativo' }}">
                <i class="fas fa-arrow-{{ $metrics['variacao_pedidos'] >= 0 ? 'up' : 'down' }}"></i> 
                {{ number_format(abs($metrics['variacao_pedidos']), 0) }}%
            </span>
        </div>
    </div>
    
    <div class="metric-card success">
        <div class="icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="info">
            <h3>Faturamento</h3>
            <p>R$ {{ number_format($metrics['faturamento_hoje'], 2, ',', '.') }}</p>
            <span class="variacao {{ $metrics['variacao_faturamento'] >= 0 ? 'positivo' : 'negativo' }}">
                <i class="fas fa-arrow-{{ $metrics['variacao_faturamento'] >= 0 ? 'up' : 'down' }}"></i> 
                {{ number_format(abs($metrics['variacao_faturamento']), 0) }}%
            </span>
        </div>
    </div>
    
    <div class="metric-card warning">
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="info">
            <h3>Novos Clientes</h3>
            <p>{{ $metrics['novos_clientes'] }}</p>
            <span class="variacao {{ $metrics['variacao_clientes'] >= 0 ? 'positivo' : 'negativo' }}">
                <i class="fas fa-arrow-{{ $metrics['variacao_clientes'] >= 0 ? 'up' : 'down' }}"></i> 
                {{ number_format(abs($metrics['variacao_clientes']), 0) }}%
            </span>
        </div>
    </div>
    
    <div class="metric-card danger">
        <div class="icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="info">
            <h3>Pendentes</h3>
            <p>{{ $metrics['pedidos_pendentes'] }}</p>
            <span class="variacao">±0%</span>
        </div>
    </div>
</section>

        <!-- Seção de Gráficos -->
        <section class="chart-section">
    <div class="chart-card">
        <div class="chart-header">
            <h3>Vendas Mensais</h3>
            <div class="periodo-filtro">
                <button class="btn-periodo ativo">7 dias</button>
                <button class="btn-periodo">15 dias</button>
                <button class="btn-periodo">30 dias</button>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="vendasChart"></canvas>
        </div>
    </div>

    <div class="chart-card small">
        <div class="chart-header">
            <h3>Top Sabores</h3>
        </div>
        <div class="top-sabores">
            @foreach($topSabores as $sabor)
            <div class="sabor-item">
                <span class="nome">{{ $sabor->nomePizza }}</span>
                <div class="barra-container">
                    <div class="barra" style="width: {{ ($sabor->total_pedidos / $metrics['pedidos_hoje']) * 100 }}%"></div>
                    <span>{{ round(($sabor->total_pedidos / $metrics['pedidos_hoje']) * 100) }}%</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

        <!-- Tabela de Últimos Pedidos -->
        <section class="table-section">
    <div class="table-header">
        <h3>Últimos Pedidos</h3>
        <a href="/admin/dbAdminPedido" class="btn-ver-todos">Ver Todos <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ultimosPedidos as $pedido)
                <tr>
                    <td>#{{ str_pad($pedido->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $pedido->usuario->nomeUsuario }}</td>
                    <td>{{ $pedido->created_at->format('d/m H:i') }}</td>
                    <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td>
                        <span class="status {{ strtolower($pedido->status) }}">{{ $pedido->status }}</span>
                    </td>
                    <td>
                        <button class="btn-acao btn-detalhes" title="Detalhes" data-pedido-id="{{ $pedido->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


   
        <div class="modal" id="modalPedido">
            <div class="modal-conteudo">
                <span class="fechar-modal">&times;</span>
                <h2><i class="fas fa-clipboard-list"></i> Detalhes do Pedido <span id="pedidoId"></span></h2>

                <div class="detalhes-pedido">
                    <div class="detalhes-header">
                        <div class="cliente-info">
                            <img src="" alt="Cliente" class="cliente-avatar" id="clienteAvatar">
                            <div>
                                <h3 id="clienteNome">Nome do Cliente</h3>
                                <p id="clienteTelefone">(00) 00000-0000</p>
                                <p id="clienteEndereco">Endereço de entrega</p>
                            </div>
                        </div>
                        <div class="pedido-info">
                            <div class="info-item">
                                <span class="info-label">Data:</span>
                                <span class="info-value" id="pedidoData"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Hora:</span>
                                <span class="info-value" id="pedidoHora"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pagamento:</span>
                                <span class="info-value" id="pedidoPagamento">Cartão (Crédito)</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Entrega:</span>
                                <span class="info-value" id="pedidoEntrega">Delivery</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="pedidoStatus">Pendente</span>
                            </div>
                        </div>
                    </div>

                    <div class="itens-pedido">
                        <h3>Itens do Pedido</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unit.</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="itensPedidoBody">
                                <!-- Itens serão inseridos aqui pelo JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="resumo-pedido">
                        <div class="resumo-item">
                            <span>Subtotal:</span>
                            <span id="pedidoSubtotal">R$ 0,00</span>
                        </div>
                        <div class="resumo-item">
                            <span>Taxa de Entrega:</span>
                            <span id="pedidoTaxa">R$ 0,00</span>
                        </div>
                        <div class="resumo-item">
                            <span>Desconto:</span>
                            <span id="pedidoDesconto">R$ 0,00</span>
                        </div>

                        <div class="resumo-item total">
                            <span>Total:</span>
                            <span id="pedidoTotal">R$ 0,00</span>
                        </div>
                    </div>

                    <div class="observacoes">
                        <h3>Observações</h3>
                        <p id="pedidoObservacoes">Sem observações adicionais.</p>
                    </div>

                    <div class="acoes-modal">
                        <button class="btn-secundario btn-fechar">Fechar</button>

                    </div>
                </div>
            </div>
        </div>
        <script src="{{url('js/dashboard.js')}}"></script>
        <script src="{{url('js/pedido.js')}}"></script>
        <script src="{{url('js/detalhesPedidoDashboard.js')}}"></script>
</body>

</html>