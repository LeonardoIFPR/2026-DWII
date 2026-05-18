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
   <h1>Painel</h1>
   <p>Ola, <strong><?= htmlspecialchars(usuario_atual()) ?> </strong> Você esta em uma area restrita</p>
   <p>Em breve,esta pagina listara seus projetos para edição (a ser implementado na <strong>Aula 13 - refatoração V</strong>).</p>

   <p>
        <a href="logout.php">Sair</a>
   </p>
<?php require_once __DIR__ . "/../includes/rodape.php"; ?>
</main>
</body>
</html>