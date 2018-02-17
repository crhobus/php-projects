<?php
include "../include/global.php";

$CategoriaDAO = new CategoriaDAO();
$listaCategoria = $CategoriaDAO->listar();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../css/virtual.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../js/controlaOperacao.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php include 'header.php'; ?>
        <?php $titulo = "Jóias D'Vite"; ?>
        <?php include "../cabecalho.php"; ?>

        <div style="width: 400px; margin-right:auto; margin-left:auto;">
            <label class="lb_dir" style="float: none; color: #464545; font-weight:bold; font-size: 18px;">Filtrar:</label>
            <select name="categoria" id="categoria" onchange="carregaProdutos()" style="border: 1px solid #c7c7c7; width: 211px; padding: 3px 2px; resize: none">
                <option value="">Escolha a Categoria</option>
                <?php foreach ($listaCategoria as $Categoria) { ?>
                    <option value="<?php echo $Categoria->getId(); ?>"><?php echo $Categoria->getNome(); ?></option> 
                <?php } ?>
            </select>
        </div>

        <div id="produtos" class="produtos">
        </div>

        <?php include 'rodape.php'; ?>

    </body>
</html>

<script>

    $(document).ready(function () {
        carregaProdutos();
    });

</script>
