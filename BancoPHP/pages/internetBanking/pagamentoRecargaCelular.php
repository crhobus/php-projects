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
        <script src="../../js/utils.js" type="text/javascript"></script>
        <script src="../../js/pagamentoRecargaCelular.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Internet Banking - Pagamentos Recarga Celular Pré Pago</h2>

            <form id="formPagRecergaCelular">

                <label for="operadora">Operadora:</label><br/>
                <select id="operadora" name="operadora" class="select">
                    <option value="">Selecione</option>
                    <option value="vivo">Vivo</option>
                    <option value="claro">Claro</option>
                    <option value="oi">Oi</option>
                    <option value="tim">Tim</option>
                </select>
                <span id="operadoraObrig" class="obrigatorio"></span>

                <br/>

                <label for="celular">Celular:</label><br/>
                <input type="text" id="celular" name="celular" class="field">
                <span id="celularObrig" class="obrigatorio"></span>

                <br/>

                <label for="valor">Valor:</label><br/>
                <input type="text" id="valor" name="valor" class="field">
                <span id="valorObrig" class="obrigatorio"></span>

                <br/>
                <br/>

                <input type="button" id="efetuarRecarga" value="Efetuar Recarga" class="button">
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
