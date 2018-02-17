<?php

class BancoSession {

    public function obterFuncionarioSession() {
        session_start();
        if (isset($_SESSION['id_funcionario'])) {
            $id = $_SESSION['id_funcionario'];
            $FuncionarioDAO = new FuncionarioDAO();
            return $FuncionarioDAO->consultar($id);
        } else {
            return false;
        }
    }

    public function obterClienteSession() {
        session_start();
        if (isset($_SESSION['id_cliente'])) {
            $id = $_SESSION['id_cliente'];
            $ClienteDAO = new ClienteDAO();
            return $ClienteDAO->consultar($id);
        } else {
            return false;
        }
    }

    public function obterFiltrosLogsAcessoSession() {
        session_start();
        if (isset($_SESSION['filtro_log_acesso'])) {
            return $_SESSION['filtro_log_acesso'];
        } else {
            return false;
        }
    }

}
