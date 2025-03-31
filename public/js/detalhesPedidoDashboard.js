document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o modal
    const modalPedido = document.getElementById('modalPedido');
    const btnFecharModal = document.querySelector('.fechar-modal');
    const btnFechar = document.querySelector('.btn-fechar');
    
    // Botões de detalhes na tabela da dashboard
    const btnsDetalhes = document.querySelectorAll('.btn-detalhes');
    
    // Adiciona evento de clique para cada botão de detalhes
    btnsDetalhes.forEach(btn => {
        btn.addEventListener('click', function() {
            const pedidoRow = this.closest('tr');
            preencherModalPedido(pedidoRow);
            abrirModal();
        });
    });
    
    // Fechar modal
    btnFecharModal.addEventListener('click', fecharModal);
    btnFechar.addEventListener('click', fecharModal);
    
    // Funções
    function abrirModal() {
        modalPedido.style.display = 'flex';
    }
    
    function fecharModal() {
        modalPedido.style.display = 'none';
    }
    
    function preencherModalPedido(pedidoRow) {
        // Obtém os dados da linha da tabela
        const id = pedidoRow.querySelector('td:first-child').textContent;
        const nomeCliente = pedidoRow.querySelector('td:nth-child(2)').textContent;
        const dataHora = pedidoRow.querySelector('td:nth-child(3)').textContent.split(' ');
        const valor = pedidoRow.querySelector('td:nth-child(4)').textContent;
        const status = pedidoRow.querySelector('.status').textContent.toLowerCase();
        
        // Preenche os dados básicos no modal
        document.getElementById('pedidoId').textContent = id;
        document.getElementById('clienteNome').textContent = nomeCliente;
        document.getElementById('pedidoData').textContent = dataHora[0];
        document.getElementById('pedidoHora').textContent = dataHora[1];
        document.getElementById('pedidoTotal').textContent = valor;
        document.getElementById('pedidoStatus').textContent = status;
        
   
        preencherDadosAdicionais(id);
    }
    
    function preencherDadosAdicionais(pedidoId) {

        
        // Dados fictícios baseados no ID do pedido
        const dadosPedidos = {
            '#001': {
                telefone: '(11) 98765-4321',
                endereco: 'Rua das Flores, 123 - São Paulo/SP',
                pagamento: 'Cartão (Crédito)',
                entrega: 'Delivery',
                itens: [
                    { nome: 'Pizza Margherita', quantidade: 1, preco: 'R$ 49,90', subtotal: 'R$ 49,90' },
                    { nome: 'Coca-Cola 2L', quantidade: 2, preco: 'R$ 9,90', subtotal: 'R$ 19,80' }
                ],
                subtotal: 'R$ 69,70',
                taxa: 'R$ 8,00',
                desconto: 'R$ 0,00',
                total: 'R$ 77,70',
                observacoes: 'Sem cebola na pizza'
            },
            '#002': {
                telefone: '(11) 91234-5678',
                endereco: 'Avenida Paulista, 1000 - São Paulo/SP',
                pagamento: 'Dinheiro',
                entrega: 'Retirada',
                itens: [
                    { nome: 'Pizza Calabresa', quantidade: 1, preco: 'R$ 45,90', subtotal: 'R$ 45,90' },
                    { nome: 'Guaraná 2L', quantidade: 1, preco: 'R$ 7,00', subtotal: 'R$ 7,00' }
                ],
                subtotal: 'R$ 52,90',
                taxa: 'R$ 0,00',
                desconto: 'R$ 0,00',
                total: 'R$ 52,90',
                observacoes: 'Borda recheada com catupiry'
            }
        };
        
        const pedido = dadosPedidos[pedidoId] || {};
        
        // Preenche os dados adicionais
        document.getElementById('clienteTelefone').textContent = pedido.telefone || '(00) 00000-0000';
        document.getElementById('clienteEndereco').textContent = pedido.endereco || 'Endereço não informado';
        document.getElementById('pedidoPagamento').textContent = pedido.pagamento || 'Não informado';
        document.getElementById('pedidoEntrega').textContent = pedido.entrega || 'Não informado';
        document.getElementById('pedidoSubtotal').textContent = pedido.subtotal || 'R$ 0,00';
        document.getElementById('pedidoTaxa').textContent = pedido.taxa || 'R$ 0,00';
        document.getElementById('pedidoDesconto').textContent = pedido.desconto || 'R$ 0,00';
        document.getElementById('pedidoObservacoes').textContent = pedido.observacoes || 'Sem observações adicionais';
        
        // Preenche os itens do pedido
        const itensBody = document.getElementById('itensPedidoBody');
        itensBody.innerHTML = '';
        
        if (pedido.itens && pedido.itens.length > 0) {
            pedido.itens.forEach(item => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${item.nome}</td>
                    <td>${item.quantidade}</td>
                    <td>${item.preco}</td>
                    <td>${item.subtotal}</td>
                `;
                itensBody.appendChild(tr);
            });
        } else {
            itensBody.innerHTML = '<tr><td colspan="4">Nenhum item encontrado</td></tr>';
        }
        
        // Define a foto do cliente (simulada)
        const clienteAvatar = document.getElementById('clienteAvatar');
        clienteAvatar.src = `img/clientes/cliente${pedidoId === '#001' ? '1' : '2'}.jpg`;
        clienteAvatar.alt = document.getElementById('clienteNome').textContent;
    }
    
    // Fechar modal ao clicar fora do conteúdo
    window.addEventListener('click', function(e) {
        if (e.target === modalPedido) {
            fecharModal();
        }
    });
    

});