<?php 
$nome = "Leonardo";
$pagina_atual = "contatos";
$caminho_raiz = "../";
$titulo_pagina = "Obrigado";

$nome_visitante = htmlspecialchars($_GET["nome"] ?? "visitante");
$assunto = htmlspecialchars($_GET["assunto"] ?? "deixou o padrão (Duvida)");
?>

<?php include "../includes/cabecalho.php" ?>

<div class="container_confirmacao">
    <p class="confirmacao_icone">✅</p>
    <h1 class="confirmacao_titulo">
        Obrigado <?Php echo $nome_visitante; ?>!
    </h1>
    <p class="confirmacao_texto">
        Sua mensagem sobre <?php echo $assunto; ?> foi recebida.
    </p>
    <p class="caracteres">
        Você usou <?php echo $contagem_caracteres; ?> caracteres de um limite de 500
    </p>

    <a href="contato.php" class="btn">&larr; Enviar outra mensagem</a>
</div>

<?php include "../includes/rodape.php" ?>