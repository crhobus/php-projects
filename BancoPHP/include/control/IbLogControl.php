<?php

header('Content-type: application/json; charset=UTF-8');

include '../dao/Factory.php';
include '../model/IbLog.php';
include '../dao/IbLogDAO.php';

class IbLogControl {

    private $msg;
    private $IbLogDAO;

    public function __construct() {
        $this->IbLogDAO = new IbLogDAO();
    }

    public function listar($nome, $agencia, $nrConta) {
        $retorno = $this->IbLogDAO->listar($nome, $agencia, $nrConta);
        if ($retorno) {
            $this->msg = 'OK';
            return $retorno;
        } else {
            $this->msg = 'Logs não encontrados no sistema!';
        }
    }

    public function getMsg() {
        return $this->msg;
    }

    public function abrirSessao($nome, $agencia, $nrConta) {
        session_start();
        $_SESSION['filtro_log_acesso'] = array();
        $_SESSION['filtro_log_acesso'][0] = $nome;
        $_SESSION['filtro_log_acesso'][1] = $agencia;
        $_SESSION['filtro_log_acesso'][2] = $nrConta;
    }

}

$Control = new IbLogControl();

$operacao = $_GET['operacao'];
$nome = $_GET['nome'];
$agencia = $_GET['agencia'];
$nrConta = $_GET['nrConta'];

if ($operacao == 'listar') {
    $listaArray = $Control->listar($nome, $agencia, $nrConta);
    echo json_encode(array('msg' => $Control->getMsg(), 'logs' => $listaArray));
} else if ($operacao == 'listar_pdf') {
    $Control->abrirSessao($nome, $agencia, $nrConta);
    echo json_encode(array('msg' => 'OK'));
}

