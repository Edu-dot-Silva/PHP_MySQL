    document.getElementById('form-edita-admin').addEventListener('submit', function(e) {
        var senha = document.getElementById('senha').value;
        var repete = document.getElementById('repete_senha').value;
        var erro = document.getElementById('erro-senha');
        if (senha !== '' && senha !== repete) {
            erro.textContent = 'As senhas não coincidem.';
            e.preventDefault();
        } else {
            erro.textContent = '';
        }
    });