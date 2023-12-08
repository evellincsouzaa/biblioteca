<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_digitado = $_POST["usuario"];
    $senha_digitada = $_POST["senha"];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=final", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão com o Banco de Dados: " . $e->getMessage());
    }

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario_digitado]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha_digitada, $user["senha"])) {
        $_SESSION["usuario"] = $usuario_digitado;
        $_SESSION["permissao"] = $user['permissao'];

        if ($_SESSION["permissao"] == "1") {
            header("location: admin.php");
            exit();
        } else {
            header("location: index.php");
            exit();
        }
    } else {
        echo "<script>alert('Login Falhou. Verifique suas credenciais.')</script>";
    }
}
?>