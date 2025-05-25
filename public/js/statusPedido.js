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

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const pedidoId = this.dataset.pedidoId;
            const novoStatus = this.value;
            
            // Mostrar loading (opcional)
            this.disabled = true;
            const originalValue = this.value;
            
            fetch(`/admin/pedidos/${pedidoId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: novoStatus })
            })
            .then(response => {
                if (!response.ok) throw new Error('Erro na requisição');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Atualizar classe do select
                    this.className = `status-select ${novoStatus}`;
                    
                    // Feedback visual
                    showToast('Status atualizado com sucesso!', 'success');
                } else {
                    throw new Error(data.message || 'Erro ao atualizar');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                this.value = originalValue; // Reverter seleção
                showToast(error.message || 'Erro ao atualizar status', 'error');
            })
            .finally(() => {
                this.disabled = false;
            });
        });
    });
    
    function showToast(message, type = 'success') {

        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => toast.remove(), 3000);
    }
});

// Função para abrir o modal com os dados do pedido
function abrirModalPedido(pedido) {
    const modal = document.getElementById('modalPedido');
    modal.style.display = 'block';

    // Preenche os dados do cliente
    document.getElementById('pedidoId').textContent = pedido.id;
    document.getElementById('clienteNome').textContent = pedido.cliente.nome;
    document.getElementById('clienteTelefone').textContent = pedido.cliente.telefone;
    document.getElementById('clienteEndereco').textContent = pedido.cliente.endereco;
    
    // Avatar do cliente (opcional)
    if (pedido.cliente.avatar) {
        document.getElementById('clienteAvatar').src = pedido.cliente.avatar;
    }

    // Preenche as informações do pedido
    document.getElementById('pedidoData').textContent = pedido.data;
    document.getElementById('pedidoHora').textContent = pedido.hora;
    document.getElementById('pedidoPagamento').textContent = pedido.pagamento;
    document.getElementById('pedidoEntrega').textContent = pedido.entrega;
    document.getElementById('pedidoStatus').textContent = pedido.status;

    // Preenche os itens do pedido
    const itensBody = document.getElementById('itensPedidoBody');
    itensBody.innerHTML = '';
    
    pedido.itens.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.nome}</td>
            <td>${item.quantidade}</td>
            <td>R$ ${item.precoUnitario.toFixed(2)}</td>
            <td>R$ ${(item.quantidade * item.precoUnitario).toFixed(2)}</td>
        `;
        itensBody.appendChild(row);
    });

    // Preenche o resumo do pedido
    document.getElementById('pedidoSubtotal').textContent = `R$ ${pedido.subtotal.toFixed(2)}`;
    document.getElementById('pedidoTaxa').textContent = `R$ ${pedido.taxaEntrega.toFixed(2)}`;
    document.getElementById('pedidoDesconto').textContent = `R$ ${pedido.desconto.toFixed(2)}`;
    document.getElementById('pedidoTotal').textContent = `R$ ${pedido.total.toFixed(2)}`;

    // Preenche observações (se houver)
    document.getElementById('pedidoObservacoes').textContent = pedido.observacoes || 'Sem observações adicionais.';

    // Configura o botão de imprimir
    document.getElementById('btnImprimir').addEventListener('click', () => {
        imprimirComanda(pedido);
    });

    // Fecha o modal ao clicar no botão "Fechar"
    document.querySelector('.btn-fechar').addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Fecha o modal ao clicar no "X"
    document.querySelector('.fechar-modal').addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Fecha o modal ao clicar fora da área de conteúdo
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Função para imprimir a comanda (exemplo)
function imprimirComanda(pedido) {
    const conteudo = `
        <h2>Comanda - Pedido #${pedido.id}</h2>
        <p><strong>Cliente:</strong> ${pedido.cliente.nome}</p>
        <p><strong>Data:</strong> ${pedido.data} às ${pedido.hora}</p>
        <hr>
        <h3>Itens:</h3>
        <ul>
            ${pedido.itens.map(item => `
                <li>${item.quantidade}x ${item.nome} - R$ ${(item.quantidade * item.precoUnitario).toFixed(2)}</li>
            `).join('')}
        </ul>
        <hr>
        <p><strong>Total:</strong> R$ ${pedido.total.toFixed(2)}</p>
        <p><strong>Observações:</strong> ${pedido.observacoes || 'Nenhuma'}</p>
    `;

    const janelaImpressao = window.open('', '_blank');
    janelaImpressao.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Comanda Pedido #${pedido.id}</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h2 { color: #333; }
                hr { border: 0; border-top: 1px solid #eee; margin: 10px 0; }
            </style>
        </head>
        <body>
            ${conteudo}
            <script>
                window.onload = function() {
                    window.print();
                    setTimeout(function() {
                        window.close();
                    }, 1000);
                };
            </script>
        </body>
        </html>
    `);
    janelaImpressao.document.close();
}

// Exemplo de uso:
const pedidoExemplo = {
    id: "001",
    cliente: {
        nome: "João Silva",
        telefone: "(11) 98765-4321",
        endereco: "Rua das Flores, 123 - São Paulo/SP",
        avatar: "https://example.com/avatar.jpg"
    },
    data: "10/06/2024",
    hora: "14:30",
    pagamento: "Cartão (Crédito)",
    entrega: "Delivery",
    status: "Em preparo",
    itens: [
        { nome: "Pizza Margherita (Média)", quantidade: 1, precoUnitario: 49.90 },
        { nome: "Coca-Cola 2L", quantidade: 2, precoUnitario: 9.90 }
    ],
    subtotal: 69.70,
    taxaEntrega: 5.00,
    desconto: 0.00,
    total: 74.70,
    observacoes: "Sem cebola na pizza"
};




