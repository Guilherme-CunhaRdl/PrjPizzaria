<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pedidos | PizzaNight Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{url('css/admPedidos.css')}}">
</head>

<body>
    <div class="container-admin">
        <!-- Menu Lateral -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-pizza-slice"></i>
                <h1>PizzaNight</h1>
            </div>
            <nav>
                <a href="/admin/dbAdmin"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a href="/admin/dbAdminCardapio"><i class="fas fa-utensils"></i> Cardápio</a>
                <a href="/admin/dbAdminPedido" class="active"><i class="fas fa-clipboard-list"></i> Pedidos</a>
                <a href="/admin/dbAdminCliente"><i class="fas fa-users"></i> Clientes</a>
            </nav>
        </aside>

        <!-- Conteúdo Principal -->
        <main class="conteudo-principal">
            <!-- Topbar -->
            <header class="topbar">
                <div class="breadcrumb">
                    <span>Pedidos</span>
                    <small>Total: 24 pedidos</small>
                </div>
                <div class="user-area">
                    <div class="notificacao">
                        <i class="fas fa-bell"></i>
                        <span class="badge">5</span>
                    </div>
                    <div class="user">
                        <span>Admin</span>
                        <img src="{{url('images\logo.png')}}" alt="Admin">
                    </div>
                </div>
            </header>

            <!-- Filtros Avançados -->
            <div class="filtros-avancados">
                <div class="filtro-group">
                    <div class="busca">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar pedido...">
                    </div>
                    <select class="filtro-status">
                        <option value="todos">Todos os Status</option>
                        <option value="pendente">Pendentes</option>
                        <option value="preparo">Em Preparo</option>
                        <option value="entrega">Em Entrega</option>
                        <option value="entregue">Entregues</option>
                        <option value="cancelado">Cancelados</option>
                    </select>
                    <input type="date" class="filtro-data" value="2024-06-10">
                </div>
                <div class="filtro-group">
                    <button class="btn-filtro ativo">Hoje</button>
                    <button class="btn-filtro">Últimos 7 dias</button>
                    <button class="btn-filtro">Este Mês</button>
                    <button class="btn-exportar">
                        <i class="fas fa-file-export"></i> Exportar
                    </button>
                </div>
            </div>

            <!-- Cards de Resumo -->
            <div class="resumo-pedidos">
                <div class="resumo-card">
                    <div class="resumo-icon pendente">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="resumo-info">
                        <h3>Pendentes</h3>
                        <p>8</p>
                    </div>
                </div>
                <div class="resumo-card">
                    <div class="resumo-icon preparo">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="resumo-info">
                        <h3>Em Preparo</h3>
                        <p>5</p>
                    </div>
                </div>
                <div class="resumo-card">
                    <div class="resumo-icon entrega">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <div class="resumo-info">
                        <h3>Em Entrega</h3>
                        <p>3</p>
                    </div>
                </div>
                <div class="resumo-card">
                    <div class="resumo-icon entregue">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="resumo-info">
                        <h3>Entregues</h3>
                        <p>15</p>
                    </div>
                </div>
            </div>

            <!-- Tabela de Pedidos -->
            <div class="tabela-wrapper">
                <table class="tabela-pedidos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Data/Hora</th>
                            <th>Itens</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>#{{ str_pad($pedido->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="cliente-info">
                            <img src="{{asset("uploads/".$pedido->usuario->imgUsuario) }}" 
                                 alt="{{ $pedido->usuario->nomeUsuario }}" class="cliente-avatar">
                            <div>
                                <div class="cliente-nome">{{ $pedido->usuario->nomeUsuario }}</div>
                                <div class="cliente-telefone">{{ $pedido->usuario->telefone ?? 'Não informado' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $pedido->created_at->format('d/m/Y') }}<br>
                        {{ $pedido->created_at->format('H:i') }}
                    </td>
                    <td>
                        <div class="lista-itens">
                            @foreach($pedido->itens as $item)
                            <div class="item-pedido">
                                <span class="item-quantidade">{{ $item->quantidade }}x</span>
                                <span class="item-nome">{{ $item->pizza->nomePizza }}</span>
                                @if($item->tamanho)
                                <span class="item-tamanho">{{ ucfirst($item->tamanho) }}</span>
                                @endif
                                <span class="item-preco">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>
                    </td>
                    <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                                    <td>
                    <div class="status-container">
                        <select class="status-select {{ $pedido->status }}" data-pedido-id="{{ $pedido->id }}">
                            <option value="pendente" {{ $pedido->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="preparo" {{ $pedido->status == 'preparo' ? 'selected' : '' }}>Em Preparo</option>
                            <option value="entrega" {{ $pedido->status == 'entrega' ? 'selected' : '' }}>Em Entrega</option>
                            <option value="entregue" {{ $pedido->status == 'entregue' ? 'selected' : '' }}>Entregue</option>
                            <option value="cancelado" {{ $pedido->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                </td>
                    <td>
                        <div class="acoes">
                            <button class="btn-acao btn-detalhes" title="Detalhes">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-acao btn-imprimir" title="Imprimir">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="btn-acao btn-cancelar" title="Cancelar">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="paginacao">
            {{ $pedidos->links() }}
                <button class="btn-pagina" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn-pagina ativo">1</button>
                <button class="btn-pagina">2</button>
                <button class="btn-pagina">3</button>
                <button class="btn-pagina">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </main>
    </div>


    <!-- Modal Detalhes do Pedido -->
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
                    <button class="btn-primario" id="btnImprimir">
                        <i class="fas fa-print"></i> Imprimir Comanda
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="modalCancelarPedido">
        <div class="modal-conteudo">
            <span class="fechar-modal">&times;</span>
            <h2><i class="fas fa-exclamation-triangle"></i> Cancelar Pedido</h2>

            <div class="modal-body">
                <p>Tem certeza que deseja cancelar o pedido <strong>#001</strong> do cliente <strong>João Silva</strong>?</p>

                <div class="form-group">
                    <label for="motivoCancelamento">Motivo do cancelamento:</label>
                    <select id="motivoCancelamento" class="form-select">
                        <option value="">Selecione um motivo</option>
                        <option value="cliente">Solicitação do cliente</option>
                        <option value="estoque">Falta de ingredientes</option>
                        <option value="entrega">Problema na entrega</option>
                        <option value="outro">Outro motivo</option>
                    </select>
                </div>

                <div class="form-group" id="outroMotivoContainer" style="display:none;">
                    <label for="outroMotivo">Especifique o motivo:</label>
                    <textarea id="outroMotivo" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-secundario btn-fechar">Voltar</button>
                <button class="btn-perigo" id="confirmarCancelamento">
                    <i class="fas fa-times-circle"></i> Confirmar Cancelamento
                </button>
            </div>
        </div>
    </div>


    <div class="modal" id="modalImprimir">
        <div class="modal-conteudo modal-imprimir">
            <span class="fechar-modal">&times;</span>
            <h2><i class="fas fa-print"></i> Opções de Impressão</h2>

            <div class="modal-body">
                <div class="opcoes-impressao">
                    <button class="btn-opcao-impressao active" data-tipo="comanda">
                        <i class="fas fa-utensils"></i>
                        <span>Comanda Cozinha</span>
                    </button>

                    <button class="btn-opcao-impressao" data-tipo="nota">
                        <i class="fas fa-receipt"></i>
                        <span>Nota Fiscal</span>
                    </button>

                    <button class="btn-opcao-impressao" data-tipo="entrega">
                        <i class="fas fa-motorcycle"></i>
                        <span>Ordem de Entrega</span>
                    </button>
                </div>

                <div class="preview-impressao" id="previewComanda">
                    <div class="cabecalho-comanda">
                        <h3>PizzaNight</h3>
                        <p>Pedido: #001 | 10/06/2024 14:30</p>
                        <p>Cliente: João Silva</p>
                    </div>
                    <div class="itens-comanda">
                        <div class="item-comanda">
                            <span>1x Pizza Margherita (Média)</span>
                            <span>R$ 49,90</span>
                        </div>
                        <div class="item-comanda">
                            <span>2x Coca-Cola 2L</span>
                            <span>R$ 19,80</span>
                        </div>
                    </div>
                    <div class="observacoes-comanda">
                        <p><strong>Observações:</strong> Sem cebola na pizza</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn-secundario">
                        <i class="fas fa-download"></i> Salvar PDF
                    </button>
                    <button class="btn-primario" id="imprimirAgora">
                        <i class="fas fa-print"></i> Imprimir Agora
                    </button>
                </div>
            </div>
        </div>
</div>


        <script src="{{url('js/filtro.js')}}"></script>
        <script src="{{url('js/statusPedido.js')}}"></script>
        <script src="{{url('js/pedido.js')}}"></script>
        <script src="{{url('js/detalhesPedido.js')}}"></script>
        <script src="{{url('js/cancelar.js')}}"></script>
</body>

</html>