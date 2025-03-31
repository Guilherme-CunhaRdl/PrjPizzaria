document.addEventListener('DOMContentLoaded', function() {
    // Seleção de tamanho
    const tamanhoBtns = document.querySelectorAll('.btn-tamanho');
    
    tamanhoBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tamanhoBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Atualizar preço no resumo (simulação)
            const precoBase = 49.90;
            let precoFinal = precoBase;
            
            if(this.textContent.includes('Pequena')) {
                precoFinal = precoBase - 10;
            } else if(this.textContent.includes('Grande')) {
                precoFinal = precoBase + 15;
            }
            
            document.querySelector('.resumo-item span:first-child').textContent = 
                `1x Pizza HMM, PAPA (${this.textContent})`;
                
            document.querySelector('.resumo-item span:last-child').textContent = 
                `R$ ${precoFinal.toFixed(2)}`;
                
            document.querySelector('.resumo-total span:last-child').textContent = 
                `R$ ${(precoFinal + 8).toFixed(2)}`;
        });
    });
    
    // Formulário de pedido
    const formPedido = document.querySelector('.form-pedido');
    
    formPedido.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulação de envio
        alert('Pedido confirmado! Obrigado por escolher a PizzaNight!');
        window.location.href = 'index.html';
    });
});