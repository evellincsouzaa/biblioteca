<?php
class usuarioModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criarUsuario($usuario, $senha , $email) {
        $sql = "INSERT INTO usuarios (usuario, senha ,email) VALUES (?, ?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario, $senha , $email]);
    }

    public function listarUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}