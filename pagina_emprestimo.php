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
?>
<!DOCTYPE html>
<html lang="en">

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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table img {
        max-width: 30%;
        height: auto;
        margin-bottom: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    h2 {
        color: #333;
    }

    p {
        margin-top: 10px;
    }

    p.no-books {
        font-style: italic;
        color: #888;
    }

    .success-message {
        color: green;
    }

    .error-message {
        color: red;
    }
</style>
<style>
    .emprestar-button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .emprestar-button:hover {
        background-color: #45a049;
    }
</style>

</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $livroId = $_GET['id'];

            // Obtenha as informações do livro
            $stmt = $pdo->prepare("SELECT * FROM cadastrarlivros WHERE id = :livroId");
            $stmt->bindParam(':livroId', $livroId);
            $stmt->execute();
            $livro = $stmt->fetch();

            if ($livro) {
                echo "<h2>Informações do Livro</h2>";
                echo "<form method='post' action='processa_emprestimo.php'>";
                echo "<table>";
                echo "<tr><td><img src='" . $livro['imagem'] . "' alt='Capa do Livro'></td></tr>";
                echo "<tr><td><strong>Título:</strong> " . $livro['titulo'] . "</td></tr>";
                echo "<tr><td><strong>Autor:</strong> " . $livro['autor'] . "</td></tr>";
                echo "<tr><td><strong>Gênero:</strong> " . $livro['genero'] . "</td></tr>";
                echo "<tr><td><strong>Ano de Publicação:</strong> " . $livro['ano_publicacao'] . "</td></tr>";
                echo "<tr><td><strong>Descrição:</strong> " . $livro['descricao'] . "</td></tr>";
                echo "</table>";
            
                // Adicione um campo hidden para enviar o ID do livro
                echo "<input type='hidden' name='livroId' value='" . $livro['id'] . "'>";
            
                // Botão para emprestar o livro
                echo "<form action='pagina_emprestimo.php' method='post'>";
                echo "<input type='hidden' name='livroId' value='" . $livro['id'] . "'>";
                echo "<input type='submit' name='emprestarLivro' value='Emprestar Livro' class='emprestar-button'>";
                echo "</form>";
                
                // Exibição de mensagens de sucesso ou erro
                if (isset($_SESSION['emprestimo_mensagem'])) {
                    echo "<p class='success-message'>" . $_SESSION['emprestimo_mensagem'] . "</p>";
                    unset($_SESSION['emprestimo_mensagem']);
                }
            } else {
                echo "<p class='error-message'>Livro não encontrado.</p>";
            }
        }
        ?>
    </div>
    
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background: url('imagens/WhatsApp Image 2023-12-07 at 18.35.50.jpeg') no-repeat center center fixed; background-size: cover;">
<style>
.logo{
    position:absolute;
    top:0px;
    left:-20px;
}

</style>
<img class="logo" src="imagens/Biblioteca Virtual (2)-fotor-bg-remover-20231124105341.png" width="230px">   
    <style>
a{
    position:absolute;
    top:40px;
    left:91%;
    text-decoration:none;
    font-size:23px;
    color:black;
 
            padding: 10px; /* Adiciona um preenchimento ao redor do texto para melhor aparência */
            transition: color 0.3s ease, border-color 0.3s ease; /* Adiciona uma transição suave para a mudança de cor */
            animation: colorChange 2s infinite;
            width:100px
}

a:hover {
            color: rgb(0, 86, 179); /* Cor quando o mouse passa sobre o link em RGB */
            border-color: rgb(0, 86, 179); /* Borda quando o mouse passa sobre o link em RGB */
        }

        @keyframes colorChange {
            0% {
                color: rgb(0, 123, 255);
                border-color: rgb(0, 123, 255);
            }
            50% {
                color: rgb(255, 0, 0); /* Cor desejada no meio da animação em RGB */
                border-color: rgb(255, 0, 0); /* Borda desejada no meio da animação em RGB */
            }
            100% {
                color: rgb(0, 123, 255);
                border-color: rgb(0, 123, 255);
            }
        }
       </style>
    <a href="listarlivros.php">Voltar </a>
</body>
</html>