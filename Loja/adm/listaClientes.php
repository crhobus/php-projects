<?php
include "../include/global.php";

$LojaSession = new LojaSession();
$id = $LojaSession->obterAdministradorSession();

if ($id) {
    $ClienteDAO = new ClienteDAO();
    $lista = $ClienteDAO->listar();
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
        <script src="../js/controlaOperacao.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php $titulo = 'Cadastro de Clientes'; ?>
        <?php include "../cabecalho.php"; ?>

        <br/>

        <div style="text-align: center">
            <table style="width: 900px; margin-right:auto; margin-left:auto;">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>E-mail</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                if ($lista) {
                    foreach ($lista as $Cliente) {
                        ?>
                        <tr>
                            <td><?php echo $Cliente->getId(); ?></td>
                            <td style="width: 200px"><?php echo $Cliente->getNome(); ?></td>
                            <td style="width: 200px"><?php echo $Cliente->getSobrenome(); ?></td>
                            <td style="width: 200px"><?php echo $Cliente->getEmail(); ?></td>
                            <td style="width: 150px"><?php echo $Cliente->getCidade(); ?></td>
                            <td style="width: 50px"><?php echo $Cliente->getEstado(); ?></td>
                            <td style="width: 40px"><a href="cliente.php?id=<?php echo $Cliente->getId(); ?>&acao=update">
                                    <img border="0" alt="editar" src="../img/edit.png" width="20" height="20"></a></td>
                            <td style="width: 40px"><a href="#" onclick="excluirCliente(<?php echo $Cliente->getId(); ?>)">
                                    <img border="0" src="../img/delete.png" width="20" height="20"></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

        <br/>
        <br/>

        <button type="button" onclick="location.href = 'index.php'" style="width: 170px">Voltar</button>
        <button type="button" onclick="window.open('clientesPDF.php')" style="width: 170px" value="blank">PDF Cliente</button>
        <button type="button" onclick="location.href = 'cliente.php?acao=insert'" style="width: 170px">Novo Cliente</button>

    </body>
</html>

