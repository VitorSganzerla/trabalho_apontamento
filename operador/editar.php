<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $numero_matricula = $_POST['numero_matricula'];

        $sql_editar = "UPDATE Operador SET nome = '$nome', numero_matricula = '$numero_matricula' WHERE id=$id";
        
        if ($conexao -> query($sql_editar) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro ao atualizar: " . $conexao -> error;
        }
    }
    else {
        $id = $_GET['id'];
        $sql_editar = "SELECT id, nome, numero_matricula FROM Operador WHERE id=$id";
        $result = $conexao -> query($sql_editar);
        if ($result -> num_rows > 0) {
            $Operador = $result -> fetch_assoc();
        }
        else {
            echo "Tarefa não encontrada!";
            exit;
        }
    }

$conexao -> close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Editar</title>
</head>
<body>
    <main class="center">
        <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $Operador['id']; ?>">
            <p>Nome: <input type="text" name="nome" class="caixa_texto" value="<?php echo $Operador['nome']; ?>"></p>
            <p>Número de Matrícula: <input type="text" name="numero_matricula" class="caixa_texto" value="<?php echo $Operador['numero_matricula']; ?>"></p>
            <input type="submit" value="Salvar" id="botao">
        </form>
    </main>
</body>
</html>