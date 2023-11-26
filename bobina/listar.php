<?php
    include '../conexao.php';

    $sql_listar = "SELECT b.id, b.metragem, b.peso, o.nome as operador, i.nome as item, c.nome as cliente, b.criado_em, b.atualizado_em 
    FROM Bobina as b LEFT JOIN Operador as o ON b.operador = o.id LEFT JOIN Item as i ON b.item = i.id 
    LEFT JOIN Cliente as c ON b.cliente = c.id";
    $result = $conexao -> query($sql_listar);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Listar</title>
</head>
<body>
    <main class="center">
        <h1>Bobinas</h1>
        <a href="adicionar.php">Registrar nova operação</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Metragem</th>
                    <th>Peso</th>
                    <th>Operador</th>
                    <th>Item</th>
                    <th>Cliente</th>
                    <th>Data de Criação</th>
                    <th>Data de Alteração</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result -> num_rows > 0) {
                        while($row = $result -> fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["metragem"] . "</td>";
                            echo "<td>" . $row["peso"] . "</td>";
                            echo "<td>" . $row["operador"] . "</td>";
                            echo "<td>" . $row["item"] . "</td>";
                            echo "<td>" . $row["cliente"] . "</td>";
                            echo "<td>" . $row["criado_em"] . "</td>";
                            echo "<td>" . $row["atualizado_em"] . "</td>";
                            echo "<td> <a href='editar.php? id=" . $row["id"] . "'>Editar</a> | <a href='deletar.php? id= " . $row["id"] ."'>Deletar</a></td>";
                            echo "</tr>";
                        }
                    }
                    else {
                        echo "<tr><td colspan='9'>Sem tarefas</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php
    $conexao -> close();
?>