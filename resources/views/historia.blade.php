<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossa História | PizzaNight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/historia.css')}}">
</head>
<body class="historia-page">
    <div class="historia-container">
        <header class="historia-header">
            <h1 class="glitch-effect">NOSSA HISTÓRIA</h1>
            <p>Da escuridão surgiu a melhor pizzaria temática!</p>
        </header>

        <div class="timeline">
            <!-- Item 1 -->
            <div class="timeline-item neon-border">
                <div class="timeline-year">2010</div>
                <h3>O Início</h3>
                <p>Tudo começou em um pequeno restaurante abandonado, onde transformamos o medo em diversão.</p>
            </div>
            
            <!-- Item 2 -->
            <div class="timeline-item neon-border">
                <div class="timeline-year">2015</div>
                <h3>Os Primeiros Animatrônicos</h3>
                <p>Freddy, Bonnie, Chica e Foxy se juntaram à nossa equipe, trazendo vida à pizzaria.</p>
            </div>
            
            <!-- Item 3 -->
            <div class="timeline-item neon-border">
                <div class="timeline-year">2020</div>
                <h3>Expansão</h3>
                <p>Inauguramos nossa cozinha industrial e triplicamos nosso cardápio de terror.</p>
            </div>
        </div>

        <h2 style="margin-top: 80px; text-align: center; color: var(--amarelo)">NOSSA EQUIPE</h2>
        
        <div class="animatronics-grid">
            <!-- Card 1 -->
            <div class="animatronic-card">
                <img src="{{url('images/bonnieHome.gif')}}" alt="Bonnie">
                <h3>Bonnie</h3>
                <p>O guitarrista roxo que adora pizza de calabresa</p>
            </div>
            
            <!-- Card 2 -->
            <div class="animatronic-card">
                <img src="{{url('images/ChicaHome.gif')}}" alt="Chica">
                <h3>Chica</h3>
                <p>A chef de cozinha especialista em pizzas doces</p>
            </div>
            
            <!-- Card 3 -->
            <div class="animatronic-card">
                <img src="{{url('images/freddyPedido.gif')}}" alt="Freddy">
                <h3>Freddy</h3>
                <p>O líder da banda e mestre das pizzas especiais</p>
            </div>

            <!-- Card 4 -->
            <div class="animatronic-card">
                <img src="{{url('images/Foxy-Historia.gif')}}" alt="Freddy">
                <h3>Foxy</h3>
                <p>O Grande dono da atração Pirate Cove</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 50px;">
            <a href="/" class="btn-voltar">VOLTAR PARA HOME</a>
        </div>
    </div>



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