document.addEventListener('DOMContentLoaded', function() {
    // Seleção de tamanho da pizza
    const tamanhoButtons = document.querySelectorAll('.btn-tamanho');
    const itemTamanho = document.querySelector('.item-tamanho');
    const precoPizza = document.querySelector('.preco-pizza');
    const totalPedido = document.querySelector('.total-pedido');
    
    // Preços
    const precoBase = 49.90;
    const taxaEntrega = 8.00;
    
    // Função para atualizar o preço
    function atualizarPreco(tamanho, preco) {
        // Atualiza o tamanho exibido
        itemTamanho.textContent = tamanho;
        
        // Atualiza o preço da pizza
        precoPizza.textContent = preco.toFixed(2).replace('.', ',');
        
        // Calcula o total
        const total = parseFloat(preco) + taxaEntrega;
        totalPedido.textContent = total.toFixed(2).replace('.', ',');
        
        // Atualiza o botão ativo
        tamanhoButtons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.textContent.toLowerCase() === tamanho.toLowerCase()) {
                btn.classList.add('active');
            }
        });
    }
    
    // Event listeners para os botões de tamanho
    tamanhoButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const tamanho = this.textContent;
            const preco = parseFloat(this.getAttribute('data-preco'));
            atualizarPreco(tamanho, preco);
        });
    });
    
    // Inicializa com o tamanho médio selecionado
    const tamanhoMedioBtn = document.querySelector('.btn-tamanho.active');
    if (tamanhoMedioBtn) {
        const tamanho = tamanhoMedioBtn.textContent;
        const preco = parseFloat(tamanhoMedioBtn.getAttribute('data-preco'));
        atualizarPreco(tamanho, preco);
    }
    
    // Validação do formulário
    const formPedido = document.querySelector('.form-pedido');
    if (formPedido) {
        formPedido.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validação simples
            const nome = document.getElementById('nome').value;
            const endereco = document.getElementById('endereco').value;
            const telefone = document.getElementById('telefone').value;
            const pagamento = document.getElementById('pagamento').value;
            
            if (!nome || !endereco || !telefone || !pagamento) {
                alert('Por favor, preencha todos os campos obrigatórios!');
                return;
            }
            
            // Simulação de envio do pedido
            alert('Pedido confirmado com sucesso! Obrigado pela sua compra.');
            // Aqui você pode adicionar o código para enviar o pedido para o servidor
        });
    }
});

// Função para abrir o modal de detalhes com os tamanhos
document.querySelectorAll('.btn-detalhes').forEach(btn => {
    btn.addEventListener('click', function() {
        const pedidoRow = this.closest('tr');
        const pedidoId = pedidoRow.querySelector('td:first-child').textContent;
        const clienteInfo = pedidoRow.querySelector('.cliente-info');
        
        // Preencher informações básicas
        document.getElementById('pedidoId').textContent = pedidoId;
        document.getElementById('clienteNome').textContent = clienteInfo.querySelector('.cliente-nome').textContent;
        document.getElementById('clienteTelefone').textContent = clienteInfo.querySelector('.cliente-telefone').textContent;
        
        // Preencher itens do pedido
        const itensPedidoBody = document.getElementById('itensPedidoBody');
        itensPedidoBody.innerHTML = '';
        
        // Obter itens do pedido (simulação - na prática você buscaria esses dados)
        const itens = [
            { nome: 'Pizza Margherita', tamanho: 'Média', quantidade: 1, preco: 49.90 },
            { nome: 'Coca-Cola', quantidade: 2, preco: 9.90 }
        ];
        
        let subtotal = 0;
        
        itens.forEach(item => {
            const row = document.createElement('tr');
            const totalItem = item.quantidade * item.preco;
            subtotal += totalItem;
            
            row.innerHTML = `
                <td>${item.nome}${item.tamanho ? ` (${item.tamanho})` : ''}</td>
                <td>${item.quantidade}</td>
                <td>R$ ${item.preco.toFixed(2).replace('.', ',')}</td>
                <td>R$ ${totalItem.toFixed(2).replace('.', ',')}</td>
            `;
            
            itensPedidoBody.appendChild(row);
        });
        
        // Calcular totais
        const taxaEntrega = 8.00;
        document.getElementById('pedidoSubtotal').textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
        document.getElementById('pedidoTaxa').textContent = `R$ ${taxaEntrega.toFixed(2).replace('.', ',')}`;
        document.getElementById('pedidoTotal').textContent = `R$ ${(subtotal + taxaEntrega).toFixed(2).replace('.', ',')}`;
        
        // Mostrar modal
        document.getElementById('modalPedido').style.display = 'flex';
    });
});