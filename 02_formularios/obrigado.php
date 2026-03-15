<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 04 — PHP para Web: Formulários, GET e POST
  Autor      : Leonardo Garbuio
  Data       : 15/03/2026
  Caminho    : /workspaces/2026-DWII/02_formularios/obrigado.php
-->
<?php 
$nome = "Leonardo";
$pagina_atual = "contatos";
$caminho_raiz = "../";
$titulo_pagina = "Obrigado";

$nome_visitante = htmlspecialchars($_GET["nome"] ?? "visitante");
$assunto = htmlspecialchars($_GET["assunto"] ?? "deixou o padrão (Duvida)");
$caracteres_usados = (int)($_GET["caracteres"] ?? 0);
?>

<main>
<?php include "../includes/cabecalho.php" ?>

<div class="centraliza">
    <div class="obrigado-check">
        <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <h1 class="confirmacao_titulo">
        Obrigado <span class="cor_laranja"><?php echo $nome_visitante; ?></span>!
    </h1>
    <div class="obrigado-linha"> </div>
    <p class="confirmacao_texto">
        Sua mensagem sobre o assunto foi recebida com sucesso.
    </p>
    <div class="obrigado-assunto">assunto: <?php echo $assunto; ?></div>
    <p class="obrigado-chars">
        Você usou <strong><?php echo $caracteres_usados; ?></strong> de 500 caracteres
    </p>

    <a href="contato.php" class="btn">&larr; ENVIAR OUTRA MENSAGEM</a>
</div>

<?php include "../includes/rodape.php" ?>
</main>