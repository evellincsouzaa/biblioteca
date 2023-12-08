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

if (isset($_POST['emprestarLivro'])) {
    $livroId = $_POST['livroId'];

    // Lógica para salvar no banco de dados que o livro foi emprestado
    try {
        $stmt = $pdo->prepare("UPDATE cadastrarlivros SET emprestado = 1 WHERE id = :livroId");
        $stmt->bindParam(':livroId', $livroId);
        $stmt->execute();

        $_SESSION['emprestimo_mensagem'] = "Livro emprestado com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['emprestimo_mensagem'] = "Erro ao emprestar o livro: " . $e->getMessage();
    }

    // Redireciona de volta para a página de informações do livro
    header("Location: informacoeslivro.php?id=$livroId");
    exit();
}
?>