<?php

header('Content-type: application/json; charset=UTF-8');

include '../dao/Factory.php';
include '../model/Funcionario.php';
include '../dao/FuncionarioDAO.php';

class FuncionarioControl {

    private $msg;
    private $FuncionarioDAO;

    public function __construct() {
        $this->FuncionarioDAO = new FuncionarioDAO();
    }

    public function inserir(Funcionario $Funcionario) {
        $retorno = $this->FuncionarioDAO->consultaLogin($Funcionario->getUsuario());

        if ($retorno) {
            $this->msg = 'Já possui um funcionário cadastrado no sistema com este usuário!';
            return NULL;
        } else {
            $Funcionario->setSenha(md5($Funcionario->getSenha()));
            $this->FuncionarioDAO->inserir($Funcionario);
            $this->msg = 'Funcionário cadastrado com sucesso!';
            return $this->FuncionarioDAO->getLastID();
        }
    }

    public function atualizar($id, $nome, $usuario, $senha) {
        $Funcionario = $this->FuncionarioDAO->consultar($id);

        if ($Funcionario) {
            $Funcionario->setNome($nome);
            $Funcionario->setUsuario($usuario);
            if (!empty($senha)) {
                $Funcionario->setSenha(md5($senha));
            }

            $this->FuncionarioDAO->atualizar($Funcionario);
            $this->msg = 'Funcionário atualizado com sucesso!';
            return $Funcionario->getId();
        }
    }

    public function listar() {
        $retorno = $this->FuncionarioDAO->listar();
        if ($retorno) {
            foreach ($retorno as $Funcionario) {
                $array[] = Array('id' => $Funcionario->getId(),
                    'nome' => $Funcionario->getNome(),
                    'usuario' => $Funcionario->getUsuario());
            }
            $this->msg = 'OK';
            return $array;
        } else {
            $this->msg = 'Não há funcionários cadastrados!';
        }
    }

    public function excluir($id) {
        $retorno = $this->FuncionarioDAO->excluir($id);
        if ($retorno) {
            $this->msg = 'OK';
        } else {
            $this->msg = 'Não foi possível excluir o funcionário!';
        }
    }

    public function consultar($id) {
        $retorno = $this->FuncionarioDAO->consultar($id);
        if ($retorno) {
            $array = Array('id' => $retorno->getId(),
                'nome' => $retorno->getNome(),
                'usuario' => $retorno->getUsuario());
            $this->msg = 'OK';
            return $array;
        } else {
            $this->msg = 'Funcionário não encontrado!';
        }
    }

    public function consultaLogin($usuario) {
        return $this->FuncionarioDAO->consultaLogin($usuario);
    }

    public function funcionarioPadrao() {
        $retorno = $this->FuncionarioDAO->getQtdFuncionarios();
        if ($retorno['qt_registros'] == 0) {
            $this->inserir(new Funcionario(NULL, 'Administrador', 'admin', '123'));
        }
    }

    public function getMsg() {
        return $this->msg;
    }

}

function getVal($key) {
    if (isset($_POST[$key])) {
        return $_POST[$key];
    } else if (isset($_GET[$key])) {
        return $_GET[$key];
    }
    return null;
}

$operacao = getVal('operacao');

$Control = new FuncionarioControl();
if ($operacao == 'insert' || $operacao == 'update') {
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ($operacao == 'insert') {
        $retorno = $Control->inserir(new Funcionario(NULL, $nome, $usuario, $senha));
        echo json_encode(array('msg' => $Control->getMsg(), 'id' => $retorno));
    } else {//update
        $id = $_POST['id'];
        $retorno = $Control->atualizar($id, $nome, $usuario, $senha);
        echo json_encode(array('msg' => $Control->getMsg(), 'id' => $retorno));
    }
} else if ($operacao == 'list') {
    $listaArray = $Control->listar();
    echo json_encode(array('msg' => $Control->getMsg(), 'funcionarios' => $listaArray));
} else if ($operacao == 'delete') {
    $id = $_GET['id'];
    $Control->excluir($id);
    echo json_encode(array('msg' => $Control->getMsg()));
} else if ($operacao == 'get') {
    $id = $_GET['id'];
    $array = $Control->consultar($id);
    echo json_encode(array('msg' => $Control->getMsg(), 'funcionario' => $array));
}
