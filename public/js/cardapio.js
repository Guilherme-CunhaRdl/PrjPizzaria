document.addEventListener('DOMContentLoaded', function() {
    // Elementos do modal
    const modal = document.getElementById('modalPizza');
    const btnNovaPizza = document.getElementById('btnNovaPizza');
    const btnCancelar = document.querySelector('.btn-cancelar');
    const btnFecharModal = document.querySelector('.fechar-modal');
    const formPizza = document.getElementById('formPizza');

    // Abrir modal
    btnNovaPizza.addEventListener('click', function() {
        modal.style.display = 'flex';
    });

    // Fechar modal
    function fecharModal() {
        modal.style.display = 'none';
        formPizza.reset();
        document.getElementById('imagemPreview').style.display = 'none';
    }

    btnCancelar.addEventListener('click', fecharModal);
    btnFecharModal.addEventListener('click', fecharModal);

    // Fechar modal ao clicar fora 
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            fecharModal();
        }
    });

    // Preview da imagem
    document.getElementById('pizzaImagem').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('imagemPreview');
                preview.style.display = 'block';
                preview.style.backgroundImage = `url(${event.target.result})`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Formulário
    formPizza.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const pizza = {
            nome: document.getElementById('pizzaNome').value,
            ingredientes: document.getElementById('pizzaIngredientes').value,
            preco: parseFloat(document.getElementById('pizzaPreco').value),
            categoria: document.getElementById('pizzaCategoria').value,
            destaque: document.getElementById('pizzaDestaque').checked,
            promocao: document.getElementById('pizzaPromocao').checked
        };
        
        console.log('Pizza a ser cadastrada:', pizza);
        alert('Pizza cadastrada com sucesso!');
        fecharModal();
    });

 
    document.querySelectorAll('.btn-ativar').forEach(btn => {
        btn.addEventListener('click', function() {
            // Lógica para ativar/desativar pizza
            const icon = btn.querySelector('i');
            if (icon.classList.contains('fa-toggle-on')) {
                icon.classList.replace('fa-toggle-on', 'fa-toggle-off');
                btn.title = 'Ativar';
            } else {
                icon.classList.replace('fa-toggle-off', 'fa-toggle-on');
                btn.title = 'Desativar';
            }
        });
    });

    document.querySelectorAll('.btn-excluir').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Tem certeza que deseja excluir esta pizza?')) {
                // Lógica para excluir pizza
                btn.closest('.pizza-card').remove();
                alert('Pizza excluída com sucesso!');
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os botões de edição
    const botoesEditar = document.querySelectorAll('.btn-editar');
    const modal = document.getElementById('modalPizza');
    const modalTitulo = document.getElementById('modalTitulo');
    const btnSalvarPizza = document.getElementById('btnSalvarPizza');
    
    // Adiciona evento de clique para cada botão de edição
    botoesEditar.forEach(botao => {
        botao.addEventListener('click', function() {
            // Obtém o card da pizza que está sendo editada
            const pizzaCard = this.closest('.pizza-card');
            
            // Preenche o modal com os dados da pizza
            preencherModalEdicao(pizzaCard);
            
            // Altera o título do modal
            modalTitulo.textContent = 'Editar Pizza';
            
            // Altera o texto do botão de salvar
            btnSalvarPizza.textContent = 'Atualizar Pizza';
            
            // Exibe o modal
            modal.style.display = 'flex';
        });
    });
    
    function preencherModalEdicao(pizzaCard) {
        // Obtém os dados da pizza do card
        const nome = pizzaCard.querySelector('h3').textContent;
        const categoria = pizzaCard.querySelector('.categoria').textContent.toLowerCase();
        const ingredientes = pizzaCard.querySelector('.ingredientes').textContent;
        const status = pizzaCard.querySelector('.status').textContent.toLowerCase();
        const isDestaque = pizzaCard.classList.contains('destaque');
        const isPromocao = pizzaCard.querySelector('.badge-promocao') !== null;
        
        // Obter preços dos tamanhos 
        // Aqui estou usando valores padrão
        document.getElementById('precoPequena').value = '39.90';
        document.getElementById('precoMedia').value = '49.90';
        document.getElementById('precoGrande').value = '59.90';
        
        // Preenche os outros campos do formulário
        document.getElementById('pizzaNome').value = nome;
        document.getElementById('pizzaCategoria').value = categoria === 'salgada' ? 'salgada' : 
                                                         categoria === 'doce' ? 'doce' : 'especial';
        document.getElementById('pizzaIngredientes').value = ingredientes;
        document.getElementById('pizzaDestaque').checked = isDestaque;
        document.getElementById('pizzaPromocao').checked = isPromocao;
        document.getElementById('pizzaDisponivel').checked = status === 'disponível';
        
        // Obtém a URL da imagem
        const imagemUrl = pizzaCard.querySelector('.pizza-img').style.backgroundImage
            .replace('url("', '').replace('")', '');
        document.getElementById('pizzaImagemAtual').value = imagemUrl;
        
        // Exibe a pré-visualização da imagem
        const imagemPreview = document.getElementById('imagemPreview');
        imagemPreview.style.backgroundImage = `url(${imagemUrl})`;
        imagemPreview.style.display = 'block';
    }
    
    // Atualize a função de submit para incluir os tamanhos
    document.getElementById('formPizza').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const pizza = {
            nome: document.getElementById('pizzaNome').value,
            categoria: document.getElementById('pizzaCategoria').value,
            ingredientes: document.getElementById('pizzaIngredientes').value,
            tamanhos: {
                pequena: parseFloat(document.getElementById('precoPequena').value),
                media: parseFloat(document.getElementById('precoMedia').value),
                grande: parseFloat(document.getElementById('precoGrande').value)
            },
            destaque: document.getElementById('pizzaDestaque').checked,
            promocao: document.getElementById('pizzaPromocao').checked,
            disponivel: document.getElementById('pizzaDisponivel').checked,
            imagem: document.getElementById('pizzaImagemAtual').value
        };
        
        console.log('Dados da pizza:', pizza);
        alert(btnSalvarPizza.textContent === 'Salvar Pizza' ? 
              'Pizza adicionada com sucesso!' : 'Pizza atualizada com sucesso!');
        
        modal.style.display = 'none';
        limparFormulario();
    });
    
    // Evento para pré-visualização da imagem
    document.getElementById('pizzaImagem').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imagemPreview = document.getElementById('imagemPreview');
                imagemPreview.style.backgroundImage = `url(${event.target.result})`;
                imagemPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Evento de submit do formulário
    document.getElementById('formPizza').addEventListener('submit', function(e) {
        e.preventDefault();
        
       
        
        // Simulação de sucesso
        alert(btnSalvarPizza.textContent === 'Salvar Pizza' ? 
              'Pizza adicionada com sucesso!' : 'Pizza atualizada com sucesso!');
        
        modal.style.display = 'none';
        limparFormulario();
        
        
    });
});