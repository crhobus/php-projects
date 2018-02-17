<?php

session_start();
unset($_SESSION['id_administrador']);
session_destroy();
header("Location: ../index.php");
