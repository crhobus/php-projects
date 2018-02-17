<?php

header('Content-type: application/json; charset=UTF-8');

include '../dao/Factory.php';
include '../model/Cliente.php';
include '../model/IbLog.php';
include '../dao/ClienteDAO.php';
include '../dao/IbLogDAO.php';

class LoginCliente {

    private $agencia;
    private $nrConta;
    private $senha;
    private $letrasSeguranca;
    private $motivo;
    private $Cliente;
    private $ClienteDAO;

    public function __construct($agencia, $nrConta, $senha, $letrasSeguranca) {
        $this->agencia = $agencia;
        $this->nrConta = $nrConta;
        $this->senha = $senha;
        $this->letrasSeguranca = $letrasSeguranca;
        $this->ClienteDAO = new ClienteDAO();
    }

    public function login() {
        $retorno = $this->ClienteDAO->consultaLogin($this->agencia, $this->nrConta);

        if ($retorno) {
            $this->Cliente = $retorno;

            if ($this->Cliente->getSenha() == md5($this->senha)) {
                if ($this->Cliente->getLetrasSeguranca() == md5($this->letrasSeguranca)) {
                    $tentativas = $this->Cliente->getNrTentativas();
                    if ($tentativas >= 3) {
                        $this->motivo = 'TENTATIVAS';
                        $this->incremetarTentativas();
                        return false;
                    } else {
                        $this->abrirSessao($this->Cliente->getId());
                        $this->zerarTentativas();
                        $IbLogDAO = new IbLogDAO();
                        $IbLogDAO->inserir(new IbLog(NULL, $this->Cliente->getId(), date("Y-m-d H:i:s")));
                        $this->motivo = 'LOGOU';
                        return true;
                    }
                } else {
                    $this->motivo = 'SENHA_LETRA';
                    $this->incremetarTentativas();
                    return false;
                }
            } else {
                $this->motivo = 'SENHA_NUMERICA';
                $this->incremetarTentativas();
                return false;
            }
        } else {
            $this->motivo = 'DADOS';
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

    private function incremetarTentativas() {
        $tentativas = $this->Cliente->getNrTentativas() + 1;
        $this->Cliente->setNrTentativas($tentativas);
        $this->ClienteDAO->atualizar($this->Cliente);
    }

    private function zerarTentativas() {
        $this->Cliente->setNrTentativas(0);
        $this->ClienteDAO->atualizar($this->Cliente);
    }

}

$agencia = $_POST['agencia'];
$nrConta = $_POST['nrConta'];
$senha = $_POST['senha'];
$letrasSeguranca = $_POST['letrasSeguranca'];

$Login = new LoginCliente($agencia, $nrConta, $senha, $letrasSeguranca);
$Login->login();
echo json_encode(array('login' => $Login->getMotivo()));
