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

if (isset($_GET['id'])) {
    $livroId = $_GET['id'];

    try {
        // Atualiza o status do livro para não emprestado
        $stmt = $pdo->prepare("UPDATE cadastrarlivros SET emprestado = 0 WHERE id = :livroId");
        $stmt->bindParam(':livroId', $livroId);
        $stmt->execute();

        $_SESSION['devolucao_mensagem'] = "Livro devolvido com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['devolucao_mensagem'] = "Erro ao devolver o livro: " . $e->getMessage();
    }

    // Redireciona de volta para a página de livros emprestados
    header("Location: livros_emprestados.php");
    exit();
} else {
    $_SESSION['devolucao_mensagem'] = "ID do livro não fornecido.";
    header("Location: livros_emprestados.php");
    exit();
}
?>