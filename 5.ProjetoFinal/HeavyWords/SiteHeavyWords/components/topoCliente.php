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
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
    <div>
        <?php if (!isset($_SESSION['cliente_id'])): ?>
            <a href="loginCliente.php"><button>Login/Cadastro</button></a>
        <?php else: ?>
            <button><?php echo htmlspecialchars($cliente_nome); ?></button>
            <a href="../backend/sairCliente.php" style="margin-left:10px;color:red;text-decoration:none;font-weight:bold;">Sair</a>
        <?php endif; ?>
    </div>
    <div>
        <a href="<?php echo isset($_SESSION['cliente_id']) ? 'paginaCarrinho.php' : 'loginCliente.php'; ?>" style="text-decoration:none;">
            <span style="font-size:18px;">Carrinho (<span id="carrinhoQtd"><?php echo $carrinho_qtd; ?></span>)</span>
        </a>
    </div>
</div>
