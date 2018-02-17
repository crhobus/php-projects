<?php
include '../../include/dao/Factory.php';
include '../../include/model/Cliente.php';
include '../../include/dao/ClienteDAO.php';
include '../../include/control/BancoSession.php';

$BancoSession = new BancoSession();
$Cliente = $BancoSession->obterClienteSession();
$nome = '';
$saldo = 0;
$saldoEspecial = 0;
if ($Cliente) {
    $nome = $Cliente->getNome();
    $saldo = $Cliente->getSaldo();
    $saldoEspecial = $Cliente->getSaldoEspecial();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Banco online::Internet Banking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Internet Banking - Saldo</h2>

            <h4 id="saldo">Saldo Atual R$ <?php echo number_format($saldo, 2, ',', '.'); ?></h4>
            <h4 id="saldo">Saldo Especial R$ <?php echo number_format($saldoEspecial, 2, ',', '.'); ?></h4>

            <br/>

            <a href="internetBanking.php">Voltar</a>

        </div>
    </body>
</html>
