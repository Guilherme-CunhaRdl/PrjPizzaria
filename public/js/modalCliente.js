
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona elementos
    const modalCliente = document.getElementById('modalCliente');
    const btnFecharModal = document.querySelector('.fechar-modal');
    const btnFechar = document.querySelector('.btn-fechar');
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-conteudo');
    
    // Botões de detalhes e mensagem na tabela
    const btnsDetalhes = document.querySelectorAll('.btn-detalhes');
    const btnsMensagem = document.querySelectorAll('.btn-mensagem');
    
    // Abrir modal ao clicar em Detalhes
    btnsDetalhes.forEach(btn => {
        btn.addEventListener('click', function() {
            const clienteRow = this.closest('tr');
            preencherModalCliente(clienteRow);
            abrirModal('pedidos');
        });
    });
    
    // Abrir modal direto na aba de mensagem
    btnsMensagem.forEach(btn => {
        btn.addEventListener('click', function() {
            const clienteRow = this.closest('tr');
            preencherModalCliente(clienteRow);
            abrirModal('mensagem');
        });
    });
    
    // Fechar modal
    btnFecharModal.addEventListener('click', fecharModal);
    btnFechar.addEventListener('click', fecharModal);
    
    // Trocar abas
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            trocarAba(tabId);
        });
    });
    
    // Enviar mensagem
    document.getElementById('formMensagem').addEventListener('submit', function(e) {
        e.preventDefault();
        const assunto = document.getElementById('assuntoMensagem').value;
        const mensagem = document.getElementById('textoMensagem').value;
        
        // Aqui você implementaria o envio da mensagem
        alert(`Mensagem enviada para ${document.getElementById('clienteNome').textContent}!\nAssunto: ${assunto}\nMensagem: ${mensagem}`);
        
        // Limpar formulário
        this.reset();
    });
    
    // Funções
    function abrirModal(aba = 'pedidos') {
        modalCliente.style.display = 'flex';
        trocarAba(aba);
    }
    
    function fecharModal() {
        modalCliente.style.display = 'none';
    }
    
    function trocarAba(tabId) {
        // Remove classe ativa de todos os botões e conteúdos
        tabBtns.forEach(btn => btn.classList.remove('ativo'));
        tabContents.forEach(content => content.classList.remove('ativo'));
        
        // Adiciona classe ativa ao botão e conteúdo selecionado
        document.querySelector(`.tab-btn[data-tab="${tabId}"]`).classList.add('ativo');
        document.getElementById(tabId).classList.add('ativo');
    }
    
    function preencherModalCliente(clienteRow) {
        // Obtém os dados da linha da tabela
        const id = clienteRow.querySelector('td:first-child').textContent;
        const nome = clienteRow.querySelector('.cliente-nome').textContent;
        const email = clienteRow.querySelector('.cliente-email').textContent;
        const telefone = clienteRow.querySelector('.contato-telefone').textContent.replace('(i class="fas fa-phone"></i> ', '');
        const endereco = clienteRow.querySelector('.contato-endereco').textContent.replace('(i class="fas fa-map-marker-alt"></i> ', '');
        const foto = clienteRow.querySelector('.cliente-avatar').src;
        const status = clienteRow.querySelector('.status-badge').textContent.toLowerCase();
        const fidelidade = clienteRow.querySelector('.fidelidade-badge').textContent.trim();
        const fidelidadeClass = clienteRow.querySelector('.fidelidade-badge').className.split(' ')[1];
        const totalPedidos = clienteRow.querySelector('.pedidos-total').textContent;
        const valorTotal = clienteRow.querySelector('.pedidos-valor').textContent;
        
        // Calcula ticket médio
        const numPedidos = parseInt(totalPedidos.replace(' pedidos', '').replace(' pedido', ''));
        const valorNumerico = parseFloat(valorTotal.replace('R$ ', '').replace('.', '').replace(',', '.'));
        const ticketMedio = numPedidos > 0 ? (valorNumerico / numPedidos).toFixed(2).replace('.', ',') : '0,00';
        
        // Preenche os dados no modal
        document.getElementById('clienteFoto').src = foto;
        document.getElementById('clienteNome').textContent = nome;
        document.getElementById('clienteEmail').textContent = email;
        document.getElementById('clienteTelefone').textContent = telefone;
        document.getElementById('clienteEndereco').textContent = endereco;
        document.getElementById('clienteCadastro').textContent = `Cadastrado em: ${new Date().toLocaleDateString()}`;
        
        // Status e fidelidade
        const statusBadge = document.getElementById('clienteStatus');
        statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        statusBadge.className = `status-badge ${status}`;
        
        const fidelidadeBadge = document.getElementById('clienteFidelidade');
        fidelidadeBadge.textContent = fidelidade;
        fidelidadeBadge.className = `fidelidade-badge ${fidelidadeClass}`;
        
        // Pedidos
        document.getElementById('totalPedidos').textContent = totalPedidos;
        document.getElementById('valorTotal').textContent = valorTotal;
        document.getElementById('ticketMedio').textContent = `R$ ${ticketMedio}`;
        
        // Aqui você poderia adicionar lógica para preencher os pedidos e favoritos
        // com dados reais da sua aplicação
    }
    
    // Fechar modal ao clicar fora do conteúdo
    window.addEventListener('click', function(e) {
        if (e.target === modalCliente) {
            fecharModal();
        }
    });
});