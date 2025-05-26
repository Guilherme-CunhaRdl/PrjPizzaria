<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <title>Home</title>
</head>
<body>
    
<header>
        <div class="interface">
            <div class="logo">
                <a href="#">
                    <i class="fas fa-pizza-slice"></i>
                    <p>PizzaNight</p>
                </a>
            </div>
    
            <nav class="menu-desktop">
                <ul>
                    <li><a href="/"><i class="fa-solid fa-house"></i>Home</a></li>
                    <li><a href="/menu"><i class="fas fa-utensils"></i>Cardápio</a></li>
                    <li><a href="/historia"><i class="fa-solid fa-building"></i>Nossa historia</a></li>
                </ul>
            </nav>
    
            <nav class="menu-desktop">  
                <ul>
                <li><a href="/perfil" class="active"><i class="fas fa-user"></i> Perfil</a></li>
           </ul></nav>
          
          
    
    </header>


    <section class="compre-agora">
        <div class="container">
            <div class="hero-content">
                <h2>COMPRE AGORA EM NOSSA PIZARIA, COM DESCONTOS ASSUSTADORES</h2>
                <p>Aproveite nossas promoções de terror!</p>
                <a href="/menu" class="botao">Ver Cardápio</a>
            </div>
           
            <img src="{{url('images/bonnieHome.gif')}}"  alt="Bonnie animatrônico" class="hero-image">
        </div>
    </section>


    <section class="sobre-nos">
        <div class="container">
            <div class="content-wrapper">
                
                <div class="image-wrapper">
               
                    <img src="{{url('images/ballonHome.gif')}}" alt="Balloon Boy" class="animatronic">
                    <div class="glow-effect"></div>
                </div>

                <div class="text-content">
                    <h2>A Pizzaria <span>Temática</span></h2>
                    <div class="destaque">
                        <p>Inspirada no universo de Five Nights at Freddy's</p>
                    </div>
                    <p class="descricao">Bem-vindo à PizzaNight, onde a diversão e o suspense se misturam a sabores irresistíveis! Nosso ambiente imersivo traz a atmosfera das pizzarias animatrônicas, com decoração especial e surpresas que vão deixar sua noite emocionante.</p>
                    <a href="/historia" class="btn-saiba-mais">Conheça nossa história</a>
                </div>
            </div>
        </div>
    </section>

   
    <!-- Botão Flutuante -->
    <div class="floating-btn">
        <a href="/menu" aria-label="Pedir agora">
            <span>🍕</span>
            <span class="tooltip">Peça Agora!</span>
        </a>
    </div>

<footer class="rodape">
    <div class="conteudo-rodape">
        <p class="texto-rodape">&copy; 2023 PizzaNight - A Pizzaria Temática de Terror. Todos os direitos reservados.</p>
    </div>
</footer>



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
<script src="{{url('js/saboresHome.js')}}" ></script>
<script  src="{{url('js/animationHome.js')}}"></script>
<script src="{{url('js/script.js')}}"></script>
</body>
</html>