<?php

header('Content-type: application/json; charset=UTF-8');

include './FuncionarioControl.php';

class LoginFuncionario {

    private $usuario;
    private $senha;
    private $motivo;
    private $Funcionario;
    private $FuncionarioControl;

    public function __construct($usuario, $senha) {
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->FuncionarioControl = new FuncionarioControl();
    }

    public function login() {
        $this->FuncionarioControl->funcionarioPadrao();
        $retorno = $this->FuncionarioControl->consultaLogin($this->usuario);

        if ($retorno) {
            $this->Funcionario = $retorno;

            if ($this->Funcionario->getSenha() == md5($this->senha)) {
                $this->abrirSessao($this->Funcionario->getId());
                $this->motivo = 'LOGOU';
                return true;
            } else {
                $this->motivo = 'SENHA';
                return false;
            }
        } else {
            $this->motivo = 'USUARIO';
            return false;
        }
    }

    private function abrirSessao($id) {
        session_start();
        $_SESSION['id_funcionario'] = $id;
    }

    public function getMotivo() {
        return $this->motivo;
    }

}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$Login = new LoginFuncionario($usuario, $senha);
$Login->login();
echo json_encode(array('login' => $Login->getMotivo()));
