<?php
include "../include/global.php";

$LojaSession = new LojaSession();
$id = $LojaSession->obterAdministradorSession();

if ($id) {
    $CategoriaDAO = new CategoriaDAO();
    $lista = $CategoriaDAO->listar();
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

        <?php $titulo = 'Cadastro de Categorias'; ?>
        <?php include "../cabecalho.php"; ?>

        <br/>

        <div style="text-align: center">
            <table style="width: 400px; margin-right:auto; margin-left:auto;">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                if ($lista) {
                    foreach ($lista as $Categoria) {
                        ?>
                        <tr>
                            <td><?php echo $Categoria->getId(); ?></td>
                            <td style="width: 200px"><?php echo $Categoria->getNome(); ?></td>
                            <td style="width: 40px"><a href="categoria.php?id=<?php echo $Categoria->getId(); ?>&acao=update">
                                    <img border="0" alt="editar" src="../img/edit.png" width="20" height="20"></a></td>
                            <td style="width: 40px"><a href="#" onclick="excluirCategoria(<?php echo $Categoria->getId(); ?>)">
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

        <button type="button" onclick="location.href = 'index.php'" style="width: 180px">Voltar</button>
        <button type="button" onclick="location.href = 'categoria.php?acao=insert'" style="width: 180px">Nova Categoria</button>

    </body>
</html>

