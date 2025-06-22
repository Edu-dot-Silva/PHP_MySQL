<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['cliente_id'])) {
    echo json_encode(['sucesso' => false]);
    exit;
}
if (!isset($_POST['id']) || !isset($_POST['quantidade']) || !is_numeric($_POST['id']) || !is_numeric($_POST['quantidade'])) {
    echo json_encode(['sucesso' => false]);
    exit;
}
include_once '../backend/conexaoCliente.php';
$cid = intval($_SESSION['cliente_id']);
$item_id = intval($_POST['id']);
$qtd = intval($_POST['quantidade']);

if ($qtd < 1) {
    $conn->query("DELETE FROM carrinho WHERE id = $item_id AND cliente_id = $cid");
    echo json_encode(['sucesso' => true, 'totalItem' => 'R$ 0,00', 'totalGeral' => 'R$ 0,00']);
    exit;
}

// Atualiza quantidade
$conn->query("UPDATE carrinho SET quantidade = $qtd WHERE id = $item_id AND cliente_id = $cid");

// Busca preço unitário e calcula total do item
$sql = "SELECT quantidade, preco FROM carrinho c JOIN produtos p ON c.produto_id = p.id WHERE c.id = $item_id AND c.cliente_id = $cid";
$res = $conn->query($sql);
$totalItem = 0;
if ($res && $row = $res->fetch_assoc()) {
    $totalItem = $row['quantidade'] * $row['preco'];
}
$totalItemFormat = 'R$ ' . number_format($totalItem, 2, ',', '.');

// Calcula total geral do carrinho
$sql2 = "SELECT SUM(c.quantidade * p.preco) as total FROM carrinho c JOIN produtos p ON c.produto_id = p.id WHERE c.cliente_id = $cid";
$res2 = $conn->query($sql2);
$totalGeral = 0;
if ($res2 && $row2 = $res2->fetch_assoc()) {
    $totalGeral = $row2['total'] ? $row2['total'] : 0;
}
$totalGeralFormat = 'R$ ' . number_format($totalGeral, 2, ',', '.');

echo json_encode(['sucesso' => true, 'totalItem' => $totalItemFormat, 'totalGeral' => $totalGeralFormat]);
?>