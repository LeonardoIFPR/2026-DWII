<?php
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 06 — Autenticação com sessões e controle de acesso
  Autor      : Leonardo Garbuio
  Data       : 25/03/2026
  Caminho    : /workspaces/2026-DWII/04_sessoes/publico.php
*/

session_start();
$logado = isset($_SESSION["usuario"]);

$titulo_pagina ="Pagina Publica";
$caminho_raiz = "../";
$pagina_atual = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <main>
        <?php require_once __DIR__ . "/../includes/cabecalho.php" ?>
        <h1 class="titulo-secao">Pagina Publica</h1>
        <p class="publico-intro">Este conteudo é visivel para qualquer visitante, sem login</p>
        <?php if ($logado): ?>
            <p class="publico-usuario">Ola, <strong><?php echo htmlspecialchars($_SESSION["usuario"]); ?></strong>
        Voce ja esta autenticado</p>
        <a href="painel.php" class="btn-painel">
            Ir ao Painel
        </a>
        <?php else: ?>
            <a href="login.php" class="btn-acesso">
                Acessar Area Restrita
            </a>
            <?php endif; ?>
    </main>

    <?php require_once __DIR__ . "/../includes/rodape.php"; ?>
</body>
</html>