// Função para aplicar o tema
function applyTheme() {
    const savedTheme = localStorage.getItem('pizzaNightTheme');
    if (savedTheme === 'fnaf3') {
        document.body.classList.add('fnaf3-theme');
        updateThemeButton(true);
        replaceAnimatronics(true);
    }
}

// Função para alternar temas
function toggleTheme() {
    const body = document.body;
    const isFNAF3 = !body.classList.contains('fnaf3-theme');
    
    if (isFNAF3) {
        triggerSpringtrapJumpscare();
    } else {
        body.classList.remove('fnaf3-theme');
        localStorage.setItem('pizzaNightTheme', 'default');
        updateThemeButton(false);
        replaceAnimatronics(false);
    }
}

// Função do jumpscare
function triggerSpringtrapJumpscare() {
    const springtrapOverlay = document.getElementById('springtrapOverlay');
    const jumpscareSound = document.getElementById('jumpscareSound');
    
    // Mostra o jumpscare
    springtrapOverlay.style.opacity = '1';
    jumpscareSound.currentTime = 0;
    jumpscareSound.play();
    
    // Esconde após 0.8 segundos
    setTimeout(() => {
        springtrapOverlay.style.opacity = '0';
        
        // Aplica o tema FNAF 3
        document.body.classList.add('fnaf3-theme');
        localStorage.setItem('pizzaNightTheme', 'fnaf3');
        updateThemeButton(true);
        replaceAnimatronics(true);
    }, 700);
}

// Atualiza o botão de tema
function updateThemeButton(isFNAF3) {
    const themeButton = document.getElementById('themeButton');
    if (themeButton) {
        themeButton.innerHTML = isFNAF3 ? '<i class="fas fa-undo"></i>' : '<i class="fas fa-ghost"></i>';
    }
}

// Substitui os animatrônicos
function replaceAnimatronics(enableFNAF3) {
    const bonnie = document.querySelector('.hero-image');
    const balloon = document.querySelector('.image-wrapper .animatronic');
    
    const bonnieImage = enableFNAF3 ? "{{ url('images/phantom-bonnie.gif') }}" : "{{ url('images/bonnieHome.gif') }}";
    const balloonImage = enableFNAF3 ? "{{ url('images/phantom-bb.gif') }}" : "{{ url('images/ballonHome.gif') }}";


    if (enableFNAF3) {
        if (bonnie) bonnie.src = bonnieImage;
        if (balloon) {
            balloon.src = 'img/phantom-bb.gif';
            balloon.style.transform = 'scaleX(1)';
        }
    } else {
        if (bonnie) bonnie.src = 'img/bonnieHome.gif';
        if (balloon) {
            balloon.src = 'img/ballonHome.gif';
            balloon.style.transform = 'scaleX(-1)';
        }
    }
}

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    applyTheme();
    
    // Configura o botão de tema
    const themeButton = document.getElementById('themeButton');
    if (themeButton) {
        themeButton.addEventListener('click', toggleTheme);
    }
});

function replaceAnimatronics(enableFNAF3) {
    // Animatrônicos da página de história
    const bonnieHistoria = document.querySelector('.animatronic-card img[alt="Bonnie"]');
    const chicaHistoria = document.querySelector('.animatronic-card img[alt="Chica"]');
    const freddyHistoria = document.querySelector('.animatronic-card img[alt="Freddy"]');
    
    if (enableFNAF3) {
        if (bonnieHistoria) bonnieHistoria.src = 'img/phantom-bonnie-historia.gif';
        if (chicaHistoria) chicaHistoria.src = 'img/phantom-chica-historia.gif';
        if (freddyHistoria) freddyHistoria.src = 'img/phantom-freddy-historia.gif';
    } else {
        if (bonnieHistoria) bonnieHistoria.src = 'img/bonnie-historia.gif';
        if (chicaHistoria) chicaHistoria.src = 'img/chica-historia.gif';
        if (freddyHistoria) freddyHistoria.src = 'img/freddy-historia.gif';
    }
}

function replaceAnimatronics(enableFNAF3) {
    // Elementos específicos da página de pedido
    const pizzaGlow = document.querySelector('.pizza-glow');
    
    if (enableFNAF3) {
        if (pizzaGlow) {
            pizzaGlow.style.background = 'radial-gradient(circle, rgba(74, 114, 74, 0.3) 0%, transparent 70%)';
        }
    } else {
        if (pizzaGlow) {
            pizzaGlow.style.background = 'radial-gradient(circle, rgba(216, 29, 241, 0.3) 0%, transparent 70%)';
        }
    }
}