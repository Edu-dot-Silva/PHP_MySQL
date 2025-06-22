<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header('Location: loginCliente.php');
    exit;
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
include_once '../backend/conexaoCliente.php';
$cid = intval($_SESSION['cliente_id']);
$pid = intval($_GET['id']);
// Verifica se já existe no carrinho
$sql = "SELECT id, quantidade FROM carrinho WHERE cliente_id = ? AND produto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $cid, $pid);
$stmt->execute();
$res = $stmt->get_result();
if ($item = $res->fetch_assoc()) {
    // Atualiza quantidade
    $nova_qtd = $item['quantidade'] + 1;
    $conn->query("UPDATE carrinho SET quantidade = $nova_qtd WHERE id = {$item['id']}");
} else {
    // Insere novo
    $conn->query("INSERT INTO carrinho (cliente_id, produto_id, quantidade) VALUES ($cid, $pid, 1)");
}
header('Location: paginaCarrinho.php');
exit;
?>