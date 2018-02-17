<?php

session_start();
unset($_SESSION['id_cliente']);
session_destroy();
header("Location: index.php");
