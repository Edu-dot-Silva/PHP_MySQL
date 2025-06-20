const formCadastro = document.getElementById('form-cadastro');
const senhaInput = document.getElementById('senha');
const repeteSenhaInput = document.getElementById('repete_senha');
const erroSenha = document.getElementById('erro-senha');

formCadastro.addEventListener('submit', function(e) {
    const senha = senhaInput.value;
    const repeteSenha = repeteSenhaInput.value;
    const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{6,}$/;
    let mensagem = '';
    if (!regex.test(senha)) {
        mensagem = 'A senha deve ter pelo menos 6 caracteres, uma letra maiúscula, um número e um caractere especial.';
    } else if (senha !== repeteSenha) {
        mensagem = 'As senhas não coincidem.';
    }
    if (mensagem) {
        erroSenha.textContent = mensagem;
        e.preventDefault();
    } else {
        erroSenha.textContent = '';
    }
});