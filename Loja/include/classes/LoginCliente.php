<?php

class LoginCliente {

    private $Cliente;
    private $ClienteDAO;
    private $email;
    private $senha;
    private $motivo;

    public function __construct($email, $senha) {
        $this->email = $email;
        $this->senha = $senha;
        $this->ClienteDAO = new ClienteDAO();
    }

    public function login() {
        $retorno = $this->ClienteDAO->consultaLogin($this->email);

        if ($retorno) {
            $this->Cliente = $retorno;

            if ($this->Cliente->getSenha() == md5($this->senha)) {
                $this->abrirSessao($this->Cliente->getId());
                $this->motivo = 'OK';
                return true;
            } else {
                $this->motivo = 'SENHA_INCORRETA';
                return false;
            }
        } else {
            $this->motivo = 'DADOS_INCORRETOS';
            return false;
        }
    }

    private function abrirSessao($id) {
        session_start();
        $_SESSION['id_cliente'] = $id;
    }

    public function getMotivo() {
        return $this->motivo;
    }

}
