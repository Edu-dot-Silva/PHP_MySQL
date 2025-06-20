<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro / Login - Heavy Words</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <?php include_once '../componentes/cabecalho.php'; ?>
    <main>
        <div class="cadastro-login-container">
            <div class="login-box">
                <h2>Login</h2>
                <form action="../actions/login.php" method="POST">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>

                    <button type="submit">Entrar</button>
                </form>

            </div>
            <div class="cadastro-box">
                <h2>Cadastro</h2>
                <form id="form-cadastro" action="../backend/cadastra_cliente.php" method="POST">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>

                    <label for="repete_senha">Repetir Senha:</label>
                    <input type="password" id="repete_senha" name="repete_senha" required>

                    <button type="submit">Cadastrar</button>
                    <div id="erro-senha" style="color: red; margin-top: 8px; font-size: 14px;"></div>
                </form>
            </div>
        </div>

    </main>
    <?php include_once '../componentes/rodape.php'; ?>
    <script src="../assets/js/valida_cadastro.js"></script>
</body>
</html>
