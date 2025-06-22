<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    exit;
}
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    exit;
}
include_once '../backend/conexaoCliente.php';
$cid = intval($_SESSION['cliente_id']);
$item_id = intval($_POST['id']);
$conn->query("DELETE FROM carrinho WHERE id = $item_id AND cliente_id = $cid");
echo 'ok';
?>