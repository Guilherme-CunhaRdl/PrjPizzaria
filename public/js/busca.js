document.querySelector('.busca input').addEventListener('input', (e) => {
    const termo = e.target.value.toLowerCase();
    const linhas = document.querySelectorAll('.tabela-clientes tbody tr');
    
    linhas.forEach(linha => {
        const textoLinha = linha.textContent.toLowerCase();
        linha.style.display = textoLinha.includes(termo) ? '' : 'none';
    });
});