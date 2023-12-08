<?php
session_start();
if ($_SESSION ['permissao'] == 1){ 
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

$stmt = $pdo->query("SELECT * FROM cadastrarlivros ");
$stmt->execute();
$livros = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Livros</title>
    <link rel="stylesheet" href="listarlivrosadmin.css">
</head>

<body>
    <div class="container">
        <h2>Listar Livros</h2>

        <?php if (!empty($livros)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Capa</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Gênero</th>
                        <th>Ano de Publicação</th>
                        <th>Descrição</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro) : ?>
                        <tr>
                            <td><img style="max-width: 50px;" src="<?= $livro['imagem'] ?>"></td>
                            <td><?= $livro['titulo'] ?></td>
                            <td><?= $livro['autor'] ?></td>
                            <td><?= $livro['genero'] ?></td>
                            <td><?= $livro['ano_publicacao'] ?></td>
                            <td><?= $livro['descricao'] ?></td>
                            <td><a href="atualizarlivros.php?id=<?php echo $livro['id']; ?>">Atualizar Livro</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Nenhum livro encontrado.</p>
        <?php endif; ?>

        <p><a href="cadastrarlivros.php">Cadastrar Novo Livro</a></p>
        <a class="pdf" href="pdf.php">Imprimir</a>
    </div>
    <?php
}else{

    header ('Location: index.php');
}
?>
</body>

</html>
