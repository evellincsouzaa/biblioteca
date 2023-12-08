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
    <link rel="stylesheet" href="listarlivros.css">
</head>

<body>
    <style>
     
        body,
        h1,
       
        p,
        table {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #e7fffe;
        }

        .container {
            max-width: 100%;
            margin: 30px auto;
            background-color: #e7fffe;
            padding: 20px;
            border-radius: 0px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            
      
        }

        h2 {
            color: white;
            position:absolute;
         left:740px;
            top:60px;
            animation: changeColor 2s infinite;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 130px;
            background-image: url('img/Design sem nome (16).png'); /* Substitua 'sua-imagem.jpg' pelo caminho correto da sua imagem */
            background-size: cover; /* Ajusta o dimensionamento da imagem */
            background-position: center; /* Centraliza a imagem */
            background-repeat: no-repeat;
        }

        thead {
            background-color: #54cfbd;
            color: white;
        }

        th,
        td {
            padding: 120px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        p {
            margin-top: 10px;
        }

        
        p.no-books {
            font-style: italic;
            color: white;
      



            .livros-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .livro-row {
            display: flex;
            justify-content: center; /* Center the books horizontally */
            align-items: center; /* Center the books vertically */
        }

        .livro {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            width: calc(33.33% - 40px);
            box-sizing: border-box;
            display: inline-block;
            position: relative; /* Added relative positioning */
        }

        .livro a {
            position: absolute;
            bottom: 10px; /* Adjust the distance from the bottom as needed */
            left: 50%;
            transform: translateX(-50%);
        }

.botao {
            display: inline-block;
            padding: 10px 20px;
            background-color: #54cfbd;
            color:white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        /* Estilo para a classe "botao" quando o mouse passa por cima */
        .botao:hover {
            background-color: #54cfbd;
        }
        }
        p{
            color: white;
            font-size:20px;
            
        }
        @keyframes changeColor {
      0% { color: rgb(255, 0, 0); }
      33% { color: rgb(0, 255, 0); }
      66% { color: rgb(0, 0, 255); }
      100% { color: rgb(255, 0, 0); }
    }
    .logo{
        position:absolute;
        left:120px;
        top: 30px;
    }
    .dev{
        position:absolute;
        top:90px;
        left:92%;
        text-decoration:none;
        color:white;
        font-size:18px;
    }
  
    </style>
   <h2>Ebooks</h2>
    
  <div class="container">
  <a class="dev" href="index.php">Voltar </a>
  <img class="logo" src="imagens/Biblioteca Virtual.png" width="170px">

        <?php if (!empty($livros)) : ?>
            <table class="livros-table">
                <thead>
                    <!-- Seu cabeçalho da tabela aqui... -->
                </thead>
                <tbody>
                    <?php foreach ($livros as $index => $livro) : ?>
                        <?php if ($index % 3 === 0) : ?>
                            <!-- Inicia uma nova linha a cada três livros -->
                            <tr class="livro-row">
                        <?php endif; ?>
                        <td class="livro">
                      <b>  <p><?= $livro['titulo'] ?></p></b>
                            <img style="max-width: 160px;" src="<?= $livro['imagem'] ?>">
                            <a href="#" onclick="emprestarLivro(<?= $livro['id'] ?>)" style="display: inline-block; padding: 10px 20px; font-size: 16px; text-align: center; text-decoration: none; background-color: #54cfbd; color: white; border: 1px solid #4CAF50; border-radius: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='#45a049'" onmouseout="this.style.backgroundColor='#4CAF50'">Emprestar</a>



                        </td>
                        <?php if (($index + 1) % 3 === 0 || ($index + 1) === count($livros)) : ?>
                            <!-- Fecha a linha a cada três livros ou no último livro -->
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Nenhum livro encontrado.</p>
        <?php endif; ?>
    </div>
<!-- Rodapé -->

    
    <script>
        function emprestarLivro(livroId) {
            // Adapte a URL de redirecionamento conforme necessário
            window.location.href = 'pagina_emprestimo.php?id=' + livroId;
        }
    </script>
</body>

</html>











