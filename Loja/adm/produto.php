<?php
include "../include/global.php";

$LojaSession = new LojaSession();

if (!$LojaSession->obterAdministradorSession()) {
    header("Location: index.php");
}

$acao = $_GET['acao'];
$id = '';
$idCategoria = '';
$nome = '';
$descricao = '';
$preco = '';
$foto = '';
$qtEstoque = '';

$CategoriaDAO = new CategoriaDAO();
$lista = $CategoriaDAO->listar();


if ($acao == 'update') {
    $id = $_GET['id'];
    $ProdutoDAO = new ProdutoDAO();
    $Produto = $ProdutoDAO->consultar($id);

    $idCategoria = $Produto->getIdCategoria();
    $nome = $Produto->getNome();
    $descricao = $Produto->getDescricao();
    $preco = $Produto->getPreco();
    $foto = $Produto->getFoto();
    $qtEstoque = $Produto->getQtEstoque();
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
    <body class="central">    

        <?php $titulo = 'Cadastro de Produtos'; ?>
        <?php include "../cabecalho.php"; ?>

        <form id="frmProduto" name="frmProduto">

            <input type="hidden" id="id" name="id" value="<?php echo $id ?>" >

            <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $idCategoria ?>" >

            <input type="hidden" id="vFoto" name="vFoto" value="<?php echo $foto ?>" >

            <label class="lb_dir">Nome</label>   
            <input type="text" name="nome" id="nome" maxlength="50" value="<?php echo $nome ?>">
            <span id="nomeObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Categoria</label>
            <select name="categoria" id="categoria" style="border: 1px solid #c7c7c7; width: 211px; padding: 3px 2px; resize: none">
                <option value="">Escolha a Categoria</option>
                <?php foreach ($lista as $Categoria) { ?>
                    <option value="<?php echo $Categoria->getId(); ?>"><?php echo $Categoria->getNome(); ?></option> 
                <?php } ?>
            </select>
            <span id="categoriaObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Descrição</label>
            <textarea name="descricao" id="descricao" style="width: 200px"><?php echo $descricao ?></textarea>
            <span id="descricaoObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Preço</label>   
            <input type="text" name="preco" id="preco" value="<?php echo $preco ?>">
            <span id="precoObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Estoque</label>   
            <input type="text" name="qtEstoque" id="qtEstoque" maxlength="10" value="<?php echo $qtEstoque ?>">
            <span id="qtEstoqueObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir" for="foto">Foto</label>
            <input type="file" name="foto" id="foto" onchange="onChangeFoto()" style="width: 340px" title="Imagem produto">
            <span id="fotoObrig" class="obrigatorio"></span>

            <div id="imagem"></div>

            <div id="divBotoes" style="text-align: center">
                <button type="button" onclick="location.href = 'listaProdutos.php'" style="width: 100px">Voltar</button>
                <button type="button" onclick="cadastrarProduto()" style="width: 100px">Salvar</button>
            </div>

        </form>

    </body>
</html>
<?php if ($acao == 'update') { ?>
    <script>
        $("#categoria").val($("#idCategoria").val());
        if ($("#vFoto").val() == $("#id").val()) {
            mostrarFoto($("#id").val());
        }
    </script>
    <?php
}
