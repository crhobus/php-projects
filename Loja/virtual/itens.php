<?php
include "../include/global.php";

$id_categoria = $_GET['id_categoria'];

$ProdutoDAO = new ProdutoDAO;
$lista = $ProdutoDAO->listar($id_categoria);
$CategoriaDAO = new CategoriaDAO();
$listaCategoria = $CategoriaDAO->listar();
$contador = 0;

if ($lista) {
    foreach ($lista as $Produto) {
        $contador = $contador + 1;
        $Categoria = $CategoriaDAO->consultar($Produto->getIdCategoria());
        ?>
        <div class="item" style="width: 235px;">

            <div class="imagemProduto">
                <a href="detalhe.php?id=<?php echo $Produto->getId(); ?>" style="height: 250px;">
                    <img src="../img/fotos/tb_<?php echo $Produto->getFoto(); ?>.jpg" alt="Foto do Produto" width="150" height="150">
                </a>

                <div class="detalheProduto">
                    <a href="#" class="pname" style="word-wrap: break-word;"><?php echo $Produto->getNome(); ?></a>
                </div>
                <em class="preco"><span class="currency">R$ </span><?php echo $Produto->getPreco(); ?></em>

                <div class="ProductActionAdd">
                    <?php if ($Produto->getQtEstoque() <= 0) {
                        ?>
                        <a href="#" class="btn" title="Sem Estoque">Indisponível</a>
                    <?php } else {
                        ?>
                        <a href="carrinho.php?action=add&id=<?php echo $Produto->getId(); ?>" class="btn" title="Comprar">Comprar</a>
                    <?php } ?>
                </div>


            </div>


        </div>

        <?php
    }

    if ($contador == 3) {
        $contador = 0;
        ?> <div class="clear"></div> <?php
    }
}
