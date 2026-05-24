<?php
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 06 — Autenticação com sessões e controle de acesso
  Autor      : Leonardo Garbuio
  Data       : 25/03/2026
  Caminho    : /workspaces/2026-DWII/04_sessoes/painel.php
*/
  
/*
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/includes/auth.php";
requer_login();

$titulo_pagina = "Painel - Area Restrita";
$caminho_raiz = "./";
$pagina_atual = "painel";
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

<main>
<?php require_once __DIR__ . "/includes/cabecalho.php"; ?>
   <h1 class="titulo-secao">Painel</h1>
   <p class="publico-intro">Ola, <strong><?= htmlspecialchars(usuario_atual()) ?> </strong> Você esta em uma area restrita</p>
   <p class="acoes-rodape">
        <a href="admin.php" class="btn-secundario">Gerenciar Projetos</a>
   </p>
<?php require_once __DIR__ . "/includes/rodape.php"; ?>
</main>
</body>
</html>