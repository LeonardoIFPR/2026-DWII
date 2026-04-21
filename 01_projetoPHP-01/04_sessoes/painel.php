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
    
    <?php if(isset($_SESSION["flash"])): ?>

        <p class="flash-msg"><?php echo $_SESSION['flash']; ?></p>

        <?php unset($_SESSION['flash']);?>  <!--é esse aqui que apaga a msg caso o flash diga que não é a primeira vez que vc entra no painel-->

    <?php endif; ?>

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

    <div class="card">
        <h3>Painel de controle</h3>
        <p>Este conteudo só é visivel para usuarios autenticados</p>
        <p>Nas proximas aulas este painel tera funcionalidades reais (CRUD)</p>
        <a href="../05_crud/index.php" class="btn-primario">Gerenciar Projetos</a>
        <div class="svg_perfil">
            <a href="perfil.php" class="link-engrenagem">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                </svg>
            </a>
    <!-- so explicando isso é um SVG não fui eu quem fiz peguei desse site https://lucide.dev/icons/settings  é um SVG é basicamente um icone mas não é bem isso não sei explicar ao certo que vc baixa e usa no seu codigo esse é de codigo livre e sla para acessar perfil achei que algo assim combinaria e ele abre a pagina pq esta dentro da tag a que é usada pra linkar 
     ja usei um SVG em 02_formularios/obrigado.php so que o que usei la era mais simples
     -->
        </div>
    </div>

    <p>
        <a href="logout.php" class="btn-sair">
            Sair
        </a>
    </p>
</main>

<?php require_once __DIR__ . "/../includes/rodape.php"; ?>
</body>
</html>