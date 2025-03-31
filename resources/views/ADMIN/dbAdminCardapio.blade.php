<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio | PizzaNight Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/admCardapio.css')}}">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-pizza-slice"></i>
            <h1>PizzaNight</h1>
        </div>
        <nav>
            <a href="/admin/dbAdmin" ><i class="fas fa-chart-pie"></i> Dashboard</a>
            <a href="/admin/dbAdminCardapio" class="active"><i class="fas fa-utensils"></i> Cardápio</a>
            <a href="/admin/dbAdminPedido"><i class="fas fa-clipboard-list"></i> Pedidos</a>
            <a href="/admin/dbAdminCliente"><i class="fas fa-users"></i> Clientes</a>
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="breadcrumb">
                <span>Cardápio</span>
                <small>Total: 15 itens</small>
            </div>
            <div class="user-area">
                <div class="notificacao">
                    <i class="fas fa-bell"></i>
                    <span class="badge">2</span>
                </div>
                <div class="user">
                    <span>Admin</span>
                    <img src="{{url('images\logo.png')}}" alt="Admin">
                </div>
            </div>
        </header>

        <!-- Barra de Controle -->
        <div class="controle-cardapio">
            <button class="btn-primario" id="btnNovaPizza">
                <i class="fas fa-plus"></i> Nova Pizza
            </button>
            
            <div class="filtros">
                <div class="busca">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar por nome...">
                </div>
                <select class="filtro-categoria">
                    <option value="todos">Todas Categorias</option>
                    <option value="salgadas">Salgadas</option>
                    <option value="doces">Doces</option>
                    <option value="especiais">Especiais</option>
                </select>
                <select class="filtro-status">
                    <option value="todos">Todos Status</option>
                    <option value="disponivel">Disponíveis</option>
                    <option value="esgotado">Esgotados</option>
                    <option value="destaque">Em Destaque</option>
                </select>
            </div>
        </div>

        <!-- Grid de Pizzas -->
        <div class="pizza-grid">
            <!-- Pizza 1 -->
            <div class="pizza-card destaque">
                <div class="pizza-img" style="background-image: url('img/pizza-margherita.jpg');">
                    <span class="badge-destaque"><i class="fas fa-star"></i> Destaque</span>
                </div>
                <div class="pizza-info">
                    <div class="pizza-header">
                        <h3>Margherita</h3>
                        <span class="categoria salgada">Salgada</span>
                    </div>
                    <p class="ingredientes">Molho de tomate, mussarela fresca, manjericão</p>
                    <div class="pizza-footer">
                        <div class="preco-tamanhos">
                            <span class="tamanho-preco">P: R$ 39,90</span>
                            <span class="tamanho-preco">M: R$ 49,90</span>
                            <span class="tamanho-preco">G: R$ 59,90</span>
                        </div>
                        <div class="status disponivel">Disponível</div>
                    </div>
                    <div class="pizza-acoes">
                        <button class="btn-acao btn-editar" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-acao btn-ativar" title="Desativar">
                            <i class="fas fa-toggle-on"></i>
                        </button>
                        <button class="btn-acao btn-excluir" title="Excluir">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pizza 2 -->
            <div class="pizza-card">
            <div class="pizza-img" style="background-image: url('{{ asset('images/pizza.png') }}');">
            <span class="badge-esgotado"><i class="fas fa-times-circle"></i> Esgotado</span>
                </div>
                <div class="pizza-info">
                    <div class="pizza-header">
                        <h3>Calabresa</h3>
                        <span class="categoria salgada">Salgada</span>
                    </div>
                    <p class="ingredientes">Molho de tomate, mussarela, calabresa, cebola</p>
                    <div class="pizza-footer">
                        <div class="preco-tamanhos">
                            <span class="tamanho-preco">P: R$ 45,90</span>
                            <span class="tamanho-preco">M: R$ 54,90</span>
                            <span class="tamanho-preco">G: R$ 61,90</span>
                        </div>
                        <div class="status disponivel">Disponível</div>
                    </div>
                    <div class="pizza-acoes">
                        <button class="btn-acao btn-editar" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-acao btn-ativar" title="Ativar">
                            <i class="fas fa-toggle-off"></i>
                        </button>
                        <button class="btn-acao btn-excluir" title="Excluir">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>


            @foreach($pizzas as $pizza)
            <div class="pizza-card">
            <div class="pizza-img" style="background-image: url('{{ asset("uploads/" . $pizza->imgPizza) }}');">
            <span class="badge-esgotado"><i class="fas fa-times-circle"></i> Esgotado</span>
                </div>
                <div class="pizza-info">
                    <div class="pizza-header">
                        <h3>{{$pizza->nomePizza}}</h3>
                        <span class="categoria salgada">{{$pizza->categoriaPizza}}</span>
                    </div>
                    <p class="ingredientes">{{$pizza->ingredientesPizza}}</p>
                    <div class="pizza-footer">
                        <div class="preco-tamanhos">
                            <span class="tamanho-preco">P: R$ {{$pizza->valorPequenaPizza}}</span>
                            <span class="tamanho-preco">M: R$ {{$pizza->valorMediaPizza}}</span>
                            <span class="tamanho-preco">G: R$ {{$pizza->valorGrandePizza}}</span>
                        </div>
                        <div class="status disponivel">Disponível</div>
                    </div>
                    <div class="pizza-acoes">
                        <button class="btn-acao btn-editar" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-acao btn-ativar" title="Ativar">
                            <i class="fas fa-toggle-off"></i>
                        </button>
                        <button class="btn-acao btn-excluir" title="Excluir">
                        <a href="{{route('deletarPizza', ['id' =>$pizza->id])}}"> <i class="fas fa-trash"></i></a>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pizza 3 -->
            <div class="pizza-card">
                <div class="pizza-img" style="background-image: url('img/pizza-chocolate.jpg');">
                    <span class="badge-promocao"><i class="fas fa-tag"></i> Promoção</span>
                </div>
                <div class="pizza-info">
                    <div class="pizza-header">
                        <h3>Chocolate</h3>
                        <span class="categoria doce">Doce</span>
                    </div>
                    <p class="ingredientes">Chocolate ao leite, morangos, granulado</p>
                    <div class="pizza-footer">
                        <div class="preco">
                            <div class="preco-tamanhos">
                                <span class="tamanho-preco">P:  <span class="preco-antigo">R$ 39,90 </span>  R$ 34,90</span>                 
                                <span class="tamanho-preco">M: R$ 49,90</span>
                                <span class="tamanho-preco">G: R$ 59,90</span>
                            </div>
                            <div class="status disponivel">Disponível</div>
       
                        </div>
                    </div>
                    <div class="pizza-acoes">
                        <button class="btn-acao btn-editar" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-acao btn-ativar" title="Desativar">
                            <i class="fas fa-toggle-on"></i>
                        </button>
                        <button class="btn-acao btn-excluir" title="Excluir">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
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

   <!-- Modal Adicionar/Editar Pizza -->
