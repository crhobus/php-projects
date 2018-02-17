<?php
include "../include/global.php";

$id = $_GET['id'];

$ProdutoDAO = new ProdutoDAO;
$Produto = $ProdutoDAO->consultar($id);
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
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php include 'header.php'; ?>
        <?php $titulo = "Jóias D'Vite"; ?>
        <?php include "../cabecalho.php"; ?>


        <div id="produtos" style="margin: 0 auto; width: 30%;">


            <?php
            $Categoria = $CategoriaDAO->consultar($Produto->getIdCategoria());
            ?>
            <div class="itemDetalhe" style="width: 235px;">

                <div class="imagemProduto">
                    <a href="#" style="height: 250px;">
                        <img src="../img/fotos/tb_<?php echo $Produto->getFoto(); ?>.jpg" alt="Foto do Produto" width="250" height="250">
                    </a>
                </div>

            </div>

            <div class="detalhe" style="width: 235px;">

                <div class="imagemProduto">

                    <div>
                        <span class="preco"><?php echo $Produto->getNome(); ?></span>
                    </div>
                    <div class="detalheProduto">
                        <textarea style="height: 150px; width: 300px" readonly="true"><?php echo $Produto->getDescricao(); ?></textarea>
                    </div>
                    <em class="preco"><span class="currency">R$ </span><?php echo $Produto->getPreco(); ?></em>

                    <div class="ProductActionAdd">
                        <?php if ($Produto->getQtEstoque() <= 0) {
                            ?>
                            <a href="#" class="btn" title="Sem Estoque">Indisponível</a>
                        <?php } else {
                            ?>
                            <a href="#/carrinho.php?action=add&id=<?php echo $Produto->getId(); ?>" class="btn" title="Comprar">Comprar</a>
                        <?php } ?>
                    </div>


                </div>

            </div>

        </div>

        <?php include 'rodape.php'; ?>

    </body>
</html>
