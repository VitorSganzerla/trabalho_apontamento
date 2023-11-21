<?php
    include '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
</head>
<body>
    <form action="adicionar.php" method="post">
        <select name="cliente_id" id="cliente_id">
            <option value="">Selecione um Cliente</option>
            <?php
                $sql_cliente = "SELECT id, nome FROM Cliente";
                $result_cliente = $conexao->query($sql_cliente);

                while ($row = $result_cliente ->fetch_assoc()) {
                    $cliente_id = $row['id'];
                    $cliente_nome = $row['nome'];
                    echo "<option value='$cliente_id'>$cliente_nome</option>";
                }
            ?>
        </select>
        <p>Nome: <input type="text" name="nome_item"></p>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $cliente_id = $_POST['cliente_id'];
        $nome = $_POST['nome_item'];

        $sql_adicionar = "INSERT INTO Item (cliente, nome) VALUES ('$cliente_id', '$nome')";

        if ($conexao ->query($sql_adicionar) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro: " . $conexao->error;
        }
    }
    $conexao -> close();
?>