<div class="modal" id="modalPizza">
    <div class="modal-conteudo">
        <span class="fechar-modal">&times;</span>
        <h2><i class="fas fa-pizza-slice"></i> <span id="modalTitulo">Adicionar Nova Pizza</span></h2>
        
        <form method="POST" action="{{ url('/admin/dbBosta') }}" enctype="multipart/form-data" class="form-pizza" >
            @csrf
            <input type="hidden" id="pizzaId">

            <div class="form-group">
                <label for="nome">Nome da Pizza</label>
                <input type="text" id="pizzaNome" name="nomePizza" placeholder="Ex: Margherita" required>
            </div>
            
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoriaPizza" id="pizzaCategoria">
                    <option value="Salgada">Salgada</option>
                    <option value="Doce">Doce</option>
                    <option value="Especial">Especial</option>
                </select>
            </div>
            
            <!-- Nova seção para tamanhos e preços -->
            <div class="form-tamanhos">
                <h4>Tamanhos e Preços</h4>
                
                <div class="tamanho-item">
                    <label>Pequena (P)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input name="valorPequenaPizza" type="number" id="precoPequena" step="0.01" placeholder="39.90" min="0">
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Média (M)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" name="valorMediaPizza" id="precoMedia" step="0.01" placeholder="49.90" min="0">
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Grande (G)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" name="valorGrandePizza" id="precoGrande" step="0.01" placeholder="59.90" min="0">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <textarea name="ingredientesPizza" id="pizzaIngredientes" placeholder="Liste os ingredientes separados por vírgula"></textarea>
            </div>
            
            <div class="form-group">
                <label for="imagem">Imagem da Pizza</label>
                <input type="file" id="pizzaImagem" name="imgPizza" accept="image/*" required>
                <div id="imagemPreview" class="imagem-preview"></div>
                <input type="hidden"  id="pizzaImagemAtual">
            </div>
            
            <div class="form-options">
                <label class="checkbox-option">
                    <input type="checkbox" id="pizzaDestaque">
                    <span class="checkmark"></span>
                    Destacar no cardápio
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" id="pizzaPromocao">
                    <span class="checkmark"></span>
                    Marcar como promoção
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" id="pizzaDisponivel" checked>
                    <span class="checkmark"></span>
                    Disponível
                </label>
            </div>
            
            <div class="form-botoes">
                <button type="button" class="btn-secundario btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-primario" id="btnSalvarPizza">Salvar Pizza</button>
            </div>
        </form>
    </div>
</div>

    

    <script src="{{url('js/filtro.js')}}"></script>
    <script src="{{url('js/cardapio.js')}}"></script>
</body>
</html>