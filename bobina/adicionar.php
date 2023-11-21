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
        Metragem: <input type="number" name="metragem">
        Peso: <input type="number" name="peso">
        <select name="operador_id" id="operador_id">
            <option value="">Selecione um Operador</option>
            <?php
                $sql_operador = "SELECT id, nome FROM Operador";
                $result_operador = $conexao->query($sql_operador);

                while ($row = $result_operador->fetch_assoc()) {
                    $operador_id= $row['id'];
                    $operador_nome = $row['nome'];
                    echo "<option value='$operador_id'>$operador_nome</option>";
                }
            ?>
        </select>
        <select name="item_id" id="item_id">
            <option value="">Selecione um Item</option>
            <?php
                $sql_item = "SELECT id, nome FROM Item";
                $result_item = $conexao->query($sql_item);

                while ($row = $result_item->fetch_assoc()) {
                    $item_id = $row['id'];
                    $item_nome = $row['nome'];
                    echo "<option value='$item_id'>$item_nome</option>";
                }
            ?>
        </select>
        <select name="cliente_id" id="cliente_id">
            <option value="">Selecione um Cliente</option>
            <?php
                $sql_cliente = "SELECT id, nome FROM Cliente";
                $result_cliente = $conexao->query($sql_cliente);

                while ($row = $result_cliente->fetch_assoc()) {
                    $cliente_id = $row['id'];
                    $cliente_nome = $row['nome'];
                    echo "<option value='$cliente_id'>$cliente_nome</option>";
                }
            ?>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $metragem = $_POST['metragem'];
        $peso = $_POST['peso'];
        $operador_id = $_POST['operador_id'];
        $item_id = $_POST['item_id'];
        $cliente_id = $_POST['cliente_id'];

        $sql_adicionar = "INSERT INTO Bobina (metragem, peso, operador, item, cliente) VALUES ('$metragem', '$peso', '$operador_id', '$item_id', '$cliente_id') ";

        if ($conexao -> query($sql_adicionar) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro: " . $conexao -> error; 
        }
    }

    $conexao -> close();
?>