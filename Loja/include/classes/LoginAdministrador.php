<?php

class LoginAdministrador {

    private $Administrador;
    private $AdministradorDAO;
    private $usuario;
    private $senha;
    private $motivo;

    public function __construct($usuario, $senha) {
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->AdministradorDAO = new AdministradorDAO();
    }

    public function login() {
        $this->administradorPadrao();
        $retorno = $this->AdministradorDAO->consultaLogin($this->usuario);

        if ($retorno) {
            $this->Administrador = $retorno;

            if ($this->Administrador->getSenha() == md5($this->senha)) {
                $this->abrirSessao($this->Administrador->getId());
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

    private function administradorPadrao() {
        $retorno = $this->AdministradorDAO->getQtdAdministradores();
        if ($retorno['qt_registros'] == 0) {
            $this->AdministradorDAO->inserir(new Administrador(NULL, 'Administrador', 'admin', '202cb962ac59075b964b07152d234b70'));
        }
    }

    private function abrirSessao($id) {
        session_start();
        $_SESSION['id_administrador'] = $id;
    }

    public function getMotivo() {
        return $this->motivo;
    }

}
