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

// Verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $livroId = $_GET['id'];

    // Recupera as informações do livro com base no ID
    $stmt = $pdo->prepare("SELECT * FROM cadastrarlivros WHERE id = :id");
    $stmt->bindParam(':id', $livroId);
    $stmt->execute();
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o livro existe
    if (!$livro) {
        die("Livro não encontrado.");
    }
} else {
    die("ID do livro não fornecido.");
}

// Lógica para processar o formulário de atualização quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar os dados do formulário e atualizar no banco de dados
    // ...
// Lógica para processar o formulário de atualização quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos obrigatórios estão preenchidos
    if (isset($_POST['titulo'], $_POST['autor'], $_POST['genero'], $_POST['ano_publicacao'], $_POST['descricao'], $_POST['imagem'])) {
        try {
            // Atualiza os valores no banco de dados
            $updateStmt = $pdo->prepare("UPDATE cadastrarlivros SET 
                titulo = :titulo,
                autor = :autor,
                genero = :genero,
                ano_publicacao = :ano_publicacao,
                descricao = :descricao,
                imagem = :imagem
                WHERE id = :id");

            // Vincula os valores dos campos do formulário
            $updateStmt->bindParam(':titulo', $_POST['titulo']);
            $updateStmt->bindParam(':autor', $_POST['autor']);
            $updateStmt->bindParam(':genero', $_POST['genero']);
            $updateStmt->bindParam(':ano_publicacao', $_POST['ano_publicacao']);
            $updateStmt->bindParam(':descricao', $_POST['descricao']);
            $updateStmt->bindParam(':imagem', $_POST['imagem']);
            $updateStmt->bindParam(':id', $livroId);

            // Executa a atualização no banco de dados
            $updateStmt->execute();

            // Redireciona de volta para a página de listagem após a atualização
            header("Location: listarlivros.php");
            exit;
        } catch (PDOException $e) {
            die("Erro na atualização do livro: " . $e->getMessage());
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}

    // Redirecionar de volta para a página de listagem após a atualização
    header("Location: listarlivros.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Livro</title>
    <link rel="stylesheet" href="atualizarlivros.css">
</head>

<body>
    <div class="container">
        <h2>Atualizar Livro</h2>

        <form method="post" action="">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?= $livro['titulo'] ?>" required>

            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" value="<?= $livro['autor'] ?>" required>

            <label for="genero">Gênero:</label>
            <input type="text" id="genero" name="genero" value="<?= $livro['genero'] ?>" required>

            <label for="ano_publicacao">Ano de Publicação:</label>
            <input type="text" id="ano_publicacao" name="ano_publicacao" value="<?= $livro['ano_publicacao'] ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" required><?= $livro['descricao'] ?></textarea>

            <label for="imagem">URL da Imagem da Capa:</label>
            <input type="text" id="imagem" name="imagem" value="<?= $livro['imagem'] ?>" required>

            <input type="submit" value="Atualizar Livro">
        </form>

        <p><a href="listarlivros.php">Voltar para a lista de livros</a></p>
    </div>
<?php
}else{

    header ('Location: index.php');
}
?>
</body>



</html>
