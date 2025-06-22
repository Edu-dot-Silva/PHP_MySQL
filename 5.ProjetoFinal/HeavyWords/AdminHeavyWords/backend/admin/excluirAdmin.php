<?php
include_once '../conexaoAdmin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM usuarios_admin WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        // Redireciona para a lista após excluir
        header('Location: ../../pages/listaAdmin.php');
        exit;
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Requisição inválida.";
}
$conn->close();
?>
