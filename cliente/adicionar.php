<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Adicionar</title>
</head>
<body>
    <form action="adicionar.php" method="post">
        <p>Nome: <input type="text" name="nome" required></p>
        <p>Cidade: <input type="text" name="cidade"></p>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST ['nome'];
        $cidade = $_POST ['cidade'];

        $sql_insercao = 
        "INSERT INTO Cliente (nome, cidade)
        VALUES ('$nome', '$cidade')";
        if ($conexao -> query($sql_insercao) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro: " . $conexao -> error;
        }
    }

    $conexao -> close();
?>