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

<form action="editar.php" method="post">
    <input type="hidden" name="id" value="<?php echo $Cliente['id']; ?>">
    Nome: <input type="text" name="nome" value="<?php echo $Cliente['nome']; ?>"><br>
    Cidade: <input type="text" name="cidade" value="<?php echo $Cliente['cidade']; ?>">
    <input type="submit" value="Salvar">
</form>