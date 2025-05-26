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


function atualizarResumoPedidos() {
    fetch('/pedidos/contagem-status')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.resumo-card:nth-child(1) p').textContent = data.pendente;
            document.querySelector('.resumo-card:nth-child(2) p').textContent = data.preparo;
            document.querySelector('.resumo-card:nth-child(3) p').textContent = data.entrega;
            document.querySelector('.resumo-card:nth-child(4) p').textContent = data.entregue;
        });
}

setInterval(atualizarResumoPedidos, 30000);


//CARINHO DOS PEDIDOS

document.addEventListener('DOMContentLoaded', function() {
    const carrinho = [];
    
    // Função para atualizar o carrinho
    function atualizarCarrinho() {
        const itensContainer = document.getElementById('itensPedido');
        let html = '';
        let subtotal = 0;

        if (carrinho.length === 0) {
            html = `
                <div class="vazio-message">
                    <i class="fas fa-pizza-slice"></i>
                    <p>Adicione pizzas ao seu pedido</p>
                </div>
            `;
        } else {
            carrinho.forEach((item, index) => {
                subtotal += item.preco * item.quantidade;
                html += `
                    <div class="item-carrinho">
                        <div class="item-info">
                            <span>${item.quantidade}x ${item.nome} (${item.tamanho})</span>
                            <span>R$ ${(item.preco * item.quantidade).toFixed(2).replace('.', ',')}</span>
                        </div>
                        <button class="btn-remover" data-index="${index}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
            });
        }

        itensContainer.innerHTML = html;
        document.querySelector('.subtotal').textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
        const total = subtotal + 8.00; // Taxa de entrega
        document.querySelector('.total-final').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;

        // Adiciona eventos aos botões de remover
        document.querySelectorAll('.btn-remover').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = this.dataset.index;
                carrinho.splice(index, 1);
                atualizarCarrinho();
            });
        });
    }

    // Adicionar pizza ao carrinho
    document.querySelectorAll('.btn-adicionar').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const pizzaCard = this.closest('.pizza-card');
            const pizzaId = pizzaCard.dataset.id;
            const pizzaNome = pizzaCard.querySelector('h4').textContent;
            const tamanho = pizzaCard.querySelector('.btn-tamanho.active').dataset.tamanho;
            const preco = parseFloat(pizzaCard.querySelector('.btn-tamanho.active').dataset.preco);
            const quantidade = parseInt(pizzaCard.querySelector('.input-quantidade').value);
            
            carrinho.push({
                id: pizzaId,
                nome: pizzaNome,
                tamanho,
                preco,
                quantidade
            });
            
            atualizarCarrinho();
            // Resetar quantidade
            pizzaCard.querySelector('.input-quantidade').value = 1;
        });
    });


 

    // Controles de quantidade
    document.querySelectorAll('.btn-quantidade').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.input-quantidade');
            let value = parseInt(input.value);
            
            if (this.classList.contains('menos')) {
                input.value = value > 1 ? value - 1 : 1;
            } else {
                input.value = value < 10 ? value + 1 : 10;
            }
        });
    });

    // Seleção de tamanho
    document.querySelectorAll('.btn-tamanho').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            this.parentElement.querySelectorAll('.btn-tamanho').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});







/*ENVIAR PEDIDO*/
document.addEventListener('DOMContentLoaded', function() {
    // Elementos principais
    const formPedido = document.querySelector('.form-pedido');
    const itensPedido = [];
    
    if (!formPedido) {
        console.error('Formulário de pedido não encontrado!');
        return;
    }

    // Adicionar pizza ao pedido
    document.querySelectorAll('.btn-adicionar').forEach(btn => {
        btn.addEventListener('click', function() {
            const pizzaCard = this.closest('.pizza-card');
            if (!pizzaCard) return;
            
            const pizzaId = pizzaCard.dataset.id;
            const pizzaNome = pizzaCard.querySelector('h4')?.textContent;
            const tamanhoBtn = pizzaCard.querySelector('.btn-tamanho.active');
            
            if (!tamanhoBtn) return;
            
            const tamanho = tamanhoBtn.dataset.tamanho;
            const preco = parseFloat(tamanhoBtn.dataset.preco);
            const quantidadeInput = pizzaCard.querySelector('.input-quantidade');
            const quantidade = quantidadeInput ? parseInt(quantidadeInput.value) : 1;
            
            if (!pizzaId || !pizzaNome || !tamanho || isNaN(preco) || isNaN(quantidade)) {
                console.error('Dados da pizza inválidos');
                return;
            }
            
            itensPedido.push({
                pizza_id: pizzaId,
                nome: pizzaNome,
                tamanho: tamanho,
                preco: preco,
                quantidade: quantidade
            });
            
            atualizarResumoPedido();
        });
    });
    
    // Atualizar resumo do pedido
    function atualizarResumoPedido() {
        const container = document.getElementById('itensPedido');
        if (!container) return;
        
        if(itensPedido.length === 0) {
            container.innerHTML = `
                <div class="vazio-message">
                    <i class="fas fa-pizza-slice"></i>
                    <p>Adicione pizzas ao seu pedido</p>
                </div>
            `;
            return;
        }
        
        let html = '';
        let subtotal = 0;
        
        itensPedido.forEach(item => {
            const totalItem = item.preco * item.quantidade;
            subtotal += totalItem;
            
            html += `
                <div class="item-pedido" data-id="${item.idPizza}" data-tamanho="${item.tamanho}">
                    <div class="info-item">
                        <span class="nome-item">${item.nome} (${item.tamanho})</span>
                        <span class="preco-item">R$ ${item.preco.toFixed(2).replace('.', ',')}</span>
                    </div>
                    <div class="controle-item">
                        <span class="quantidade-item">${item.quantidade}x</span>
                        <button class="btn-remover"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `;
        });
        
        const taxaEntrega = 8.00;
        const total = subtotal + taxaEntrega;
        
        container.innerHTML = html;
        
        // Atualizar totais
        const subtotalElement = document.querySelector('.subtotal');
        const totalElement = document.querySelector('.total-final');
        
        if (subtotalElement) subtotalElement.textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
        if (totalElement) totalElement.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
        
        // Adiciona eventos aos botões de remover
        document.querySelectorAll('.btn-remover').forEach((btn, index) => {
            btn.addEventListener('click', function() {
                itensPedido.splice(index, 1);
                atualizarResumoPedido();
            });
        });
    }
    
    // Enviar pedido
    formPedido.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if(itensPedido.length === 0) {
            alert('Adicione pelo menos uma pizza ao pedido!');
            return;
        }
        
        const endereco = document.getElementById('endereco')?.value;
        const metodoPagamento = document.getElementById('pagamento')?.value;
        const observacoes = document.getElementById('observacoes')?.value;
        
        if (!endereco || !metodoPagamento) {
            alert('Preencha todos os campos obrigatórios!');
            return;
        }
        
        const subtotalText = document.querySelector('.subtotal')?.textContent;
        const totalText = document.querySelector('.total-final')?.textContent;
        
        if (!subtotalText || !totalText) {
            console.error('Não foi possível calcular o total');
            return;
        }
        const idUsuario = document.getElementById('idUsuario')?.value;

        const pedido = {
            idUsuario: idUsuario,
            itens: itensPedido,
            endereco: endereco,
            pagamento: metodoPagamento,
            observacoes: observacoes || '',
            subtotal: parseFloat(subtotalText.replace('R$ ', '').replace(',', '.')),
            taxaEntrega: 8.00,
            total: parseFloat(totalText.replace('R$ ', '').replace(',', '.'))
        };
        
        try {
            const response = await fetch('/menu/pedido/sucesso', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(pedido)
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Erro ao processar pedido');
            }
            
            const data = await response.json();
            alert('Pedido realizado com sucesso! Nº ' + data.pedido_id);
            window.location.href = '/menu';
        } catch (error) {
            console.error('Erro:', error);
            alert('Erro ao realizar pedido: ' + error.message);
        }
    });
    
    // Inicialização
    atualizarResumoPedido();
});