<?php
    include '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Adicionar</title>
</head>
<body>
    <main class="center">
        <form action="adicionar.php" method="post">
            <p>Cliente:
            <select name="cliente_id" id="cliente_id" class="seletor">
                <option value="">Selecione um Cliente</option></p>
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
            <p>Nome: <input type="text" name="nome_item" class="caixa_texto" required></p>
            <input type="submit" value="Enviar" id="botao">
        </form>
    </main>
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

