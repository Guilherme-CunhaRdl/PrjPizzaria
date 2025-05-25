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

document.addEventListener('DOMContentLoaded', function() {
    // Funções auxiliares
    const formatarValor = (valor) => {
        const numero = parseFloat(valor) || 0;
        return numero.toLocaleString('pt-BR', { 
            style: 'currency', 
            currency: 'BRL' 
        });
    };

    const formatarPagamento = (metodo) => {
        const metodos = {
            'credito': 'Cartão (Crédito)',
            'debito': 'Cartão (Débito)',
            'pix': 'PIX',
            'dinheiro': 'Dinheiro'
        };
        return metodos[metodo.toLowerCase()] || metodo;
    };

    // Eventos do modal
    document.querySelectorAll('.btn-detalhes').forEach(btn => {
        btn.addEventListener('click', async function() {
            const linha = this.closest('tr');
            const pedidoId = linha.querySelector('td:first-child').textContent.replace('#', '').trim();
            
            try {
                const response = await fetch(`/pedidos/${pedidoId}/detalhes`);
                if (!response.ok) throw new Error('Erro na API');
                
                const data = await response.json();

                // Preenche dados superiores
                document.getElementById('pedidoId').textContent = `#${pedidoId.padStart(3, '0')}`;
                document.getElementById('clienteNome').textContent = data.cliente?.nome || 'Cliente não informado';
                document.getElementById('clienteTelefone').textContent = data.cliente?.telefone || '--';
                document.getElementById('clienteEndereco').textContent = data.endereco_entrega || 'Retirada no local';

                // Data e hora formatadas
                const dtPedido = new Date(data.created_at);
                document.getElementById('pedidoData').textContent = dtPedido.toLocaleDateString('pt-BR');
                document.getElementById('pedidoHora').textContent = dtPedido.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });

                // Preenche itens
                const tbody = document.getElementById('itensPedidoBody');
                tbody.innerHTML = data.itens?.length ? '' : '<tr><td colspan="4">Nenhum item encontrado</td></tr>';
                
                data.itens?.forEach(item => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${item.nome || 'Item sem nome'} ${item.tamanho ? `(${item.tamanho})` : ''}</td>
                            <td>${item.quantidade || 1}</td>
                            <td>${formatarValor(item.preco_unitario)}</td>
                            <td>${formatarValor((item.quantidade || 1) * (item.preco_unitario || 0))}</td>
                        </tr>
                    `;
                });

                // Resumo financeiro
                document.getElementById('pedidoSubtotal').textContent = formatarValor(data.resumo?.subtotal);
                document.getElementById('pedidoTaxa').textContent = formatarValor(data.resumo?.taxa_entrega);
                document.getElementById('pedidoDesconto').textContent = formatarValor(data.resumo?.desconto || 0);
                document.getElementById('pedidoTotal').textContent = formatarValor(data.resumo?.total);

                // Observações
                document.getElementById('pedidoObservacoes').textContent = data.observacoes || 'Sem observações';

                // Abre o modal com flex
                document.getElementById('modalPedido').style.display = 'flex'; // Alterado para flex

            } catch (error) {
                console.error('Erro:', error);
                alert('Falha ao carregar pedido. Tente novamente.');
            }
        });
    });

    // Fechar modal
    const fecharModal = () => document.getElementById('modalPedido').style.display = 'none';
    document.querySelectorAll('.fechar-modal, .btn-fechar').forEach(el => {
        el.addEventListener('click', fecharModal);
    });
    document.getElementById('modalPedido').addEventListener('click', (e) => {
        if (e.target === document.getElementById('modalPedido')) fecharModal();
    });
});