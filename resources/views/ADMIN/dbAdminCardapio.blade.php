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
            @foreach($pizzas as $pizza)
            <div class="pizza-card" data-id="{{ $pizza->id }}" 
     data-nome="{{ $pizza->nomePizza }}"
     data-categoria="{{ $pizza->categoriaPizza }}"
     data-ingredientes="{{ $pizza->ingredientesPizza }}"
     data-pequena="{{ $pizza->valorPequenaPizza }}"
     data-media="{{ $pizza->valorMediaPizza }}"
     data-grande="{{ $pizza->valorGrandePizza }}"
     data-imagem="{{ asset('uploads/' . $pizza->imgPizza) }}">
            <div class="pizza-img" style="background-image: url('{{ asset("uploads/" . $pizza->imgPizza) }}');">

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

   <!-- Modal Adicionar -->
   <div class="modal" id="modalAdicionarPizza">
    <div class="modal-conteudo">
        <span class="fechar-modal">&times;</span>
        <h2><i class="fas fa-pizza-slice"></i> Adicionar Nova Pizza</h2>
        
        <form method="POST" action="{{ route('pizzas.store') }}" enctype="multipart/form-data" class="form-pizza" id="formAdicionarPizza">
            @csrf
            
            <div class="form-group">
                <label for="adicionarNome">Nome da Pizza</label>
                <input type="text" id="adicionarNome" name="nomePizza" placeholder="Ex: Margherita" required>
            </div>
            
            <div class="form-group">
                <label for="adicionarCategoria">Categoria</label>
                <select name="categoriaPizza" id="adicionarCategoria" required>
                    <option value="Salgada">Salgada</option>
                    <option value="Doce">Doce</option>
                    <option value="Especial">Especial</option>
                </select>
            </div>
            
            <div class="form-tamanhos">
                <h4>Tamanhos e Preços</h4>
                
                <div class="tamanho-item">
                    <label>Pequena (P)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input name="valorPequenaPizza" type="number" id="adicionarPrecoPequena" step="0.01" placeholder="39.90" min="0" required>
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Média (M)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" name="valorMediaPizza" id="adicionarPrecoMedia" step="0.01" placeholder="49.90" min="0" required>
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Grande (G)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" name="valorGrandePizza" id="adicionarPrecoGrande" step="0.01" placeholder="59.90" min="0" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="adicionarIngredientes">Ingredientes</label>
                <textarea name="ingredientesPizza" id="adicionarIngredientes" placeholder="Liste os ingredientes separados por vírgula" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="adicionarImagem">Imagem da Pizza</label>
                <input type="file" id="adicionarImagem" name="imgPizza" accept="image/*" required>
                <div id="adicionarImagemPreview" class="imagem-preview"></div>
            </div>
            
            <div class="form-options">
                <label class="checkbox-option">
                    <input type="checkbox" name="destaque" id="adicionarDestaque" value="1">
                    <span class="checkmark"></span>
                    Destacar no cardápio
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" name="promocao" id="adicionarPromocao" value="1">
                    <span class="checkmark"></span>
                    Marcar como promoção
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" name="disponivel" id="adicionarDisponivel" value="1" checked>
                    <span class="checkmark"></span>
                    Disponível
                </label>
            </div>
            
            <div class="form-botoes">
                <button type="button" class="btn-secundario btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-primario">Adicionar Pizza</button>
            </div>
        </form>
    </div>
</div>



<!-- Modal de Edição -->
<div class="modal" id="modalEditarPizza">
    <div class="modal-conteudo">
        <span class="fechar-modal">&times;</span>
        <h2><i class="fas fa-pizza-slice"></i> Editar Pizza</h2>
        
        <form method="POST" action="{{ url('/admin/pizzas') }}" enctype="multipart/form-data" class="form-pizza" id="formEditarPizza">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="editarPizzaId">

            <div class="form-group">
                <label for="editarNome">Nome da Pizza</label>
                <input type="text" id="editarNome" name="nomePizza" placeholder="Ex: Margherita" required>
            </div>
            
            <div class="form-group">
                <label for="editarCategoria">Categoria</label>
                <select name="categoriaPizza" id="editarCategoria">
                    <option value="Salgada">Salgada</option>
                    <option value="Doce">Doce</option>
                    <option value="Especial">Especial</option>
                </select>
            </div>
            
            <div class="form-tamanhos">
                <h4>Tamanhos e Preços</h4>
                
                <div class="tamanho-item">
                    <label>Pequena (P)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input name="valorPequenaPizza" type="number" id="editarPrecoPequena" step="0.01" placeholder="39.90" min="0">
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Média (M)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" name="valorMediaPizza" id="editarPrecoMedia" step="0.01" placeholder="49.90" min="0">
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Grande (G)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" name="valorGrandePizza" id="editarPrecoGrande" step="0.01" placeholder="59.90" min="0">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="editarIngredientes">Ingredientes</label>
                <textarea name="ingredientesPizza" id="editarIngredientes" placeholder="Liste os ingredientes separados por vírgula"></textarea>
            </div>
            
            <div class="form-group">
                <label for="editarImagem">Imagem da Pizza</label>
                <input type="file" id="editarImagem" name="imgPizza" accept="image/*">
                <div id="editarImagemPreview" class="imagem-preview"></div>
                <input type="hidden" id="editarImagemAtual">
            </div>
            
            <div class="form-options">
                <label class="checkbox-option">
                    <input type="checkbox" name="destaque" id="editarDestaque" value="1">
                    <span class="checkmark"></span>
                    Destacar no cardápio
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" name="promocao" id="editarPromocao" value="1">
                    <span class="checkmark"></span>
                    Marcar como promoção
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" name="disponivel" id="editarDisponivel" value="1">
                    <span class="checkmark"></span>
                    Disponível
                </label>
            </div>
            
            <div class="form-botoes">
                <button type="button" class="btn-secundario btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-primario">Atualizar Pizza</button>
            </div>
        </form>
    </div>
</div>
    

    <script src="{{url('js/filtro.js')}}"></script>
    <script src="{{url('js/cardapio.js')}}"></script>
</body>
</html>