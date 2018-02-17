<?php
include "./include/global.php";
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
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/jquery.mask.min.js"></script>
        <script src="js/cadasUsuario.js"></script>
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

                    <h2 class="titulo_sub_pagina"><samp>Cadastro de Usuário</samp></h2>

                    <form action="#" method="post" id="form_cadastro_usuario">
                        <fieldset class="cadas_usuario_dados">

                            <label>Tipo de Cadastro</label><br/>

                            <input type="radio" name="tipo_cadastro_usuario" id="tipo_cadastro_usuario" value="F" checked class="espacamento_entre_campos"><label for="tipo_f_cadastro_usuario" class="campo_negrito">Pessoa física</label><br/>
                            <input type="radio" name="tipo_cadastro_usuario" id="tipo_cadastro_usuario" value="J" class="tipo_pj_usuario"><label for="tipo_j_cadastro_usuario" class="campo_negrito">Pessoa jurídica</label><br/>

                            <label>Dados Pessoais</label><br/><br>

                            <label for="login_usuario" class="campo_negrito">Login do usuário</label><br/>
                            <input type="text" name="login_usuario" id="login_usuario" class="campo_usuario espacamento_entre_campos campo arredondado_sombreado"><br/>

                            <label for="senha_usuario" class="campo_negrito">Senha</label>
                            <label for="confirmacao_senha_usuario" class="campo_negrito label_espacamento_conf_senha">Confirme sua senha</label><br/>

                            <input type="password" name="senha_usuario" id="senha_usuario" class="campo_usuario espacamento_entre_campos campo arredondado_sombreado">
                            <input type="password" name="confirmacao_senha_usuario" id="confirmacao_senha_usuario" class="campo_usuario campo_espacamento espacamento_entre_campos campo arredondado_sombreado"><br/>

                            <label for="nome_usuario" class="campo_negrito">Nome completo</label><br/>
                            <input type="text" name="nome_usuario" id="nome_usuario" class="campo_usuario_maior espacamento_entre_campos campo arredondado_sombreado"><br/>

                            <label for="cpf_usuario" class="campo_negrito">CPF</label>
                            <label for="rg_usuario" class="campo_negrito label_espacamento_rg">RG</label><br/>

                            <input type="text" name="cpf_usuario" id="cpf_usuario" class="campo_usuario espacamento_entre_campos campo arredondado_sombreado">
                            <input type="text" name="rg_usuario" id="rg_usuario" class="campo_usuario campo_espacamento espacamento_entre_campos campo arredondado_sombreado"><br/>

                            <label for="sexo_usuario" class="campo_negrito">Sexo</label>
                            <label for="estado_civil_usuario" class="campo_negrito label_espacamento_est_civil">Estado civil</label><br/>

                            <select name="sexo_usuario" id="sexo_usuario" class="campo_usuario espacamento_entre_campos campo arredondado_sombreado">
                                <option value="" selected="selected">Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                            <select name="estado_civil_usuario" id="estado_civil_usuario" class="campo_usuario campo_espacamento espacamento_entre_campos campo arredondado_sombreado">
                                <option value="" selected="selected">Selecione</option>
                                <option value="1">Solteiro</option>
                                <option value="2">Casado</option>
                                <option value="3">Divorciado</option>
                                <option value="4">Viúvo</option>
                            </select><br/>

                            <label for="data_nasc_usuario" class="campo_negrito">Data de nascimento</label>
                            <label for="celular_usuario" class="campo_negrito label_espacamento_celular">Celular</label><br/>

                            <input type="text" name="data_nasc_usuario" id="data_nasc_usuario" class="campo_usuario espacamento_entre_campos campo arredondado_sombreado">
                            <input type="text" name="celular_usuario" id="celular_usuario" class="campo_usuario campo_espacamento espacamento_entre_campos campo arredondado_sombreado"><br/>

                            <label for="email_usuario" class="campo_negrito">E-mail</label><br/>
                            <input type="text" name="email_usuario" id="email_usuario" class="campo_usuario_maior espacamento_entre_campos campo arredondado_sombreado"><br/>

                            <input type="checkbox" name="envio_ofertas_usuario" id="envio_ofertas_usuario" value="S" checked/>Autorizo recebimento de ofertas do Arremato.com e seus parceiros<br/>

                            <input type="submit" id="botao_avancar" class="botao botao_avancar arredondado_sombreado" value="Avançar">

                            <div class="msg_erro_cadastro"></div>

                        </fieldset>
                    </form>

                </div>

            </div>

            <div class="clear"></div>

            <?php include 'footer.php'; ?>

        </div>    
    </body>
</html>
