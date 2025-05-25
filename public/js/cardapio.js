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
    // Elementos do modal
    const modalAdicionar = document.getElementById('modalAdicionarPizza');
    const btnAdicionar = document.getElementById('btnNovaPizza'); // Ou o seletor correto do seu botão
    const formAdicionar = document.getElementById('formAdicionarPizza');

    // Verificação de elementos
    if (!modalAdicionar || !btnAdicionar) {
        console.error('Elementos do modal de adição não encontrados!');
        return;
    }

    // Abrir modal
    btnAdicionar.addEventListener('click', function() {
        abrirModalAdicionar();
    });

    // Fechar modal
    modalAdicionar.querySelector('.fechar-modal').addEventListener('click', function() {
        fecharModalAdicionar();
    });

    // Fechar ao clicar fora
    modalAdicionar.addEventListener('click', function(e) {
        if (e.target === modalAdicionar) {
            fecharModalAdicionar();
        }
    });

    // Pré-visualização da imagem
    const inputImagem = document.getElementById('adicionarImagem');
    const previewImagem = document.getElementById('adicionarImagemPreview');

    if (inputImagem && previewImagem) {
        inputImagem.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImagem.style.backgroundImage = `url(${event.target.result})`;
                    previewImagem.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Funções auxiliares
    function abrirModalAdicionar() {
        console.log('Abrindo modal de adição'); // Para debug
        modalAdicionar.style.display = 'flex';
        // Resetar formulário ao abrir
        if (formAdicionar) formAdicionar.reset();
        if (previewImagem) {
            previewImagem.style.backgroundImage = '';
            previewImagem.style.display = 'none';
        }
    }

    function fecharModalAdicionar() {
        modalAdicionar.style.display = 'none';
    }
});


//EDITAR PIZZA
document.addEventListener('DOMContentLoaded', function() {
    // Modal de edição
    const modalEditar = document.getElementById('modalEditarPizza');
    const formEditar = document.getElementById('formEditarPizza');
    
    // Botões de edição
    document.querySelectorAll('.btn-editar').forEach(botao => {
        botao.addEventListener('click', function() {
            const pizzaCard = this.closest('.pizza-card');
            if (!pizzaCard) return;

            const pizzaId = pizzaCard.dataset.id;
            if (!pizzaId) return;

            // Atualiza o action do formulário com o ID correto
            formEditar.action = `/admin/pizzas/${pizzaId}`;
            
            // Preenche os campos do formulário
            document.getElementById('editarPizzaId').value = pizzaId;
            document.getElementById('editarNome').value = pizzaCard.dataset.nome;
            document.getElementById('editarCategoria').value = pizzaCard.dataset.categoria;
            document.getElementById('editarIngredientes').value = pizzaCard.dataset.ingredientes;
            document.getElementById('editarPrecoPequena').value = pizzaCard.dataset.pequena;
            document.getElementById('editarPrecoMedia').value = pizzaCard.dataset.media;
            document.getElementById('editarPrecoGrande').value = pizzaCard.dataset.grande;
            
            // Imagem
            const imagemPreview = document.getElementById('editarImagemPreview');
            if (imagemPreview) {
                imagemPreview.style.backgroundImage = `url(${pizzaCard.dataset.imagem})`;
                imagemPreview.style.display = 'block';
                document.getElementById('editarImagemAtual').value = pizzaCard.dataset.imagem;
            }
            
            // Remove o required da imagem para edição
            document.getElementById('editarImagem').removeAttribute('required');
            
            // Abre o modal
            modalEditar.style.display = 'flex';
        });
    });

    // Fechar modal
    document.querySelector('#modalEditarPizza .fechar-modal').addEventListener('click', function() {
        modalEditar.style.display = 'none';
    });
});