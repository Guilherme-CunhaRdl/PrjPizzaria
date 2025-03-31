document.addEventListener('DOMContentLoaded', function() {
    const themeButton = document.getElementById('themeButton');
    const springtrapOverlay = document.getElementById('springtrapOverlay');
    const jumpscareSound = document.getElementById('jumpscareSound');
    
    // Verifica se já tem um tema salvo
    const savedTheme = localStorage.getItem('pizzaNightTheme');
    if (savedTheme === 'fnaf3') {
        document.body.classList.add('fnaf3-theme');
        themeButton.innerHTML = '<i class="fas fa-undo"></i>';
        replaceAnimatronics(true);
    }
    
    themeButton.addEventListener('click', function() {
        if (document.body.classList.contains('fnaf3-theme')) {
            // Volta ao tema normal
            document.body.classList.remove('fnaf3-theme');
            localStorage.setItem('pizzaNightTheme', 'default');
            themeButton.innerHTML = '<i class="fas fa-ghost"></i>';
            replaceAnimatronics(false);
        } else {
            // Ativa o tema FNAF 3 com jumpscare
            triggerSpringtrapJumpscare();
        }
    });
    
    function triggerSpringtrapJumpscare() {
        // Mostra o Springtrap rapidamente
        springtrapOverlay.style.opacity = '1';
        jumpscareSound.currentTime = 0;
        jumpscareSound.play();
        
        // Esconde após 0.8 segundos (susto rápido)
        setTimeout(() => {
            springtrapOverlay.style.opacity = '0';
            
            // Aplica o tema FNAF 3
            document.body.classList.add('fnaf3-theme');
            localStorage.setItem('pizzaNightTheme', 'fnaf3');
            themeButton.innerHTML = '<i class="fas fa-undo"></i>';
            replaceAnimatronics(true);
        }, 700);
    }
    function replaceAnimatronics(enableFNAF3) {
        const bonnie = document.querySelector('.hero-image');
        const balloon = document.querySelector('.image-wrapper .animatronic');
        
        if (enableFNAF3) {
            if (bonnie) bonnie.src = 'img/phantom-bonnie.gif';
            if (balloon) {
                balloon.src = 'img/phantom-bb.gif';
                balloon.style.transform = 'scaleX(1) translateY(0)'; // Mantém a animação
            
            }
        } else {
            if (bonnie) bonnie.src = 'img/bonnieHome.gif';
            if (balloon) {
                balloon.src = 'img/ballonHome.gif';
                balloon.style.transform = 'scaleX(-1)'; // Volta ao normal
            }
        }
    }
    localStorage.setItem('pizzaNightTheme', enableFNAF3 ? 'fnaf3' : 'default');
});