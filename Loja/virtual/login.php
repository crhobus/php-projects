<?php
include "../include/global.php";

$VirtualSession = new VirtualSession();

if ($VirtualSession->obterClienteSession()) {
    header("Location: index.php");
}

$msg = null;

if (isset($_POST["acao"])) {

    if ($_POST['acao'] == "enviar") {

        $LoginCliente = new LoginCliente($_POST['email'], $_POST['senha']);

        if ($LoginCliente->login()) {
            header("Location: index.php");
        } else {
            $motivo = $LoginCliente->getMotivo();

            if ($motivo == "DADOS_INCORRETOS") {
                $msg = "Email inválido";
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
        <link href="../css/virtual.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php include 'header.php'; ?>

        <?php $titulo = "Jóias D'Vite"; ?>
        <?php include "../cabecalho.php"; ?>

        <form action="login.php" method="POST" style="width: 100%; text-align:center">

            <input type="hidden" id="acao" name="acao" value="enviar">

            <input type="text" id="email" name="email" placeholder="E-Mail" style="text-align: center"/>

            <br/>

            <input type="password" id="senha" name="senha" placeholder="Senha" style="text-align: center"/>

            <br/>

            <button type="submit">Entrar</button>
        </form>

        <?php include 'rodape.php'; ?>

    </body>
</html>
