<?php
session_start();
if($_SESSION ['permissao'] == 1){

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <link rel="stylesheet" href="admin.css">
        <title>Admin</title>
    </head>
    <body>
    
    <body style="background: url('imagens/Coming Soon Website in Emerald Mint Green Aspirational Elegance Style (6).png') no-repeat center center fixed; background-size: cover;">
        <!-----------------LOGO----------------->
    

    <?php
    
    if (!isset($_SESSION["usuario"])) {
        header("location: login.php");
        exit;
    }
    
    echo "<h1 class='welcome-message'>Sejá Bem Vindo a Sua Pagina, " . $_SESSION["usuario"] . "</h1>";
    ?>
    </a>

    <style>
        h5{
            position:absolute;
            color:white;
            top:210px;
            font-size:25px;
            left:638px;
        }

        </style>
    <h5>Painel Administrativo</h5>
    <div class="menu">
        
            <a href="#" class="toggle-link" onclick="toggleTable()"></a>
            <table id="myTable" class="table-show">
                <tr>
                    <th>Menu</th>
                </tr>
                <tr>
                    <td><a href="index.php">Ir para a Página Inicial</a></td>
                </tr>
                <tr>
                    <td><a href="listarlivrosadmin.php">Cadastrar Livros</a></td>
                </tr>
                <tr>
                    <td><a href="usuarioscadastrador.php">Cadastro de Pessoas</a></td>
                </tr>

                <!-- Adicione isso onde deseja exibir os livros reservados -->
                <td><a href="livros_emprestados.php">Ver Livros Reservados</a></td>
                </tr>

            </table>
        </div>
    </body>
    </html>
    
    
    <!-----------Script de Menu--------------->
    <script>
            function toggleTable() {
                var table = document.getElementById("myTable");
                if (table.style.display === "none") {
                    table.style.display = "table";
                } else {
                    table.style.display = "none";
                }
            }
        </script>
            <script>
            function toggleTable() {
                var table = document.getElementById("myTable");
                table.classList.toggle("table-show");
            }
        </script>

<?php
} else {
    header('Location: index.php');
}


?>