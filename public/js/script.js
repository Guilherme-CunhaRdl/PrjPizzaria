// Carrossel de Sabores
document.addEventListener('DOMContentLoaded', function() {
    const sabores = [
        { nome: "Margherita", descricao: "Molho de tomate, mussarela fresca e manjericão" },
        { nome: "Calabresa", descricao: "Molho de tomate, mussarela, calabresa e cebola" },
        { nome: "Pepperoni", descricao: "Molho de tomate, mussarela e pepperoni" },
        { nome: "Frango Catupiry", descricao: "Molho de tomate, frango desfiado e catupiry" },
        { nome: "Portuguesa", descricao: "Molho de tomate, mussarela, presunto, ovo, cebola e azeitona" },
        { nome: "Quatro Queijos", descricao: "Molho de tomate, mussarela, provolone, parmesão e gorgonzola" }
    ];

    const carrossel = document.querySelector('.cards-sabores');
    
    sabores.forEach(sabor => {
        const card = document.createElement('div');
        card.className = 'sabor';
        card.innerHTML = `
            <h3>${sabor.nome}</h3>
            <p>${sabor.descricao}</p>
        `;
        carrossel.appendChild(card);
    });

    // Configuração do carrossel
    let currentIndex = 0;
    const items = document.querySelectorAll('.sabor');
    const totalItems = items.length;
    
    function updateCarrossel() {
        const offset = -currentIndex * (items[0].offsetWidth + 20);
        carrossel.style.transform = `translateX(${offset}px)`;
    }
    
    window.moverCarrossel = function(direction) {
        currentIndex = (currentIndex + direction + totalItems) % totalItems;
        updateCarrossel();
    };
    
    // Inicialização
    updateCarrossel();
    
    // Efeito de hover nos cards
    items.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.style.transform = 'translateY(-10px) rotateX(5deg)';
            item.style.boxShadow = '0 15px 30px rgba(216, 29, 241, 0.5)';
        });
        
        item.addEventListener('mouseleave', () => {
            item.style.transform = 'translateY(0) rotateX(0)';
            item.style.boxShadow = '0 5px 15px rgba(216, 29, 241, 0.3)';
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const carrossel = document.querySelector('.cards-container');
    const btnEsquerda = document.querySelector('.seta.esquerda');
    const btnDireita = document.querySelector('.seta.direita');
    
    btnEsquerda.addEventListener('click', () => {
        carrossel.scrollBy({ left: -300, behavior: 'smooth' });
    });
    
    btnDireita.addEventListener('click', () => {
        carrossel.scrollBy({ left: 300, behavior: 'smooth' });
    });
});