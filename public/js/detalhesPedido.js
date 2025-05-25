
document.querySelectorAll('.btn-cancelar').forEach(btn => {
    btn.addEventListener('click', function() {
        const pedidoId = this.closest('tr').querySelector('td:first-child').textContent;
        document.getElementById('modalCancelarPedido').style.display = 'flex';
        // Aqui você pode atualizar os dados do modal com as informações do pedido
    });
});

// Modal de Alterar Status
document.querySelectorAll('.status-select').forEach(select => {
    select.addEventListener('change', function() {
        const pedidoId = this.closest('tr').querySelector('td:first-child').textContent;
        const clienteNome = this.closest('tr').querySelector('.cliente-nome').textContent;
        
        document.getElementById('clienteNomeStatus').textContent = clienteNome;
        document.getElementById('novoStatus').value = this.value;
        document.getElementById('modalAlterarStatus').style.display = 'flex';
    });
});

// Modal de Impressão
document.querySelectorAll('.btn-imprimir').forEach(btn => {
    btn.addEventListener('click', function() {
        const pedidoId = this.closest('tr').querySelector('td:first-child').textContent;
        document.getElementById('modalImprimir').style.display = 'flex';
        // Aqui você pode atualizar o preview com os dados do pedido
    });
});

// Fechar modais
document.querySelectorAll('.fechar-modal, .btn-fechar').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('.modal').style.display = 'none';
    });
});

// Mostrar campo "Outro motivo" quando selecionado
document.getElementById('motivoCancelamento').addEventListener('change', function() {
    document.getElementById('outroMotivoContainer').style.display = 
        this.value === 'outro' ? 'block' : 'none';
});





