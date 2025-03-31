document.addEventListener('DOMContentLoaded', function() {
    // Inicializa todos os selects de status
    const statusSelects = document.querySelectorAll('.status-select');
    
    statusSelects.forEach(select => {
        // Configura o valor inicial
        const initialStatus = select.querySelector('option[selected]')?.value || select.value;
        select.value = initialStatus;
        select.className = 'status-select ' + initialStatus;
        
        // Adiciona o evento de change
        select.addEventListener('change', function() {
            atualizarStatus(this);
        });
    });

    // Fecha modais ao clicar fora
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });
});

function atualizarStatus(select) {
    // Remove todas as classes de status
    select.className = 'status-select';
    
    // Adiciona a classe correspondente ao novo status
    const novoStatus = select.value;
    select.classList.add(novoStatus);
    
    const pedidoId = select.closest('tr').querySelector('td:first-child').textContent;
    
    console.log(`Status do pedido ${pedidoId} alterado para: ${novoStatus}`);

}


