let posicaoAtual = 0;
const totalCards = document.querySelectorAll('.sabor').length;

function moverCarrossel(direcao) {
    const cards = document.querySelector('.cards-sabores');
    const larguraCard = document.querySelector('.sabor').offsetWidth + 20; // Inclui o gap
    let cardsPorVez;

    // Verifica o tamanho da tela para definir quantos cards mover
    if (window.innerWidth <= 767) {
        cardsPorVez = 1; // 1 card por vez em telas menores
    } else {
        cardsPorVez = 3; // 3 cards por vez em telas maiores
    }


    posicaoAtual += direcao * cardsPorVez;

    // Limita o movimento para não ultrapassar os limites
    if (posicaoAtual < 0) {
        posicaoAtual = 0;
    } else if (posicaoAtual > totalCards - cardsPorVez) {
        posicaoAtual = totalCards - cardsPorVez;
    }

    cards.style.transform = `translateX(-${posicaoAtual * larguraCard}px)`;
}