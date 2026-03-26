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

if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;

}
$_SESSION['visitas']++;


$titulo_pagina = "Painel - Area Restrita";
$caminho_raiz = "../";
$pagina_atual = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

<main>
    <?php require_once __DIR__ . "/../includes/cabecalho.php"; ?>
    <div class="alerta-sucesso">
        <h3>Voce esta Autenticado</h3>
        <p><strong>Usuario:</strong>
            <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
        </p>
        <p><strong>Login realizado em:</strong>
            <?php echo htmlspecialchars($_SESSION["logado_em"] ?? "-"); ?>
        </p>
        </p>
        <p><strong>Numero de vezes que voce logou:</strong>
            <?php echo htmlspecialchars($_SESSION["visitas"]); ?>
        </p>
    </div>

    <?php if(isset($_SESSION["flash"])): ?>

        <p class="flash-msg"><?php echo $_SESSION['flash']; ?></p>

        <?php unset($_SESSION['flash']);?>  <!--é esse aqui que apaga a msg caso o flash diga que não é a primeira vez que vc entra no painel-->

    <?php endif; ?>

    <div class="card">
        <h3>Painel de controle</h3>
        <p>Este conteudo só é visivel para usuarios autenticados</p>
        <p>Nas proximas aulas este painel tera funcionalidades reais (CRUD)</p>
    </div>

    <p style="margin-top: 24px; text-align: center;">
        <a href="logout.php" style="background-color: #cf1c21; color: white; padding: 10px 24px; border-radius: 6px; text-decoration: none; font-weigth: bold;">
            Sair
        </a>
    </p>
</main>

<?php require_once __DIR__ . "/../includes/rodape.php"; ?>
</body>
</html>