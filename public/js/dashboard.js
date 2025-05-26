document.addEventListener('DOMContentLoaded', function() {
    // Inicializar gráfico de vendas
    const ctx = document.getElementById('vendasChart').getContext('2d');
    const vendasChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Vendas (R$)',
                data: [1200, 1900, 1500, 2000, 2500, 2200, 3000],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Filtros de período
    document.querySelectorAll('.btn-periodo').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.btn-periodo').forEach(b => b.classList.remove('ativo'));
            this.classList.add('ativo');
            
            // Aqui você pode atualizar o gráfico com novos dados
            // Exemplo: fetch('/admin/vendas?periodo=' + this.textContent.trim())
        });
    });

    // Modal de detalhes do pedido
    const modal = document.getElementById('modalPedido');
    const closeBtn = document.querySelector('.fechar-modal');
    
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-detalhes')) {
            const pedidoId = e.target.closest('.btn-detalhes').dataset.pedidoId;
            carregarDetalhesPedido(pedidoId);
            modal.style.display = 'block';
        }
    });

    closeBtn.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', (e) => {
        if (e.target === modal) modal.style.display = 'none';
    });

    async function carregarDetalhesPedido(pedidoId) {
        try {
            const response = await fetch(`/admin/pedidos/${pedidoId}/detalhes`);
            if (!response.ok) throw new Error('Erro ao carregar pedido');
            
            const data = await response.json();
            
            // Preencher os dados do modal
            document.getElementById('pedidoId').textContent = `#${data.id}`;
            document.getElementById('clienteNome').textContent = data.cliente.nome;
            document.getElementById('clienteTelefone').textContent = data.cliente.telefone;
            document.getElementById('clienteEndereco').textContent = data.cliente.endereco;
            document.getElementById('pedidoData').textContent = data.data;
            document.getElementById('pedidoHora').textContent = data.hora;
            document.getElementById('pedidoPagamento').textContent = data.metodo_pagamento;
            document.getElementById('pedidoStatus').textContent = data.status;
            document.getElementById('pedidoSubtotal').textContent = `R$ ${data.subtotal}`;
            document.getElementById('pedidoTaxa').textContent = `R$ ${data.taxa_entrega}`;
            document.getElementById('pedidoTotal').textContent = `R$ ${data.total}`;
            document.getElementById('pedidoObservacoes').textContent = data.observacoes || 'Sem observações';
            
            // Preencher itens do pedido
            const tbody = document.getElementById('itensPedidoBody');
            tbody.innerHTML = data.itens.map(item => `
                <tr>
                    <td>${item.nome} (${item.tamanho})</td>
                    <td>${item.quantidade}</td>
                    <td>R$ ${item.preco_unitario}</td>
                    <td>R$ ${(item.preco_unitario * item.quantidade).toFixed(2)}</td>
                </tr>
            `).join('');
            
        } catch (error) {
            console.error('Erro:', error);
            alert('Erro ao carregar detalhes do pedido');
        }
    }
});