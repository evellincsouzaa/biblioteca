<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Biblvirtual</title>
</head>
<body>

<!-- Cabeçalho -->
<header>
    <h1>𝐁𝐢𝐛𝐥𝐢𝐨𝐭𝐞𝐜𝐚 𝐕𝐢𝐫𝐭𝐮𝐚𝐥</h1>
    <br>
    <div class="header-buttons">
       
        <a class="button-link" href="listarlivros.php">𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐫 𝐋𝐢𝐯𝐫𝐨𝐬</a>
        <a class="button-link" href="contato.php">𝐂𝐨𝐧𝐭𝐚𝐭𝐨</a>
        <a class="button-link" href="políticadeprivacidade.php">𝐏𝐨𝐥í𝐭𝐢𝐜𝐚 𝐝𝐞 𝐏𝐫𝐢𝐯𝐚𝐜𝐢𝐝𝐚𝐝𝐞</a>
        <a href="#" class="confirm-link" onclick="confirmLogout()">   
<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("location: login.php");
    exit;
}

echo "<h3 class='welcome-message'>Olá, " . $_SESSION["usuario"] . "</h3>";
?>
</a>

    </div>
</header>


<!-- LOGO -->
<img class="logo" src="imagens/Biblioteca Virtual.png" width="300px">

<!-- Vídeo de fundo -->
<div class="video-background">
    <video id="background-video" autoplay muted loop>
        <source src="imagens/Olivia's Channel (1).mp4" type="video/mp4">
        Seu navegador não suporta o elemento de vídeo.
    </video>
</div>
<!-- Rodapé -->


<style>
footer {
    
    background-color: #fff;
    color: #333;
    text-align: center;
    padding: 20px;
    position: absolute;
    bottom: 0;
    width: 98%;
    height: 30px;
    top:660px;
    left:-9px;
    
    
    
   
}


.footer-text a {
    color: #ffd700; /* Cor do link */
   
}

.footer-text a:hover {
    text-decoration: underline;
}

h5{
    position:absolute;
top:-10px;

}

    </style>
<footer>
    <div class="footer-icons">
        <h5>&copy; 2023 Biblvirtual. Todos os direitos reservados.  <p>Desenvolvido por <a href="https://evellincsouzaa.github.io" target="_blank">Evellin</a></h5>
    </div>
</footer>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        var video = document.getElementById("background-video");

        video.addEventListener("ended", function() {
            // Aguarda 10 segundos antes de reiniciar o vídeo
            setTimeout(function() {
                video.currentTime = 0;
                video.play();
            }, 90000); // 10000 milissegundos = 10 segundos
        });
    });

    window.addEventListener("scroll", function() {
        var rolt = document.getElementById("initial-rolt");
        if (window.scrollY > 0) {
            rolt.id = "fixed-rolt";
        } else {
            rolt.id = "initial-rolt";
        }
    });
</script>
<script>
function confirmLogout() {
    var confirmLogout = confirm("Você realmente deseja sair da sua conta?");
    if (confirmLogout) {
        window.location.href = 'logout.php';
    }
}
</script>

</body>
</html>
