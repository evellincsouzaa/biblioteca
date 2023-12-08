<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contato.css">
    <title>Página de Contato</title>
</head>
<body>
<style>
/* Reset some default browser styles */
/* Reset some default browser styles */
body, h1, p {
    margin: 0;
    padding: 0;
}

/* Global styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    color: white;
    margin: 0;
    padding: 0;
    background: url('imagens/design 15.jpeg') center center fixed;
    background-size: cover;
}
  


header {
    background-color: #ffff ;
    color: black;
    text-align: center;
    padding: 20px;
}

.logo {
    position: absolute;
    top: -10px;
    left: 20px;
}

.volt {
    position: absolute;
    top: 20px;
    right: 20px;
    text-decoration: none;
    color: #3dfbd8;
    font-size: 18px;
}

/* Form styles */
section {
    max-width: 500px;
    margin: 20px auto;
    padding: 30px;
    background: url('imagens/design 15.jpeg') center center fixed; /* Add your image path */
    background-size: cover;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}


form {
    display: grid;
    gap: 15px;
}

label {
    font-weight: bold;
}

input,
textarea {
    width: 100%;
    padding: 12px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 15px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

/* Responsive styles */
@media (max-width: 768px) {
    section {
        width: 80%;
    }
}

@media (max-width: 480px) {
    section {
        width: 100%;
    }
}



</style>
    <header>
        <h1>𝐏á𝐠𝐢𝐧𝐚 𝐝𝐞 𝐂𝐨𝐧𝐭𝐚𝐭𝐨</h1>
    </header>

    <img class="logo" src="imagens/Biblioteca Virtual.png" width="100px">
    <a class="volt" href="index.php">Voltar </a>

    <section>
        <form action="https://api.web3forms.com/submit" method="post">
            <input type="hidden" name="access_key" value="87ae0526-ea79-4a28-bb67-0712d8487d9a">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="name" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="message" rows="4" required></textarea>

            <div class="h-captcha" data-captcha="true"></div>
            <button type="submit">Enviar</button>
        </form>
    </section>

    <script src="https://web3forms.com/client/script.js" async defer></script>
</body>
</html>
