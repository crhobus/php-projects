<?php
include "../include/global.php";

$LojaSession = new LojaSession();
$id = $LojaSession->obterAdministradorSession();

$nome = '';
if ($id) {
    $AdministradorDAO = new AdministradorDAO();
    $Administrador = $AdministradorDAO->consultar($id);
    if ($Administrador) {
        $nome = $Administrador->getNome();
    }
} else {
    header("Location: index.php");
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

        <font style="font-size: 22px">Seja Bem Vindo, <?php echo $nome; ?></font>

        <br/>
        <br/>

        <button onclick="location.href = 'listaClientes.php'">Clientes</button>

        <br/>

        <button onclick="location.href = 'listaCategorias.php'">Categorias</button>

        <br/>

        <button onclick="location.href = 'listaProdutos.php'">Produtos</button>

        <br/>

        <button onclick="location.href = 'logout.php'">Sair</button>

    </body>
</html>
