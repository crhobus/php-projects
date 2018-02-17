<?php

header('Content-type: application/json; charset=UTF-8');

include '../dao/Factory.php';
include '../model/Extrato.php';
include '../model/Cliente.php';
include '../dao/ExtratoDAO.php';
include '../dao/ClienteDAO.php';
include './BancoSession.php';

class Movimentacao {

    private $msg;
    private $Cliente;
    private $ExtratoDAO;
    private $ClienteDAO;

    public function __construct(Cliente $Cliente) {
        $this->Cliente = $Cliente;
        $this->ExtratoDAO = new ExtratoDAO();
        $this->ClienteDAO = new ClienteDAO();
    }

    public function obterExtrato($dtInicial, $dtFinal) {
        $retorno = $this->ExtratoDAO->listar($this->Cliente->getId(), $dtInicial, $dtFinal);
        if ($retorno) {
            $this->msg = 'OK';
            return $retorno;
        } else {
            $this->msg = 'Extrato não encontrado no sistema referente a este período!';
        }
    }

    private function getSaldoTotal() {
        return $this->Cliente->getSaldo() + $this->Cliente->getSaldoEspecial();
    }

    private function gerarMovimentacao(Cliente $Cliente, $valor, $tipo, $operacao, $descricao) {
        $Extrato = new Extrato(NULL, $Cliente->getId(), date("Y-m-d H:i:s"), $descricao, $valor, $tipo, $operacao);
        $this->alterarSaldo($Cliente, $valor, $operacao);
        return $this->ExtratoDAO->inserir($Extrato);
    }

    private function alterarSaldo(Cliente $Cliente, $valor, $operacao) {
        if ($operacao == "C") {
            $novoValor = $Cliente->getSaldo() + $valor;
        } else if ($operacao == "D") {
            $novoValor = $Cliente->getSaldo() - $valor;
        } else {
            return false;
        }
        $Cliente->setSaldo($novoValor);
        return $this->ClienteDAO->atualizar($Cliente);
    }

    public function pagamento($valor, $descricao) {
        if ($valor <= $this->getSaldoTotal()) {
            $retorno = $this->gerarMovimentacao($this->Cliente, $valor, "pagamento", "D", $descricao);
            if ($retorno) {
                $this->msg = 'Operação realizada com sucesso!';
                return true;
            } else {
                $this->msg = 'Ocorreu algum erro ao registrar a operação!';
                return false;
            }
        } else {
            $this->msg = 'Saldo insuficiente!';
            return false;
        }
    }

    public function transferencia(Cliente $Cliente, $valor) {
        if ($valor <= $this->getSaldoTotal()) {
            $retorno = $this->gerarMovimentacao($this->Cliente, $valor, "transferência", "D", "Transferência para conta " . $Cliente->getNrConta() . " agência" . $Cliente->getAgencia());
            if ($retorno) {
                $retorno = $this->gerarMovimentacao($Cliente, $valor, "transferência", "C", "Transferência da conta " . $this->Cliente->getNrConta() . " agência" . $this->Cliente->getAgencia());
                if ($retorno) {
                    $this->msg = 'Operação realizada com sucesso!';
                    return true;
                } else {
                    $this->msg = 'Ocorreu algum erro ao registrar a operação!';
                    return false;
                }
            } else {
                $this->msg = 'Ocorreu algum erro ao registrar a operação!';
                return false;
            }
        } else {
            $this->msg = 'Saldo insuficiente!';
            return false;
        }
    }

    public function deposito($valor) {
        $retorno = $this->gerarMovimentacao($this->Cliente, $valor, "depósito", "C", 'Valor depositado');
        if ($retorno) {
            $this->msg = 'Operação realizada com sucesso!';
            return true;
        } else {
            $this->msg = 'Ocorreu algum erro ao registrar a operação!';
            return false;
        }
    }

    public function saque($valor) {
        if ($valor <= $this->getSaldoTotal()) {
            $retorno = $this->gerarMovimentacao($this->Cliente, $valor, "saque", "D", 'Valor sacado');
            if ($retorno) {
                $this->msg = 'Operação realizada com sucesso!';
                return true;
            } else {
                $this->msg = 'Ocorreu algum erro ao registrar a operação!';
                return false;
            }
        } else {
            $this->msg = 'Saldo insuficiente!';
            return false;
        }
    }

    public function getClienteDAO() {
        return $this->ClienteDAO;
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

$BancoSession = new BancoSession();
$Cliente = $BancoSession->obterClienteSession();
if ($Cliente) {
    $Control = new Movimentacao($Cliente);
    if ($operacao == 'extrato') {
        $dtInicial = $_GET['dtInicial'];
        $dtFinal = $_GET['dtFinal'];
        $listaArray = $Control->obterExtrato($dtInicial, $dtFinal);
        echo json_encode(array('msg' => $Control->getMsg(), 'extrato' => $listaArray));
    } else if ($operacao == 'pag_recarga_cel') {
        $valor = $_POST['valor'];
        $Control->pagamento($valor, "Recarga de celular");
        echo json_encode(array('msg' => $Control->getMsg()));
    } else if ($operacao == 'pag_boleto_banc') {
        $valor = $_POST['valor'];
        $Control->pagamento($valor, "Pagamento boleto bancário");
        echo json_encode(array('msg' => $Control->getMsg()));
    } else if ($operacao == 'transferencia') {
        $agencia = $_POST['agencia'];
        $nrConta = $_POST['nrConta'];
        $valor = $_POST['valor'];
        $Cliente = $Control->getClienteDAO()->consultaLogin($agencia, $nrConta);
        if ($Cliente) {
            $Control->transferencia($Cliente, $valor);
            echo json_encode(array('msg' => $Control->getMsg()));
        } else {
            echo json_encode(array('msg' => 'Não existe cliente com a Agência/Conta informada!'));
        }
    } else if ($operacao == 'deposito') {
        $valor = $_POST['valor'];
        $Control->deposito($valor);
        echo json_encode(array('msg' => $Control->getMsg()));
    } else if ($operacao == 'saque') {
        $valor = $_POST['valor'];
        $Control->saque($valor);
        echo json_encode(array('msg' => $Control->getMsg()));
    }
}
