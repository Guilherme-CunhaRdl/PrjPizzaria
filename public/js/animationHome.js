// Seleciona a imagem da esquerda
const imagemEsquerda = document.querySelector('.imagem-esquerda');

// Configura o Intersection Observer
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) { // Se a seção estiver visível
            imagemEsquerda.style.animation = 'aparecerDaEsquerda 1.5s ease-out forwards'; // Aplica a animação
            observer.unobserve(entry.target); // Para de observar após a animação ser aplicada
        }
    });
}, {
    threshold: 0.7 // Dispara quando 70% da seção estiver visível
});

// Observa a seção "Sobre Nós"
const sobreNosSecao = document.querySelector('.sobre-nos');
if (sobreNosSecao) {
    observer.observe(sobreNosSecao);
}