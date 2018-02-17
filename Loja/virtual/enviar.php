<?php

$nome = '';
$email = '';
$assunto_user = '';
$mensagem = '';

if (isset($_POST['enviar']))/* Se o botão enviar for pressionado, faça... */ {

    /* Variaveis do Formulario */
    $nome = $_POST['nome']; /* recebe os dados digitados no campo "nome" */
    $email = $_POST['email']; /* recebe os dados digitados no campo "email" */
    $assunto_user = $_POST['assunto']; /* recebe os dados digitados no campo "assunto" */
    $mensagem = $_POST['mensagem']; /* recebe os dados digitados no campo "mensagem" */

    /* variavel que contará os erros */
    $erros = 0;

    /* Verifica campo "nome" vazio */
    if ($nome == "") {
        $erros++;
        echo "<small class=\"erro\">O Campo nome esta vazio</small><br/>";
    }
    /* Verifica campo "email" vazio */
    if ($email == "") {
        $erros++;
        echo "<small class=\"erro\">O Campo email est&aacute; vazio</small><br/>";
    }
    /* Verifica campo "assunto" vazio */
    if ($assunto_user == "") {
        $erros++;
        echo "<small class=\"erro\">O Campo assunto est&eacute; vazio</small><br/>";
    }
    /* Verifica campo mensagem vazio */
    if ($mensagem == "") {
        $erros++;
        echo "<small class=\"erro\">O Campo mensagem est&eacute; vazio</small><br/>";
    }

    /* Verifica se é um email válido */
    if (strlen($email) < 8 || substr_count($email, "@") != 1) {
        $erros++;
        echo "<small class=\"erro\">Por favor, digite seu <b>e-mail</b> corretamente." . $email . "</small><br/>";
    }
    if ($erros == 0)/* se não tiver algum erro continuara abaixo, se tiver é exibido as messagens configuradas acima */ {

        /* Configuramos o e-mail para o qual serão enviadas as informações */

        $seuemail = "loja.virtual@trabalhophp.com"; /* email de destino */

        $assunto = "contato do site"; /* assunto padrão do email(não o digitado pelo usuario) */

        /* Configuramos os cabeçalhos do e-mail */
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; /* para o envio com formatação HTML. Charset po ser iso-8859-1 também */
        $headers .= "From: $seuemail \r\n"; /* Para "seu email" */

        /* Configuramos o conteúdo do e-mail */
        $conteudo = "<strong>Nome:</strong> $nome<br/>"; /* vai para o seu email o que foi digitado no campo "nome" */
        $conteudo .= "<strong>Email:</strong> $email<br/>"; /* vai para o seu email o que foi digitado no campo "email" */
        $conteudo .= "<strong>Assunto:</strong> $assunto_user<br/>"; /* vai para o seu email o que foi digitado no campo "assunto" */
        $conteudo .= "<strong>Mensagem:</strong> $mensagem<br/>"; /* vai para o seu email o que foi digitado no campo "mensagem" */

        /* Enviando o e-mail... */
        $enviando = mail($seuemail, $assunto, $conteudo, $headers);

        /* verifica se o e-mail foi enviado com sucesso */
        if ($enviando) {
            echo "Mensagem enviada com sucesso!";
            echo "<script>alert(\"Mensagem enviada com sucesso!\")</script>";
            echo "<script>window.location = \"index.php\"</script>";
        } else {/* seu ouve algum erro... */
            echo "<p><b>$nome</b><br />Ouve um erro no envio, desculpe-nos pelo transtorno!!!</p>";
        }
    }
}
