<?php
    include '../conexao.php';

    $sql_listar = "SELECT id, nome, numero_matricula, criado_em, atualizado_em FROM Operador";
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
    <header>
        <nav>
            <a href="../cliente/adicionar.php">Cliente </a>
            <a href="../item/adicionar.php">Item </a>
            <a href="../bobina/adicionar.php">Bobina </a>
        </nav>
    </header>
    <main class="center">
        <h1>Operadores</h1>
        <a href="adicionar.php">Registrar novo operador</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Número de Matrícula</th>
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
                            echo "<td>" . $row["nome"] . "</td>";
                            echo "<td>" . $row["numero_matricula"] . "</td>";
                            echo "<td>" . $row["criado_em"] . "</td>";
                            echo "<td>" . $row["atualizado_em"] . "</td>";
                            echo "<td><a href='editar.php? id=" . $row["id"] . "'>Editar </a> | <a href='deletar.php? id=" . $row["id"] . "'>Deletar </a></td>";
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
    <footer>
        <a href="adicionar.php">Adicionar</a>
    </footer>
</body>
</html>

<?php 
    $conexao -> close();
?>