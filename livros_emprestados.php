<?php
session_start();

// Conexão com o banco de dados (substitua com suas próprias credenciais)
$host = 'localhost';
$dbname = 'final';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o Banco de Dados: " . $e->getMessage());
}

// Consulta para obter os livros emprestados
$stmt = $pdo->query("SELECT * FROM cadastrarlivros WHERE emprestado = 1");
$livrosEmprestados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Emprestados</title>
    <!-- Adicione aqui os estilos CSS, se necessário -->
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    color: #333;
    text-align: center;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table th,
table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

table th {
    background-color: #4CAF50;
    color: white;
}

a {
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}



</style>
<body>
    <h2>Livros Emprestados</h2>

    <?php
    if ($livrosEmprestados) {
        echo "<table>";
        echo "<tr><th>Título</th><th>Autor</th><th>Gênero</th><th>Ano de Publicação</th><th>Descrição</th><th>Ação</th></tr>";

        foreach ($livrosEmprestados as $livro) {
            echo "<tr>";
            echo "<td>" . $livro['titulo'] . "</td>";
            echo "<td>" . $livro['autor'] . "</td>";
            echo "<td>" . $livro['genero'] . "</td>";
            echo "<td>" . $livro['ano_publicacao'] . "</td>";
            echo "<td>" . $livro['descricao'] . "</td>";
            echo "<td><a href='processa_devolucao.php?id=" . $livro['id'] . "'>Devolver Livro</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nenhum livro emprestado no momento.</p>";
    }
    ?>

    <!-- Adicione aqui qualquer outro conteúdo HTML, como links de navegação, rodapé, etc. -->
</body>

</html>