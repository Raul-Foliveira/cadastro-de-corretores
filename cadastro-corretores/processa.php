<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $creci = trim($_POST['creci']);

    // Validação dos campos
    if (strlen($cpf) !== 11 || !ctype_digit($cpf)) {
        header("Location: index.php?mensagem=Erro: O CPF deve ter exatamente 11 dígitos numéricos.");
        exit();
    }
    
    if (strlen($creci) < 2) {
        header("Location: index.php?mensagem=Erro: O CRECI deve ter pelo menos 2 caracteres.");
        exit();
    }

    if (strlen($nome) < 2) {
        header("Location: index.php?mensagem=Erro: O Nome deve ter pelo menos 2 caracteres.");
        exit();
    }

    // Verifica se é uma edição ou um novo cadastro
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE corretores SET nome=?, cpf=?, creci=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $cpf, $creci, $id);
        $mensagem = "Edição realizada com sucesso!";
    } else {
        $sql = "INSERT INTO corretores (nome, cpf, creci) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $cpf, $creci);
        $mensagem = "Cadastro realizado com sucesso!";
    }

    if ($stmt->execute()) {
        header("Location: index.php?mensagem=" . urlencode($mensagem));
        exit();
    } else {
        header("Location: index.php?mensagem=Erro ao processar a requisição.");
        exit();
    }
}

header("Location: index.php");
exit();
?>
