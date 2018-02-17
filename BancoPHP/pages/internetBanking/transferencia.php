<?php
include '../../include/dao/Factory.php';
include '../../include/model/Cliente.php';
include '../../include/dao/ClienteDAO.php';
include '../../include/control/BancoSession.php';

$BancoSession = new BancoSession();
$Cliente = $BancoSession->obterClienteSession();
$nome = '';
$agencia = '';
$nrConta = '';
if ($Cliente) {
    $nome = $Cliente->getNome();
    $agencia = $Cliente->getAgencia();
    $nrConta = $Cliente->getNrConta();
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
        <script src="../../js/utils.js" type="text/javascript"></script>
        <script src="../../js/transferencia.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Internet Banking - Transferências</h2>

            <form id="formTransferencias">

                <input type="hidden" id="agenciaClieLogado" value="<?php echo $agencia; ?>">
                <input type="hidden" id="nrContaClieLogado" value="<?php echo $nrConta; ?>">

                <label for="agencia">Agência:</label><br/>
                <input type="text" id="agencia" name="agencia" class="field">
                <span id="agenciaObrig" class="obrigatorio"></span>

                <br/>

                <label for="nrConta">Conta:</label><br/>
                <input type="text" id="nrConta" name="nrConta" class="field">
                <span id="nrContaObrig" class="obrigatorio"></span>

                <br/>

                <label for="valor">Valor:</label><br/>
                <input type="text" id="valor" name="valor" class="field">
                <span id="valorObrig" class="obrigatorio"></span>

                <br/>
                <br/>

                <input type="button" id="efetuarTransferencia" value="Efetuar Transferência" class="button">
                <input type="button" id="limpar" value="Limpar" class="button">

                <br/>
                <br/>

            </form>

            <span id="msg" class="msg"></span>

            <div id="espacamento"></div>

            <br/>

            <a href="internetBanking.php">Voltar</a>

        </div>
    </body>
</html>
