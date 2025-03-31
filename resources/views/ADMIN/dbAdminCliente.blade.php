<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes | PizzaNight Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/admClientes.css')}}">
</head>

<body>
    <div class="container-admin">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-pizza-slice"></i>
                <h1>PizzaNight</h1>
            </div>
            <nav>
                <a href="/admin/dbAdmin"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a href="/admin/dbAdminCardapio"><i class="fas fa-utensils"></i> Cardápio</a>
                <a href="/admin/dbAdminPedido"><i class="fas fa-clipboard-list"></i> Pedidos</a>
                <a href="/admin/dbAdminCliente" class="active"><i class="fas fa-users"></i> Clientes</a>
            </nav>
        </aside>

        <!-- Conteúdo Principal -->
        <main class="conteudo-principal">
            <!-- Topbar -->
            <header class="topbar">
                <div class="breadcrumb">
                    <span>Clientes</span>
                    <small>Total: 128 clientes</small>
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

            <!-- Barra de Controle -->
            <div class="controle-clientes">


                <div class="filtros">
                    <div class="busca">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar cliente...">
                    </div>
                    <select class="filtro-status">
                        <option value="todos">Todos os Clientes</option>
                        <option value="ativo">Ativos</option>
                        <option value="inativo">Inativos</option>
                        <option value="fidelidade">Clientes Fidelidade</option>
                    </select>
                    <button class="btn-exportar">
                        <i class="fas fa-file-export"></i> Exportar
                    </button>
                </div>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="estatisticas-clientes">
                <div class="estatistica-card">
                    <div class="estatistica-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="estatistica-info">
                        <h3>Novos (7 dias)</h3>
                        <p>12</p>
                        <span class="variacao positivo"><i class="fas fa-arrow-up"></i> 8%</span>
                    </div>
                </div>
                <div class="estatistica-card">
                    <div class="estatistica-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="estatistica-info">
                        <h3>Fidelidade</h3>
                        <p>24</p>
                        <span class="variacao positivo"><i class="fas fa-arrow-up"></i> 15%</span>
                    </div>
                </div>
                <div class="estatistica-card">
                    <div class="estatistica-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="estatistica-info">
                        <h3>Este Mês</h3>
                        <p>28</p>
                        <span class="variacao negativo"><i class="fas fa-arrow-down"></i> 5%</span>
                    </div>
                </div>
            </div>

            <!-- Tabela de Clientes -->
            <div class="tabela-wrapper">
                <table class="tabela-clientes">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Contato</th>
                            <th>Pedidos</th>
                            <th>Fidelidade</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Cliente 1 -->
                        <tr>
                            <td>#1001</td>
                            <td>
                                <div class="cliente-info">
                                    <img src="img/clientes/cliente1.jpg" alt="João Silva" class="cliente-avatar">
                                    <div class="cliente-detalhes">
                                        <div class="cliente-nome">João Silva</div>
                                        <div class="cliente-email">joao.silva@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contato-info">
                                    <div class="contato-telefone"><i class="fas fa-phone"></i> (11) 98765-4321</div>
                                    <div class="contato-endereco"><i class="fas fa-map-marker-alt"></i> São Paulo/SP</div>
                                </div>
                            </td>
                            <td>
                                <div class="pedidos-info">
                                    <div class="pedidos-total">15 pedidos</div>
                                    <div class="pedidos-valor">R$ 1.245,80</div>
                                </div>
                            </td>
                            <td>
                                <div class="fidelidade-badge gold">
                                    <i class="fas fa-crown"></i> Gold
                                </div>
                            </td>
                            <td>
                                <div class="status-badge ativo">Ativo</div>
                            </td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-detalhes" title="Detalhes">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-acao btn-mensagem" title="Enviar Mensagem">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Cliente 2 -->
                        <tr>
                            <td>#1002</td>
                            <td>
                                <div class="cliente-info">
                                    <img src="img/clientes/cliente2.jpg" alt="Maria Souza" class="cliente-avatar">
                                    <div class="cliente-detalhes">
                                        <div class="cliente-nome">Maria Souza</div>
                                        <div class="cliente-email">maria.souza@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contato-info">
                                    <div class="contato-telefone"><i class="fas fa-phone"></i> (11) 91234-5678</div>
                                    <div class="contato-endereco"><i class="fas fa-map-marker-alt"></i> São Paulo/SP</div>
                                </div>
                            </td>
                            <td>
                                <div class="pedidos-info">
                                    <div class="pedidos-total">8 pedidos</div>
                                    <div class="pedidos-valor">R$ 623,50</div>
                                </div>
                            </td>
                            <td>
                                <div class="fidelidade-badge silver">
                                    <i class="fas fa-award"></i> Silver
                                </div>
                            </td>
                            <td>
                                <div class="status-badge ativo">Ativo</div>
                            </td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-detalhes" title="Detalhes">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    </button>
                                    <button class="btn-acao btn-mensagem" title="Enviar Mensagem">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="paginacao">
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

    <!-- Modal Detalhes do Cliente -->
    <div class="modal" id="modalCliente">
        <div class="modal-conteudo">
            <span class="fechar-modal">&times;</span>
            <h2><i class="fas fa-user"></i> Detalhes do Cliente</h2>

            <div class="detalhes-cliente">
                <div class="cliente-header">
                    <div class="cliente-perfil">
                        <img id="clienteFoto" src="" alt="Foto do cliente" class="cliente-foto">
                        <div class="cliente-status">
                            <span id="clienteStatus" class="status-badge"></span>
                            <span id="clienteFidelidade" class="fidelidade-badge"></span>
                        </div>
                    </div>
                    <div class="cliente-info">
                        <h3 id="clienteNome">Nome do Cliente</h3>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <span id="clienteEmail">email@exemplo.com</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <span id="clienteTelefone">(00) 00000-0000</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span id="clienteEndereco">Endereço do cliente</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span id="clienteCadastro">Cadastrado em: 00/00/0000</span>
                        </div>
                    </div>
                </div>

                <div class="cliente-tabs">
                    <button class="tab-btn ativo" data-tab="pedidos">Pedidos</button>
                    <button class="tab-btn" data-tab="favoritos">Favoritos</button>
                    <button class="tab-btn" data-tab="mensagem">Enviar Mensagem</button>
                </div>

                <div class="tab-conteudo ativo" id="pedidos">
                    <div class="resumo-pedidos">
                        <div class="resumo-item">
                            <span>Total de Pedidos:</span>
                            <span id="totalPedidos">0</span>
                        </div>
                        <div class="resumo-item">
                            <span>Valor Total:</span>
                            <span id="valorTotal">R$ 0,00</span>
                        </div>
                        <div class="resumo-item">
                            <span>Ticket Médio:</span>
                            <span id="ticketMedio">R$ 0,00</span>
                        </div>
                    </div>

                    <h3>Últimos Pedidos</h3>
                    <div class="lista-pedidos" id="listaPedidos">
                        <!-- Pedidos serão inseridos via JavaScript -->
                    </div>
                </div>

                <div class="tab-conteudo" id="favoritos">
                    <h3>Sabores Favoritos</h3>
                    <div class="lista-favoritos" id="listaFavoritos">
                        <!-- Favoritos serão inseridos via JavaScript -->
                    </div>
                </div>

                <div class="tab-conteudo" id="mensagem">
                    <h3>Enviar Mensagem</h3>
                    <form id="formMensagem">
                        <div class="form-group">
                            <label for="assuntoMensagem">Assunto</label>
                            <select id="assuntoMensagem" class="form-control">
                                <option value="promocao">Promoções</option>
                                <option value="fidelidade">Programa de Fidelidade</option>
                                <option value="pedido">Status do Pedido</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="textoMensagem">Mensagem</label>
                            <textarea id="textoMensagem" rows="5" placeholder="Digite sua mensagem..." class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-primario">
                                <i class="fas fa-paper-plane"></i> Enviar Mensagem
                            </button>
                        </div>
                    </form>
                </div>

                <div class="acoes-modal">
                    <button class="btn-secundario btn-fechar">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/modalCliente.js"></script>
    <script src="JS/filtro.js"></script>
    <script src="JS/busca.js"></script>
    <script src="{{url('js/modalCliente.js')}}"></script>
    <script src="{{url('js/filtro.js')}}"></script>
    <script src="{{url('js/busca.js')}}"></script>
</body>

</html>