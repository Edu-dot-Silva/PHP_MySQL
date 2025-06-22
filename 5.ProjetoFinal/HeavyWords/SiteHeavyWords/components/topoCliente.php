<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$carrinho_qtd = 0;
$cliente_nome = '';
if (isset($_SESSION['cliente_id'])) {
    include_once '../backend/conexaoCliente.php';
    $cid = intval($_SESSION['cliente_id']);
    $res = $conn->query("SELECT SUM(quantidade) as total FROM carrinho WHERE cliente_id = $cid");
    if ($res && $row = $res->fetch_assoc()) {
        $carrinho_qtd = intval($row['total']);
    }
    $res_nome = $conn->query("SELECT nome FROM clientes WHERE id = $cid");
    if ($res_nome && $row_nome = $res_nome->fetch_assoc()) {
        $cliente_nome = $row_nome['nome'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/cabecalho.css">
<div class="cabecalho">
    <div>
    </div>
    <div>
        <img src="../assets/img/logo.png" alt="Logo Heavy Words" class="logo_cabecalho">
    </div>
    <div>
        <?php if (!isset($_SESSION['cliente_id'])): ?>
            <?php if (basename($_SERVER['PHP_SELF']) !== 'loginCliente.php'): ?>
                <a href="loginCliente.php"><button class="btn_login">Login/Cadastro</button></a>
            <?php endif; ?>
        <?php else: ?>
            <span>
                <!-- feature futura: esse botao leva pra uma pagina que mostra infomracoes do cliente, ultimos pedidos, etc -->
                 <!-- depois fazer destinção de nome e sobrenome do cliente para exibir apenas o primeiro nome -->
                <button class="usuario_icon"></button><?php echo htmlspecialchars($cliente_nome); ?>
                <a href="paginaCarrinho.php" style="text-decoration:none;">
                    <button class="carrinho_icon"></button>(<span id="carrinhoQtd"><?php echo $carrinho_qtd; ?></span>)
                </a>
            </span>
            <a href="../backend/sairCliente.php"><button class="sair_icon"></button></a>
        <?php endif; ?>
    </div>
</div>