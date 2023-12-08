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

// Verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $livroId = $_GET['id'];

    // Obtém as informações do livro
    $stmt = $pdo->prepare("SELECT * FROM cadastrarlivros WHERE id = :livroId");
    $stmt->bindParam(':livroId', $livroId);
    $stmt->execute();
    $livro = $stmt->fetch();

    // Exibe as informações do livro
    if ($livro) {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Informações do Livro</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }

                .container {
                    max-width: 800px;
                    margin: 20px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h2 {
                    color: #333;
                    text-align: center;
                }

                table {
                    width: 100%;
                    margin-top: 20px;
                    border-collapse: collapse;
                }

                table img {
                    width: 20%;
                    height: 200px;
                    margin-bottom: 20px;
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }

                td {
                    padding: 10px;
                    border-bottom: 1px solid #ddd;
                }

                strong {
                    font-weight: bold;
                }

                p {
                    margin-top: 10px;
                }

                .success-message {
                    color: green;
                    text-align: center;
                    font-weight: bold;
                }

                .error-message {
                    color: red;
                    text-align: center;
                    font-weight: bold;
                }
            </style>
        </head>
        <body style="background: url('imagens/WhatsApp Image 2023-12-07 at 18.15.21 (1).jpeg') no-repeat center center fixed; background-size: cover;">
            <div class="container">
                <h2>Informações do Livro</h2>
                <table>
                    <tr><td><img src="<?= $livro['imagem'] ?>" alt="Capa do Livro"></td></tr>
                    <tr><td><strong>Título:</strong> <?= $livro['titulo'] ?></td></tr>
                    <tr><td><strong>Autor:</strong> <?= $livro['autor'] ?></td></tr>
                    <tr><td><strong>Gênero:</strong> <?= $livro['genero'] ?></td></tr>
                    <tr><td><strong>Ano de Publicação:</strong> <?= $livro['ano_publicacao'] ?></td></tr>
                    <tr><td><strong>Descrição:</strong> <?= $livro['descricao'] ?></td></tr>
                </table>

                <!-- Exibição de mensagens de sucesso ou erro -->
                <?php
                if (isset($_SESSION['emprestimo_mensagem'])) {
                    echo "<p class='success-message'>" . $_SESSION['emprestimo_mensagem'] . "</p>";
                    unset($_SESSION['emprestimo_mensagem']);
                }
                ?>
            </div>
<style>
.vol{
    color:green;
    font-size:20px;
    position:absolute;
    top:70px;
    text-decoration:none;
    left:73%
  
}


</style>

            <a class="vol" href="listarlivros.php">Voltar </a>
        </body>
        </html>
        <?php
    } else {
        echo "<p class='error-message'>Livro não encontrado.</p>";
    }
} else {
    echo "<p class='error-message'>ID do livro não fornecido.</p>";
}
?>
