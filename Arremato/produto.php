<?php
include "./include/global.php";

$id = $_GET['id'];

$ProdutoDAO = new ProdutoDAO;
$Produto = $ProdutoDAO->consultar($id);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Arremato.com - Leilões</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/jquery.countdown.css"> 
        <script src="js/jquery-latest.min.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="js/jquery.plugin.js"></script> 
        <script type="text/javascript" src="js/jquery.countdown.js"></script>
    </head>
    <body>
        <div id="pagina">
            <?php include 'header.php'; ?>

            <div class="clear"></div>

            <div id="mid" class="central">
                <div id="menu" class="arredondado_sombreado"> 

                    <?php include 'menu.php'; ?>

                    <div class="clear"></div>

                    <section id="detalhe" class="central">
                        <aside id="parceiros">
                            <a href="#"><img src="img/parceiro_2.jpg" alt="" title=""></a> 
                            <a href="#"><img src="img/parceiro_1.png" alt="" title=""></a> 
                        </aside>
                    </section>
                </div>

                <div id="borda_central" class="arredondado_sombreado central">
                    <input type="hidden" id="dia" nome="dia" value="<?php echo date('d', strtotime($Produto->getData_encerramento())); ?>">
                    <input type="hidden" id="mes" nome="mes" value="<?php echo date('m', strtotime($Produto->getData_encerramento())); ?>">
                    <input type="hidden" id="ano" nome="ano" value="<?php echo date('Y', strtotime($Produto->getData_encerramento())); ?>">

                    <h2 class="titulo_sub_pagina left"><samp> <?php echo $Produto->getNome() ?> </samp></h2>
                    <span class="produto_encerra right">Encerra: <?php echo date('d/m/Y H:i:s', strtotime($Produto->getData_encerramento())); ?></span><br>

                    <div class="clear"></div>

                    <div class="produto_imagem foto_produto">
                        <a href="produto.php"><img src="img/produto_<?php echo $Produto->getId() ?>.png" alt="" title="" width="280px" height="280px"></a>
                    </div>

                    <div class="produto_detalhe descricao_produto"><?php echo $Produto->getDescricao() ?></div>

                    <form action="#" method="post" id="form_lance" >
                        <fieldset>
                            <div class="produto_lance descricao_produto">

                                <span class="produto_encerra right">Lance Inicial: R$ <?php echo number_format($Produto->getLance_inicial(), 2, ',', '.') ?></span><br/>
                                <span class="produto_encerra right">Lance Atual R$  <?php echo number_format($Produto->getLance_atual(), 2, ',', '.') ?></span><br/>

                                <input type="submit" id="botao_lance" class="arredondado_sombreado" value="DÊ SEU LANCE"><br/>

                                <div class="contador right">
                                    <div>
                                        <a href="#" class="left" id="relogio"  ><img src="img/time.png" alt="Termino" title=""></a> 
                                    </div>
                                    <div>
                                        <span class="encerra_em">Encerra em:</span><br/>
                                        <div id="relogio_contador" class="right" > </div>
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                    </form>

                    <div class="clear"></div>

                    <span class="obs_lance">Observações</span><br>
                    <textarea id="obeservacoes" class="area_texto arredondado_sombreado" readonly></textarea><br>

                    <span class="obs_lance">Últimos Lances</span><br>
                    <textarea id="ultimos_lances" class="area_texto arredondado_sombreado" readonly></textarea>

                </div>

            </div>

            <div class="clear"></div>

            <?php include 'footer.php'; ?>

        </div>    
    </body>
</html>
