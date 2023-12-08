<?php
require_once "vendor/autoload.php";
require_once "config.php";
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$stmt = $pdo->query("SELECT * FROM cadastrarlivros");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Variável para armazenar o conteúdo das tabelas
$tablesContent = '';

// Itera sobre os resultados e cria uma tabela para cada livro
foreach ($livros as $livro) {
    $tableContent = "
        <table>
            <tr><td>Capa</td><td><img src='" . $livro['imagem'] . "' alt='Capa do Livro'></td></tr>
            <tr><td>Título</td><td>" . $livro['titulo'] . "</td></tr>
            <tr><td>Autor</td><td>" . $livro['autor'] . "</td></tr>
            <tr><td>Gênero</td><td>" . $livro['genero'] . "</td></tr>
            <tr><td>Ano de Publicação</td><td>" . $livro['ano_publicacao'] . "</td></tr>
            <tr><td>Descrição</td><td>" . $livro['descricao'] . "</td></tr>
        </table>";

    // Adiciona o conteúdo da tabela à variável principal
    $tablesContent .= $tableContent;
}
  

$dompdf->loadHtml($tablesContent);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>