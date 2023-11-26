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
    <link rel="stylesheet" href="../style/style.css">
    <title>Editar</title>
</head>
<body>
    <main class="center">
        <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $Bobina['id']; ?>">
            <p>Metragem: <input type="text" name="metragem" class="caixa_texto" value="<?php echo $Bobina['metragem']; ?>"></p>
            <p>Peso: <input type="text" name="peso" class="caixa_texto" value="<?php echo $Bobina['peso']; ?>"></p>
            <p><select name="operador_id" id="operador_id" class="seletor"></p>
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
            <p><select name="item_id" id="item_id" class="seletor"></p>
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
            <p><select name="cliente_id" id="cliente_id" class="seletor"></p>
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
            <p><input type="submit" value="Salvar" id="botao"></p>
        </form>
    </main>
</body>
</html>

<?php
    $conexao -> close();
?>