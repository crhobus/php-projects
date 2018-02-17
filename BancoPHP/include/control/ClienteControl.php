<?php

header('Content-type: application/json; charset=UTF-8');

include '../dao/Factory.php';
include '../model/Cliente.php';
include '../dao/ClienteDAO.php';

class ClienteControl {

    private $msg;
    private $ClienteDAO;

    public function __construct() {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function inserir(Cliente $Cliente) {
        $retorno = $this->ClienteDAO->consultaLogin($Cliente->getAgencia(), $Cliente->getNrConta());

        if ($retorno) {
            $this->msg = 'Já possui um cliente cadastrado no sistema com esta agência e conta!';
            return NULL;
        } else {
            $Cliente->setSenha(md5($Cliente->getSenha()));
            $Cliente->setLetrasSeguranca(md5($Cliente->getLetrasSeguranca()));
            $this->ClienteDAO->inserir($Cliente);
            $this->msg = 'Cliente cadastrado com sucesso!';
            return $this->ClienteDAO->getLastID();
        }
    }

    public function atualizar($id, $nome, $agencia, $nrConta, $senha, $letrasSeguranca, $saldoEspecial, $nrTentativas) {
        $Cliente = $this->ClienteDAO->consultar($id);

        if ($Cliente) {
            $Cliente->setNome($nome);
            $Cliente->setAgencia($agencia);
            $Cliente->setNrConta($nrConta);
            $Cliente->setSaldoEspecial($saldoEspecial);
            $Cliente->setNrTentativas($nrTentativas);
            if (!empty($senha)) {
                $Cliente->setSenha(md5($senha));
            }
            if (!empty($letrasSeguranca)) {
                $Cliente->setLetrasSeguranca(md5($letrasSeguranca));
            }

            $retorno = $this->ClienteDAO->consultaLogin($Cliente->getAgencia(), $Cliente->getNrConta());
            if ($retorno && $retorno->getId() != $Cliente->getId()) {
                $this->msg = 'Já possui um cliente cadastrado no sistema com esta agência e conta!';
                return $Cliente->getId();
            } else {
                $this->ClienteDAO->atualizar($Cliente);
                $this->msg = 'Cliente atualizado com sucesso!';
                return $Cliente->getId();
            }
        }
    }

    public function listar() {
        $retorno = $this->ClienteDAO->listar();
        if ($retorno) {
            foreach ($retorno as $Cliente) {
                $array[] = Array('id' => $Cliente->getId(),
                    'nome' => $Cliente->getNome(),
                    'agencia' => $Cliente->getAgencia(),
                    'conta' => $Cliente->getNrConta(),
                    'saldoEspecial' => $Cliente->getSaldoEspecial(),
                    'nrTentativas' => $Cliente->getNrTentativas());
            }
            $this->msg = 'OK';
            return $array;
        } else {
            $this->msg = 'Não há clientes cadastrados!';
        }
    }

    public function excluir($id) {
        $retorno = $this->ClienteDAO->excluir($id);
        if ($retorno) {
            if (file_exists("../../img/fotos/tb_" . $id . ".jpg")) {
                unlink("../../img/fotos/tb_" . $id . ".jpg");
            }
            $this->msg = 'OK';
        } else {
            $this->msg = 'Não foi possível excluir o cliente!';
        }
    }

    public function consultar($id) {
        $retorno = $this->ClienteDAO->consultar($id);
        if ($retorno) {
            $array = Array('id' => $retorno->getId(),
                'nome' => $retorno->getNome(),
                'agencia' => $retorno->getAgencia(),
                'nrConta' => $retorno->getNrConta(),
                'saldoEspecial' => $retorno->getSaldoEspecial(),
                'nrTentativas' => $retorno->getNrTentativas(),
                'foto' => $retorno->getFoto());
            $this->msg = 'OK';
            return $array;
        } else {
            $this->msg = 'Cliente não encontrado!';
        }
    }

    public function upload($id, $foto) {
        $Cliente = $this->ClienteDAO->consultar($id);
        $upload = move_uploaded_file($foto, '../../img/fotos/' . $Cliente->getId() . '.jpg');
        if ($upload) {
            $imagemOriginal = ImageCreateFromJPEG('../../img/fotos/' . $Cliente->getId() . '.jpg');
            $imagemReduzida = ImageCreateTrueColor(120, 120);
            ImageCopyResampled($imagemReduzida, $imagemOriginal, 0, 0, 0, 0, 120, 120, ImagesX($imagemOriginal), ImagesY($imagemOriginal));
            imagejpeg($imagemReduzida, '../../img/fotos/tb_' . $Cliente->getId() . '.jpg');
            imagedestroy($imagemReduzida);
            imagedestroy($imagemOriginal);
            unlink("../../img/fotos/" . $Cliente->getId() . ".jpg");
            $Cliente->setFoto(1);
            $this->ClienteDAO->atualizar($Cliente);
            $this->msg = 'OK';
        } else {
            $this->msg = 'Ocorreu um erro ao inserir/atualizar a foto do cliente!';
            return false;
        }
    }

    public function obterIdCliente($agencia, $nrConta) {
        $Cliente = $this->ClienteDAO->consultaLogin($agencia, $nrConta);
        if ($Cliente) {
            $this->armazenaIdClienteSession($Cliente->getId());
            $this->msg = 'OK';
            return Array('id' => $Cliente->getId(),
                'foto' => $Cliente->getFoto());
        } else {
            $this->msg = 'Cliente não encontrado!';
            return false;
        }
    }

    private function armazenaIdClienteSession($id) {
        session_start();
        $_SESSION['id_cliente'] = $id;
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

$Control = new ClienteControl();
if ($operacao == 'insert' || $operacao == 'update') {
    $nome = $_POST['nome'];
    $agencia = $_POST['agencia'];
    $nrConta = $_POST['nrConta'];
    $senha = $_POST['senha'];
    $letrasSeguranca = $_POST['letrasSeguranca'];
    $saldoEspecial = $_POST['saldoEspecial'];
    $nrTentativas = $_POST['nrTentativas'];

    if ($operacao == 'insert') {
        $retorno = $Control->inserir(new Cliente(NULL, $nome, $nrConta, $agencia, $senha, $letrasSeguranca, 0, $nrTentativas, $saldoEspecial, 0));
        echo json_encode(array('msg' => $Control->getMsg(), 'id' => $retorno));
    } else {//update
        $id = $_POST['id'];
        $retorno = $Control->atualizar($id, $nome, $agencia, $nrConta, $senha, $letrasSeguranca, $saldoEspecial, $nrTentativas);
        echo json_encode(array('msg' => $Control->getMsg(), 'id' => $retorno));
    }
} else if ($operacao == 'list') {
    $listaArray = $Control->listar();
    echo json_encode(array('msg' => $Control->getMsg(), 'clientes' => $listaArray));
} else if ($operacao == 'delete') {
    $id = $_GET['id'];
    $Control->excluir($id);
    echo json_encode(array('msg' => $Control->getMsg()));
} else if ($operacao == 'get') {
    $id = $_GET['id'];
    $array = $Control->consultar($id);
    echo json_encode(array('msg' => $Control->getMsg(), 'cliente' => $array));
} else if ($operacao == 'upload') {
    $id = $_POST['id'];
    $foto = $_FILES['foto']['tmp_name'];
    $Control->upload($id, $foto);
    echo json_encode(array('msg' => $Control->getMsg()));
} else if ($operacao == 'obter_id_cliente') {
    $agencia = $_GET['agencia'];
    $nrConta = $_GET['nrConta'];
    $retorno = $Control->obterIdCliente($agencia, $nrConta);
    echo json_encode(array('msg' => $Control->getMsg(), 'cliente' => $retorno));
}
