<?php
$DepartamentoDAO = new DepartamentoDAO();
$listaDepartamento = $DepartamentoDAO->listar();
?>

<header class="central">

    <a href='index.php' >
        <div id="logo"></div>
    </a>

    <div id="cabecalho">
        <div id="menu_horizontal">
            <nav>
                <ul class="menu_horizontal">
                    <li><a href='#' >Próximos Leilões</a></li>
                    <li><a href='#' >Quem Somos</a></li>
                    <li><a href='#' >Quero Vender</a></li>
                    <li><a href='#' >Contato</a></li>
                    <li><a href='#' >Ajuda</a></li>
                    <li><a href='#' class="login"><span>Login</span></a></li>
                </ul>
            </nav>
        </div>

        <div id="cadastro_usuario">
            <span class="novo_cadastrado">Não é Cadastrado?</span><br/>
            <a href="cadastro_usuario.php" class="link_cadastre_se">Cadastre-se</a>
        </div>

        <div class="clear"></div>

        <div id="localizar">
            <form action="#" method="post" id="form_busca_no_site" >
                <fieldset>

                    <input type="text" name="busca" id="busca" class="busca campo campo_pos arredondado_sombreado" placeholder="O que você procura?">

                    <label>em</label>

                    <select name="departamento" id="departamento" class="departamento campo campo_pos arredondado_sombreado">
                        <option value="">Departamento</option>
                        <?php foreach ($listaDepartamento as $Departamento) { ?>
                            <option value="<?php echo $Departamento->getId(); ?>"><?php echo $Departamento->getNome(); ?></option> 
                        <?php } ?>
                    </select>

                    <input type="submit" id="botao_buscar" class="botao botao_buscar arredondado_sombreado" value="Buscar"><br/>

                </fieldset>
            </form>
        </div>
    </div>

</header>
