<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - PizzaNight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
   
    <link rel="stylesheet" href="{{url('css/cardapio.css')}}">
</head>
<body>
    
    <header>
        <div class="interface">
            <div class="logo">
                <a href="/">
                    <i class="fas fa-pizza-slice"></i>
                    <p>PizzaNight</p>
                </a>
            </div><!--Logo-->

            <nav class="menu-desktop">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/menu">Cardápio</a></li>
                    <li><a href="#">Dúvidas Frequentes</a></li>
                    <li><a href="#">Sobre nós</a></li>
                </ul>
            </nav>

            <div class="btn-contato">
                <a href="/login">
                    <button>Login</button>
                </a>
            </div><!--Btn-Contato-->
        </div><!--Interface-->
    </header>

    <div class="bannerInicio">
        <div class="titulo-container">
            <h3 class="titulo-destaque">CARDÁPIO</h3>
            <div class="decoracao-horror">
                <span class="risco-left"></span>
                <span class="icone-pizza">🍕</span>
                <span class="risco-right"></span>
            </div>
            <p class="subtitulo">Escolha seu sabor preferido</p>
        </div>
    </div>
    <div class="NossoCardapio">
        <div class="topoCardapio">
            <input type="text" name="" id="" placeholder="Buscar Pizza...">
            
            <div>
                <select name="" id="">
                    <option value="" disabled selected>Filtrar</option>
                    <option value="todos">Todos</option>
                    <option value="salgados">Salgados</option>
                    <option value="especiais">Especiais</option>
                    <option value="doces">Doces</option>
                </select>
            </div>
        </div>

        <div class="conteudoCardapio">
            <!-- Exemplo de card completo -->
          

            @foreach ($pizzas as $pizza)
            <div class="CardBase">
                <div class="topoCard">
                    <img src="{{url('uploads/' . $pizza->imgPizza)}}" alt="Pizza Hmm, Papa">
                    <div class="detalhes-pizza" >
                        <input type="hidden" value="{{$pizza->id}}">
                        <span class="preco">R$ {{$pizza->valorMediaPizza}}</span>
                        <span class="tamanho">{{$pizza->categoriaPizza}}</span>
                    </div>
                </div>
                <div class="baixoCard">
                    <h1>{{$pizza->nomePizza}}</h1>
                    <p class="ingredientes">{{$pizza->ingredientesPizza}}</p>
                    <a href='{{route('pedido.create', ['id' =>$pizza->id])}}' class="btn-pedir">Pedir Agora</a>
                </div> 
            </div>
            
            @endforeach
  


        </div>
    </div>
<!-- Botão de Troca de Tema -->
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

</body>
</html>