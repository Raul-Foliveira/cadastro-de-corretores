<?php
include 'conexao.php';

$sql = "SELECT * FROM corretores ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Corretores</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>

    <h1>Cadastro de Corretor</h1>
    

    <form id="cadastroForm" action="processa.php" method="POST" onsubmit="return validarFormulario('cadastroForm')">
        <input type="text" name="nome" class="nome" placeholder="Digite seu nome">
        <input type="text" id="cpf" name="cpf" maxlength="11" class="cpf" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Digite o CPF">
        <input type="text" name="creci" class="creci" placeholder="Digite seu Creci">  
        <button type="submit">Enviar</button>
    </form>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2>Editar Corretor</h2>

            <form id="editarForm" action="editar.php" method="POST" onsubmit="return validarFormulario('editarForm')">
                <input type="hidden" name="id" class="id">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="nome" id="nome" placeholder="Nome">

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" class="cpf" id="cpf" placeholder="CPF" maxlength="11">

                <label for="creci">Creci:</label>
                <input type="text" name="creci" class="creci" id="creci" placeholder="Creci">

                <button type="submit">Salvar</button>
        </form>


            </div>
    </div>


    <h2>Lista de Corretores</h2>

    <?php if (isset($_GET['mensagem'])) { ?>
        <div id="mensagem" class="mensagem">
            <?php echo htmlspecialchars($_GET['mensagem']); ?>
        </div>
    <?php } ?>


    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Creci</th>
            <th>Ações</th>
        </tr>

        <?php while ($row = $resultado->fetch_assoc()) { ?>
        <tr>

            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['cpf']; ?></td>
            <td><?php echo $row['creci']; ?></td>
            
            <td>
            <button class="editar-btn"
                data-id="<?php echo $row['id']; ?>"
                data-cpf="<?php echo $row['cpf']; ?>"
                data-creci="<?php echo $row['creci']; ?>"
                data-nome="<?php echo $row['nome']; ?>">
                Editar
            </button>
            <a class="excluir-btn" href="excluir.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>

        </tr>

        <?php } ?>
    </table>

</body>
</html>
