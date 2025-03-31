
document.addEventListener('DOMContentLoaded', function() {
    
    // Verifica em qual página estamos
    let tipoPagina;
    if (document.querySelector('.pizza-grid')) {
        tipoPagina = 'cardapio';
    } else if (document.querySelector('.tabela-pedidos')) {
        tipoPagina = 'pedidos';
    } else if (document.querySelector('.tabela-clientes')) {
        tipoPagina = 'clientes';
    } else {
        return; // Não é nenhuma das páginas que queremos
    }

    // Configura os elementos que vamos usar
    const buscaInput = document.querySelector('.busca input');
    const filtroStatus = document.querySelector('.filtro-status');
    const filtroCategoria = document.querySelector('.filtro-categoria'); // Novo filtro
    const contador = document.querySelector('.breadcrumb small');
    let itensParaFiltrar;

    // Seleciona os itens certos para cada página
    if (tipoPagina === 'cardapio') {
        itensParaFiltrar = document.querySelectorAll('.pizza-card');
    } else if (tipoPagina === 'pedidos') {
        itensParaFiltrar = document.querySelectorAll('.tabela-pedidos tbody tr');
    } else if (tipoPagina === 'clientes') {
        itensParaFiltrar = document.querySelectorAll('.tabela-clientes tbody tr');
    }

    // Função principal que filtra tudo
    function aplicarFiltros() {
        const termoBusca = buscaInput ? buscaInput.value.toLowerCase() : '';
        const statusSelecionado = filtroStatus ? filtroStatus.value : 'todos';
        const categoriaSelecionada = filtroCategoria ? filtroCategoria.value : 'todos'; // Novo
        
        let itensVisiveis = 0;

        itensParaFiltrar.forEach(item => {
            // Verifica busca
            let correspondeBusca = true;
            if (termoBusca) {
                if (tipoPagina === 'cardapio') {
                    const nome = item.querySelector('h3').textContent.toLowerCase();
                    const ingredientes = item.querySelector('.ingredientes').textContent.toLowerCase();
                    correspondeBusca = nome.includes(termoBusca) || ingredientes.includes(termoBusca);
                } else {
                    const nome = item.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    correspondeBusca = nome.includes(termoBusca);
                }
            }

            // Verifica status
            let correspondeStatus = true;
            if (statusSelecionado !== 'todos') {
                if (tipoPagina === 'cardapio') {
                    const status = item.querySelector('.status').textContent.toLowerCase();
                    if (statusSelecionado === 'disponivel') {
                        correspondeStatus = status.includes('disponível');
                    } else if (statusSelecionado === 'esgotado') {
                        correspondeStatus = status.includes('esgotado');
                    } else if (statusSelecionado === 'destaque') {
                        correspondeStatus = item.classList.contains('destaque');
                    }
                } else if (tipoPagina === 'pedidos') {
                    const status = item.querySelector('.status-select').value;
                    correspondeStatus = status === statusSelecionado;
                } else if (tipoPagina === 'clientes') {
                    const status = item.querySelector('.status-badge').textContent.toLowerCase();
                    if (statusSelecionado === 'ativo') {
                        correspondeStatus = status.includes('ativo');
                    } else if (statusSelecionado === 'inativo') {
                        correspondeStatus = status.includes('inativo');
                    }
                }
            }

            // Verifica categoria (APENAS PARA CARDÁPIO)
            let correspondeCategoria = true;
            if (tipoPagina === 'cardapio' && categoriaSelecionada !== 'todos') {
                const categoriaElemento = item.querySelector('.categoria');
                if (categoriaElemento) {
                    const categoria = categoriaElemento.textContent.toLowerCase();
                    if (categoriaSelecionada === 'salgadas') {
                        correspondeCategoria = categoria.includes('salgada');
                    } else if (categoriaSelecionada === 'doces') {
                        correspondeCategoria = categoria.includes('doce');
                    } else if (categoriaSelecionada === 'especiais') {
                        correspondeCategoria = categoria.includes('especial');
                    }
                }
            }

            // Mostra ou esconde o item
            if (correspondeBusca && correspondeStatus && correspondeCategoria) {
                item.style.display = '';
                itensVisiveis++;
            } else {
                item.style.display = 'none';
            }
        });

        // Atualiza o contador
        if (contador) {
            contador.textContent = `Total: ${itensVisiveis} de ${itensParaFiltrar.length} itens`;
        }
    }

    // Adiciona os eventos
    if (buscaInput) {
        buscaInput.addEventListener('input', aplicarFiltros);
    }
    if (filtroStatus) {
        filtroStatus.addEventListener('change', aplicarFiltros);
    }
    if (filtroCategoria) { // Novo evento
        filtroCategoria.addEventListener('change', aplicarFiltros);
    }

    // Aplica os filtros quando a página carrega
    aplicarFiltros();
});