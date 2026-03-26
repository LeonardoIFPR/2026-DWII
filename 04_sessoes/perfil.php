<?php
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 06 — Autenticação com sessões e controle de acesso
  Autor      : Leonardo Garbuio
  Data       : 25/03/2026
  Caminho    : /workspaces/2026-DWII/04_sessoes/perfil.php
*/

require_once __DIR__ . "/includes/auth.php";
requer_login();

$titulo_pagina = "Perfil - Area Restrita";
$caminho_raiz = "../";
$pagina_atual = "";

if (!isset($_SESSION['visitas_perfil'])) {
    $_SESSION['visitas_perfil'] = 0;

}
$_SESSION['visitas_perfil']++;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>

<main>
    <?php require_once __DIR__ . "/../includes/cabecalho.php"; ?>

    <h2 class="titulo-secao">Meu Perfil</h2>
    
    <div class="card">

        <p><strong>Usuario:</strong>
            <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
        </p>

        <p><strong>Login realizado em:</strong>
            <?php echo htmlspecialchars($_SESSION["logado_em"] ?? "-"); ?>
        </p>

        <p><strong>Visitas na sessao:</strong>
            <?php echo htmlspecialchars($_SESSION["visitas_perfil"]); ?> <!--eu coloquei visitas_perfil por que se fosse so visitas ele pegaria da variavel visitas poremm perfil e painel são paginas diferentes e não da pra contar que vc acessou perfil se vc acessou so o painel por isso a mudança de nome -->
        </p>
    </div>

    <p>
        <a href="painel.php"  class="btn-voltar-painel">
            Voltar ao Painel
        </a>
    </p>
</main>
<?php require_once __DIR__ . "/../includes/rodape.php"; ?>
</body>
</html>