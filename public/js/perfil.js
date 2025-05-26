document.addEventListener('DOMContentLoaded', function() {
    // Alterar foto de perfil
    document.getElementById('foto-input').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.foto-perfil').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
            document.getElementById('form-foto').submit();
        }
    });

    // Modal alterar senha
    const modalSenha = document.getElementById('modal-senha');
    const btnAbrirModal = document.getElementById('btn-alterar-senha');
    const btnFecharModal = document.querySelector('.fechar-modal');

    btnAbrirModal.addEventListener('click', function() {
        modalSenha.style.display = 'flex';
    });

    btnFecharModal.addEventListener('click', function() {
        modalSenha.style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        if (e.target === modalSenha) {
            modalSenha.style.display = 'none';
        }
    });

    // Máscaras para formulário
    $('#cpf').mask('000.000.000-00');
    $('#cep').mask('00000-000');

    // Buscar CEP
    $('#cep').on('blur', function() {
        const cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        $('#logradouro').val(data.logradouro);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.localidade);
                        $('#estado').val(data.uf);
                    }
                })
                .catch(error => console.error('Erro ao buscar CEP:', error));
        }
    });
});

document.getElementById('form-foto').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            document.getElementById('foto-perfil').src = data.foto_url;
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert('Ocorreu um erro. Por favor, tente novamente.');
    });
});