<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cidade = $_POST['cidade'];

        $sql_editar = "UPDATE Cliente SET nome ='$nome', cidade = '$cidade' WHERE id=$id";
        if ($conexao -> query($sql_editar) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro ao atualizar: " . $conexao -> error;
        }
    }
    else {
        $id = $_GET['id'];
        $sql_editar = "SELECT id, nome, cidade FROM Cliente WHERE id=$id";
        $result = $conexao -> query($sql_editar);
        if ($result -> num_rows > 0) {
            $Cliente = $result -> fetch_assoc();
        }
        else {
            echo "Tarefa não encontrada";
            exit;
        }
    }

    $conexao -> close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Document</title>
</head>
<body>
    <main class="center"> 
        <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $Cliente['id']; ?>">
            <p>Nome: <input type="text" name="nome" class="caixa_texto" value="<?php echo $Cliente['nome']; ?>"></p>
            <p>Cidade: <input type="text" name="cidade" class="caixa_texto" value="<?php echo $Cliente['cidade']; ?>"></p>
            <input type="submit" value="Salvar" id="botao">
        </form>
    </main>
</body>
</html>