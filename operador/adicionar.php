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
            <p>Nome: <input type="text" name="nome" required class="caixa_texto" required></p>
            <p>Número de Matrícula: <input type="text" name="numero_matricula" required class="caixa_texto"></p>
            <input type="submit" value="Enviar" id="botao">
        </form>
    </main>
</body>
</html>

<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST ['nome'];
        $numero_matricula = $_POST ['numero_matricula'];

        $sql_insercao = 
        "INSERT INTO Operador (nome, numero_matricula) 
        VALUES ('$nome', '$numero_matricula')";
        if ($conexao -> query($sql_insercao) === TRUE) {
            header("Location: listar.php");
        }
        else {
            echo "Erro: " . $conexao -> error;
        }
    }

    $conexao -> close();
?>