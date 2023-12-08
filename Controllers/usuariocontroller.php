<?php
require_once 'Models/usuariomodel.php';



class usuariocontroller {

public function __construct($pdo) {
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    public function criarUsuario($usuario, $senha , $email) {
        $this->usuarioModel->criarUsuario($usuario, $senha , $email);
    }
    
}

?>