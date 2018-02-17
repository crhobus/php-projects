<?php
include "../include/global.php";

$LojaSession = new LojaSession();

if ($LojaSession->obterAdministradorSession()) {
    header("Location: principal.php");
}

$msg = null;

if (isset($_POST["acao"])) {

    if ($_POST['acao'] == "enviar") {
        $LoginAdministrador = new LoginAdministrador($_POST['usuario'], $_POST['senha']);

        if ($LoginAdministrador->login()) {
            header("Location: principal.php");
        } else {
            $motivo = $LoginAdministrador->getMotivo();

            if ($motivo == "DADOS_INCORRETOS") {
                $msg = "Usuário inválido";
            } else {
                $msg = "Senha inválida";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php $titulo = 'Módulo Administrator'; ?>
        <?php include "../cabecalho.php"; ?>

        <form action="index.php" method="POST" style="width: 100%; text-align:center">

            <input type="hidden" id="acao" name="acao" value="enviar">

            <input type="text" id="usuario" name="usuario" placeholder="Usuário" style="text-align: center"/>

            <br/>

            <input type="password" id="senha" name="senha" placeholder="Senha" style="text-align: center"/>

            <br/>

            <button type="submit">Entrar</button>
            <br/>
            <button type="button" onclick="location.href = '../index.php'">Sair</button>
        </form>

    </body>
</html>
