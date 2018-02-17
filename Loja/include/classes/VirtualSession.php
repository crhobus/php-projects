<?php

class VirtualSession {

    public function obterClienteSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['id_cliente'])) {
            return $_SESSION['id_cliente'];
        } else {
            return false;
        }
    }

}
