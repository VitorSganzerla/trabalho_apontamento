<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $metragem = $_POST['metragem'];
        $peso = $_POST['peso'];
        $operador = $_POST['operador_id'];
        $item = $_POST['item_id'];
        $cliente = $_POST['cliente_id'];

        $sql_editar = "UPDATE Bobina SET metragem = '$metragem', peso = '$peso', operador = '$operador', item = '$item', cliente = '$cliente' WHERE id=$id";

        if ($conexao -> query($sql_editar) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro ao atualizar: " . $conexao -> error;
        }
    }
    else {
        $id = $_GET['id'];
        $sql_editar = "SELECT id, metragem, peso, operador, item, cliente FROM Bobina WHERE id=$id";
        $result = $conexao -> query($sql_editar);
        if ($result -> num_rows > 0) {
            $Bobina = $result -> fetch_assoc();
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
    <title>Editar</title>
</head>
<body>
    <form action="editar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $Bobina['id']; ?>">
        Metragem: <input type="text" name="metragem" value="<?php echo $Bobina['metragem']; ?>">
        Peso: <input type="text" name="peso" value="<?php echo $Bobina['peso']; ?>">
        Operador: <select name="operador_id" id="operador_id">
            <option value="">Selecione um Operador</option>
            <?php
                $sql_operador = "SELECT id, nome FROM Operador";
                $result_operador = $conexao->query($sql_operador);

                while ($row = $result_operador->fetch_assoc()) {
                    $operador_id = $row['id'];
                    $operador_nome = $row['nome'];
                    echo "<option value='$operador_id'>$operador_nome</option>";
                }
            ?>
        </select>
        Item: <select name="item_id" id="item_id">
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
        Cliente: <select name="cliente_id" id="cliente_id">
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
        <input type="submit" value="Salvar">
    </form>
</body>
</html>

<?php
    $conexao -> close();
?>