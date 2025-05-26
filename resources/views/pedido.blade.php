<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Finalizar Pedido - PizzaNight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/pedido.css') }}">
</head>
<body class="pedido-body">
    <header>
        <div class="interface">
            <div class="logo">
                <a href="/">
                    <i class="fas fa-pizza-slice"></i>
                    <p>PizzaNight</p>
                </a>
            </div>
        </div>
    </header>

    <main class="container-pedido">
        <div class="pedido-container">
            <div class="topo-pedido">
                <a href="/menu" class="btn-voltar-pedido">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
                <h2 class="titulo-pedido">MONTE SEU PEDIDO</h2>
            </div>

            <div class="conteudo-pedido">
                <!-- Coluna da Seleção de Pizzas -->
                <div class="pizza-column">
                    <h3 class="titulo-secao"><i class="fas fa-utensils"></i> ESCOLHA SUAS PIZZAS</h3>
                    
                    <div class="pizzas-container">
                        @foreach($pizzas as $pizza)
                        <div class="pizza-card" data-id="{{ $pizza->id }}">
                            <div class="pizza-image-container">
                                <img src="{{ url('uploads/' . $pizza->imgPizza) }}" alt="{{ $pizza->nomePizza }}">
                            </div>
                            <div class="pizza-info">
                                <h4>{{ $pizza->nomePizza }}</h4>
                                <p class="ingredientes">{{ $pizza->ingredientesPizza }}</p>
                                
                                <div class="pizza-opcoes">
                                    <div class="tamanho-options">
                                        <button class="btn-tamanho" data-tamanho="pequena" data-preco="{{ $pizza->valorPequenaPizza }}">
                                            <span>Pequena</span>
                                            <span class="preco-tamanho">R$ {{ number_format($pizza->valorPequenaPizza, 2, ',', '.') }}</span>
                                        </button>
                                        <button class="btn-tamanho active" data-tamanho="media" data-preco="{{ $pizza->valorMediaPizza }}">
                                            <span>Média</span>
                                            <span class="preco-tamanho">R$ {{ number_format($pizza->valorMediaPizza, 2, ',', '.') }}</span>
                                        </button>
                                        <button class="btn-tamanho" data-tamanho="grande" data-preco="{{ $pizza->valorGrandePizza }}">
                                            <span>Grande</span>
                                            <span class="preco-tamanho">R$ {{ number_format($pizza->valorGrandePizza, 2, ',', '.') }}</span>
                                        </button>
                                    </div>
                                    
                                    <div class="quantidade-container">
                                        <button class="btn-quantidade menos">-</button>
                                        <input type="number" class="input-quantidade" value="1" min="1" max="10">
                                        <button class="btn-quantidade mais">+</button>
                                    </div>
                                    
                                    <button class="btn-adicionar">
                                        <i class="fas fa-plus-circle"></i> Adicionar
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Coluna do Resumo do Pedido -->
                <div class="resumo-column">
                    <h3 class="titulo-secao"><i class="fas fa-receipt"></i> RESUMO</h3>
                    
                    <div class="resumo-pedido">
                        <div class="itens-pedido" id="itensPedido">
                            <div class="vazio-message">
                                <i class="fas fa-pizza-slice"></i>
                                <p>Adicione pizzas ao seu pedido</p>
                            </div>
                        </div>
                        
                        <div class="resumo-total">
                            <div class="total-line">
                                <span>Subtotal</span>
                                <span class="subtotal">R$ 0,00</span>
                            </div>
                            <div class="total-line">
                                <span>Taxa de entrega</span>
                                <span class="taxa-entrega">R$ 8,00</span>
                            </div>
                            <div class="total-line highlight">
                                <span>TOTAL</span>
                                <span class="total-final">R$ 8,00</span>
                            </div>
                        </div>
                        
                        <form class="form-pedido" >
                        <input type="hidden" id="idUsuario" value="1">
                            <div class="form-group">
                                <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço de entrega</label>
                                <input type="text" id="endereco" required placeholder="Rua, Número, Bairro">
                            </div>
                            
                            <div class="form-group">
                                <label for="pagamento"><i class="fas fa-credit-card"></i> Pagamento</label>
                                <select id="pagamento" name="pagamento" required>
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="dinheiro">Dinheiro</option>
                                    <option value="cartao">Cartão na Entrega</option>
                                    <option value="pix">PIX</option>
                                </select>
                            </div>
                            
                            <div class="observacoes-group">
                                <label for="observacoes"><i class="fas fa-edit"></i> Observações</label>
                                <textarea id="observacoes" rows="3" placeholder="Ex: Sem cebola, ponto extra..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn-confirmar">
                                <i class="fas fa-check-circle"></i> FINALIZAR PEDIDO
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Elementos de Tema -->
    <div class="theme-toggle">
        <button id="themeButton" aria-label="Alternar tema FNAF 3">
            <i class="fas fa-ghost"></i>
        </button>
    </div>

    <div id="springtrapOverlay" class="springtrap-overlay">
        <img src="{{ url('images/springtrap-jumpscare2.gif') }}" alt="Springtrap Jumpscare">
        <audio id="jumpscareSound" preload="auto">
            <source src="{{ url('sounds/jumpscare.mp3') }}" type="audio/mpeg">
        </audio>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica o tema ao carregar
            const savedTheme = localStorage.getItem('pizzaNightTheme');
            if (savedTheme === 'fnaf3') {
                document.body.classList.add('fnaf3-theme');
            }
        });
    </script>
    
    <script src="{{ url('js/tema.js') }}"></script>
    <script src="{{ url('js/pedido.js') }}"></script>
</body>
</html>