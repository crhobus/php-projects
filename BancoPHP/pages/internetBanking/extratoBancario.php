<?php
include '../../include/dao/Factory.php';
include '../../include/model/Cliente.php';
include '../../include/dao/ClienteDAO.php';
include '../../include/control/BancoSession.php';

$BancoSession = new BancoSession();
$Cliente = $BancoSession->obterClienteSession();
$nome = '';
if ($Cliente) {
    $nome = $Cliente->getNome();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Banco online::Internet Banking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../js/maskedinput/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script src="../../js/extratoBancario.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Internet Banking - Extrato</h2>

            <label for="dtInicial">Data inicial:</label><br/>
            <input type="text" id="dtInicial" name="dtInicial" class="field">

            <br/>

            <label for="dtFinal">Data final:</label><br/>
            <input type="text" id="dtFinal" name="dtFinal" class="field">

            <br/>
            <br/>

            <input type="button" id="obterExtrato" value="Obter Extrato" class="button">

            <br/>
            <br/>

            <span id="msg" class="msg"></span>

            <div id="extrato"></div>

            <br/>

            <a href="internetBanking.php">Voltar</a>

        </div>
    </body>
</html>
