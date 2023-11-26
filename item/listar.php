<?php
    include '../conexao.php';

    $sql_listar = "SELECT i.id, c.nome as nome_cliente, i.nome, i.criado_em, i.atualizado_em FROM Item as i INNER JOIN Cliente as c ON i.cliente = c.id";
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
        <h1>Itens</h1>
        <a href="adicionar.php">Registrar novo item</a>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Nome</th>
                    <th>Data de Criação</th>
                    <th>Data de Alteração</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result -> num_rows > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["nome_cliente"] . "</td>";
                            echo "<td>" . $row["nome"] . "</td>";
                            echo "<td>" . $row["criado_em"] . "</td>";
                            echo "<td>" . $row["atualizado_em"] . "</td>";
                            echo "<td><a href='editar.php? id=" . $row["id"] . "'>Editar </a> | <a href='deletar.php? id=" . $row["id"] ."'>Deletar </a></td>";
                            echo "</tr>";
                        }
                    }
                    else {
                        echo "<tr> <td colspan = '6'> Sem tarefas </td> </tr>";
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