<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 05 — PHP + MariaDB: persistencia de dados via PDO
  Autor      : Leonardo Garbuio
  Data       : 21/03/2026
  Caminho    : /workspaces/2026-DWII/03_pdo/404.php
-->
<?php
$titulo_pagina = "Página não encontrada";
$pagina_atual = "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
</head>
<body>
<main>
    <?php include "../includes/cabecalho.php"; ?>

    <div class="container container-catalogo centraliza">
        <h1 class="titulo-secao">404</h1>
        <p class="confirmacao_texto">Tecnologia não encontrada.</p>
        <a href="index.php" class="btn-voltar">&larr; Voltar ao Catálogo</a>
    </div>

    <?php include "../includes/rodape.php"; ?>
</main>
</body>
</html>