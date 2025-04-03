<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];
    $nome = $_POST['nome'];


    if (strlen($cpf) !== 11 || strlen($creci) < 2 || strlen($nome) < 2) {
        header("Location: index.php?mensagem=Erro: Dados inválidos.");
        exit();
    }

    
    $sql = "UPDATE corretores SET cpf=?, creci=?, nome=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $cpf, $creci, $nome, $id);

    if ($stmt->execute()) {
        header("Location: index.php?mensagem=Edição realizada com sucesso!");
        exit();
    } else {
        header("Location: index.php?mensagem=Erro ao editar.");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
