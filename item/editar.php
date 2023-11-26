<?php 
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $cliente = $_POST['cliente_id'];
        $nome = $_POST['nome'];

        $sql_editar = "UPDATE Item SET cliente = '$cliente', nome = '$nome' WHERE id=$id";

        if ($conexao -> query($sql_editar) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro ao atualizar: " . $conexao -> error;
        }
    }
    else {
        $id = $_GET['id'];
        $sql_editar = "SELECT id, cliente, nome FROM Item WHERE id=$id";
        $result = $conexao -> query($sql_editar);
        if ($result -> num_rows > 0) {
            $Item = $result -> fetch_assoc();
        }
        else {
            echo "Tarefa não encontrada!";
            exit;
        }
    }
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
            <input type="hidden" name="id" value="<?php echo $Item['id']; ?>">
            <p>Nome: <input type="text" name="nome" class="caixa_texto" value="<?php echo $Item['nome']; ?>"></p>
            <p>Cliente: <select name="cliente_id" class="seletor" id="cliente_id"></p>
                <option value="">Selecione um Cliente</option>
                <?php
                    $sql_cliente = "SELECT id, nome FROM Cliente";
                    $result_cliente = $conexao->query($sql_cliente);
                    while ($row = $result_cliente->fetch_assoc()) {
                        $cliente_id= $row['id'];
                        $cliente_nome = $row['nome'];
                        echo "<option value='$cliente_id'>$cliente_nome</option>";
                    }
                ?>
            </select>
            <p><input type="submit" value="Salvar" id="botao"></p>
        </form>
    </main>
</body>
</html>

<?php
    $conexao -> close();
?>