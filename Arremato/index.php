<?php
include "./include/global.php";

$ProdutoDAO = new ProdutoDAO;
$listaProduto = $ProdutoDAO->listar();
$contador = 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Arremato.com - Leilões</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <script src="js/jquery-latest.min.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.cycle.all.js"></script>
    </head>
    <body>
        <div id="pagina">

            <?php include 'header.php'; ?>

            <div class="clear"></div>

            <div id="mid" class="central">
                <div id="menu" class="arredondado_sombreado"> 

                    <?php include 'menu.php'; ?>

                </div>

                <div id="slider"> 
                    <a href="#"><img src="img/banner_1.jpg" alt="" title=""></a> 
                    <a href="#"><img src="img/banner_2.jpg" alt="" title=""></a> 
                    <a href="#"><img src="img/banner_3.jpg" alt="" title=""></a> 
                </div>
            </div>

            <div class="clear"></div>

            <section id="ofertas" class="central">

                <div id="oferta_esq">

                    <div id="linha_div" class="arredondado_sombreado"></div>

                    <div id="produtos">
                        <?php
                        foreach ($listaProduto as $Produto) {
                            $contador = $contador + 1;
                            if ($contador <= 3) {
                                ?>
                                <div id="produto_<?php echo $contador ?> " class="produto arredondado_sombreado">
                                    <h2 class="titulo_produto"><samp><?php echo $Produto->getNome() ?></samp></h2>
                                    <div class="foto_produto"><a href="produto.php?id=<?php echo $Produto->getId() ?>"><img src="img/produto_<?php echo $Produto->getId() ?>.png" alt="" title=""></a></div>
                                    <div class="descricao_produto"><?php echo $Produto->getDescricao() ?></div>
                                    <div class="mais_detalhes_produto"><a href="produto.php?id=<?php echo $Produto->getId() ?>">Mais Detalhes...</a></div>
                                </div> 
                                <?php
                            }
                        }
                        ?>

                    </div>

                </div>

                <aside id="parceiros">
                    <a href="#"><img src="img/parceiro_2.jpg" alt="" title=""></a> 
                    <a href="#"><img src="img/parceiro_1.png" alt="" title=""></a> 
                </aside>

            </section>

            <div class="clear"></div>

            <?php include 'footer.php'; ?>

        </div>    
    </body>
</html>
