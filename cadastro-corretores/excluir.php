<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM corretores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?mensagem=Exclusão realizada com sucesso!");
        exit();
    } else {
        header("Location: index.php?mensagem=Erro ao excluir.");
        exit();
    }
    
    $stmt->close();
}
$conn->close();
?>
