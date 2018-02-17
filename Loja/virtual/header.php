<?php
$VirtualSession = new VirtualSession();

if ($VirtualSession->obterClienteSession()) {

    $ClienteDAO = new ClienteDAO();
    $Cliente = $ClienteDAO->consultar($VirtualSession->obterClienteSession());
    $nome = $Cliente->getNome();
    $logado = 1;
} else {
    $nome = 'Visitante';
    $logado = 0;
}
?>

<div class="TopMenu">
    <div id="Menu">
        <ul>
            <li style="margin-right: 25px">
                <a href="index.php" title="Home"><img src="../img/home.png" width="25px" height="25px" style="margin-top: 5px;"></a>
            </li>
            <li style="display: none">
                <a href="#">Minha Conta</a>
            </li>
            <li>
                <span>Olá <a href="#"><?php echo $nome ?></a>
                    <?php if ($logado == 1) {
                        ?>
                        <span>,<a href="logout.php">Sair</a>    
                        <?php } ?>
                    </span> <span style="margin-left: 250px"><a href="login.php" onclick="">Login</a>
                        <span> / </span><a href="cadastro.php" onclick="">Criar Conta</a></span>
            </li>
            <li>
                <a href="#">
                    <span style="margin-left: 50px"><a href="sacola.php" title="Ver Carrinho"><img src="../img/cesta.png" width="25px" height="25px"></a></span>
                </a>
            </li>
            <li style="margin-right: 25px">
                <a href="contato.php" title="Enviar email contato"><img src="../img/mail.png" width="25px" height="25px" style="margin-top: 5px;"></a>
            </li>
            <li style="margin-right: 25px">
                <a href="../adm/index.php" title="Administração"><img src="../img/adm.png" width="25px" height="25px" style="margin-top: 5px;"></a>
            </li>
        </ul>
    </div>
</div>
