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
        <script src="../../js/utils.js" type="text/javascript"></script>
        <script src="../../js/pagamentoBoletoBancario.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Internet Banking - Pagamentos Boleto Bancário</h2>

            <form id="formPagBoletoBancario">

                <label for="linhaDigitavel">Linha digitável:</label><br/>
                <input type="text" id="linhaDigitavel" name="linhaDigitavel" class="field">
                <span id="linhaDigitavelObrig" class="obrigatorio"></span>

                <br/>

                <label for="valor">Valor:</label><br/>
                <input type="text" id="valor" name="valor" class="field">
                <span id="valorObrig" class="obrigatorio"></span>

                <br/>
                <br/>

                <input type="button" id="efetuarPagamento" value="Efetuar Pagamento" class="button">
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
