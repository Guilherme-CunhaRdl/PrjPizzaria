<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido - PizzaNight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/pedido.css')}}">
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
                <h2 class="titulo-pedido">FINALIZAR PEDIDO</h2>
            </div>

            <div class="conteudo-pedido">
                <!-- Coluna da Pizza -->
                <div class="pizza-column">
                    <div class="pizza-image-container">
                        <img src="{{url('uploads/' . $pizza->imgPizza)}}" alt="Pizza selecionada" class="pizza-image">
                        <div class="pizza-glow"></div>
                    </div>
                    <h3 class="pizza-name">{{$pizza->nomePizza}}</h3>
                    <p class="pizza-ingredients">{{$pizza->ingredientesPizza}}</p>
                    
                    <div class="tamanho-container">
                        <h4>ESCOLHA O TAMANHO:</h4>
                        <div class="tamanho-options">
                            <button class="btn-tamanho" data-tamanho="pequena" data-preco="{{$pizza->valorPequenaPizza}}">Pequena</button>
                            <button class="btn-tamanho active" data-tamanho="media" data-preco="{{$pizza->valorMediaPizza}}">Média</button>
                            <button class="btn-tamanho" data-tamanho="grande" data-preco="{{$pizza->valorGrandePizza}}">Grande</button>
                        </div>
                    </div>
                </div>
                
                <!-- Coluna do Formulário -->
                <div class="form-column">
                    <form class="form-pedido">
                        <div class="form-group">
                            <label for="nome">Nome completo</label>
                            <input type="text" id="nome" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="endereco">Endereço de entrega</label>
                            <input type="text" id="endereco" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="tel" id="telefone" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pagamento">Forma de pagamento</label>
                            <select id="pagamento" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="cartao">Cartão</option>
                                <option value="pix">PIX</option>
                            </select>
                        </div>
                        
                        <div class="observacoes-group">
                            <label for="observacoes">Observações</label>
                            <textarea id="observacoes" rows="3"></textarea>
                        </div>
                        
                        <div class="resumo-pedido">
                            <h4>RESUMO DO PEDIDO</h4>
                            <div class="resumo-item">
                                <span class="item-nome">1x Pizza {{$pizza->nomePizza}} (<span class="item-tamanho">Média</span>)</span>
                                <span class="item-preco">R$ <span class="preco-pizza">49,90</span></span>
                            </div>
                            <div class="resumo-item">
                                <span>Taxa de entrega</span>
                                <span>R$ 8,00</span>
                            </div>
                            <div class="resumo-total">
                                <span>TOTAL</span>
                                <span>R$ <span class="total-pedido">57,90</span></span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-confirmar">CONFIRMAR PEDIDO</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <div class="theme-toggle">
    <button id="themeButton" aria-label="Alternar tema FNAF 3">
        <i class="fas fa-ghost"></i>
    </button>
</div>

<!-- Efeito de Jumpscare -->
<div id="springtrapOverlay" class="springtrap-overlay">
    <img src="{{url('images/springtrap-jumpscare2.gif')}}" alt="Springtrap Jumpscare">
    <audio id="jumpscareSound" preload="auto">
        <source src="{{url('sounds/jumpscare.mp3')}}" type="audio/mpeg">
    </audio>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Verifica o tema ao carregar cada página
    const savedTheme = localStorage.getItem('pizzaNightTheme');
    if (savedTheme === 'fnaf3') {
        document.body.classList.add('fnaf3-theme');
        // Adicione outras inicializações necessárias
    }
});
</script>


<script src="{{url('js/tema.js')}}"></script>

    <script src="{{url('js/pedido.js')}}"></script>
</body>
</html>