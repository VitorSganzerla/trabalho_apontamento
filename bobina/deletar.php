<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];

        $sql_deletar = "DELETE FROM Bobina WHERE id=$id";

        if ($conexao -> query($sql_deletar) === TRUE) {
            header ("Location: listar.php");
        }
        else {
            echo "Erro ao deletar: " . $conexao -> error;
        }
    }

    $conexao -> close();
?>