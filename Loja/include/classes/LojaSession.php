<?php

class LojaSession {

    public function obterAdministradorSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['id_administrador'])) {
            return $_SESSION['id_administrador'];
        } else {
            return false;
        }
    }

}
