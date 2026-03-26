<?php 
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 06 — Autenticação com sessões e controle de acesso
  Autor      : Leonardo Garbuio
  Data       : 25/03/2026
  Caminho    : /workspaces/2026-DWII/04_sessoes/login.php
*/

/*
session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
*/

require_once __DIR__ . "/includes/auth.php";
redireciona_se_logado();

$USUARIO_VALIDO = "admin";
$SENHA_VALIDA = "dwii2026";

$erro = "";
$login = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["usuario"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

if ($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA) {

    $_SESSION['flash'] = "Bem-vindo ao painel ADMIN " . htmlspecialchars($login);
//o que esse bloca ta fazendo ele esta usando o $_SESSION para lembrar de vc e usando flash que é uma variavel que usamos para o codigo saber se é a primeira vez que vc logou é isso que faz a ativação do unset que é uma função ja do PHP 

    session_regenerate_id(true);
    $_SESSION["usuario"] = $login;
    $_SESSION["logado_em"] = date("d/m/Y \à\s H:i");
    header("Location: painel.php");
    exit;
}
else {
    if(!isset($_SESSION["tentativas"])) {
        $_SESSION['tentativas'] = 0;
    }

    $_SESSION['tentativas']++;

    if ($_SESSION >= 5) {
        $_SESSION["bloqueado_ate"] =  time() + 60;
}else {
    $erro = "Usuario ou senha incorretos você ainda tem " . $_SESSION["tentativas"] . "tentativas";
    }
}
}

/*
essa minha bagunça toda de ifs ta fazendo a verificação de tentativas como funciona ele pega oq o usuario digita e compara como ja era antes a mudança agora é adicionar outro else (não é bem adicionar a palavra correta mas não sei como descrever)
que primeiros criamos um if e dentro criamos a variavel tentativas que esta zerada esse é oq ira contar quantas tentativas foram usadas apos criar isso fazemos a logica para contar quanta
tentativas foram usadas para isso pegamos tentativas e a cada erro somamos 1 e esse valor fica salvo na variavel depois criamos outro if onde fazemos a comparação se a variavel tentativa
é menor ou maior que 5 se menor beleza ainda tem chances se não ele passa pro else que diz a msg de erro quantos tentativas ainda tem 

para a logica do timer eu tentei usar algo com o date ou so contar os segundos mas por uma limitação do proprio PHP eu precisei usar essa função do PHP de time
ele nos da o horario atual +60 segundos para liberar eu não pensei em nenhum outro jeito de fazer o timer 
*/

$titulo_pagina = "Login - Area Restrita";
$caminho_raiz = "../";
$pagina_atual = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <main>
        <?php require_once __DIR__ . "/../includes/cabecalho.php" ?>
        <div class="form-container">
            <h1 class="titulo_secao" style="text-align: center; font-size: 22px">
                Area Restrita
            </h1>

            <?php if ($erro): ?>
                <div class="alerta-erro">
                    <p style="margin: 0; font-size:14px;">
                        <?php echo htmlspecialchars($erro); ?>
                    </p>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <label>Usuario: </label>
                <input type="text" name="usuario" value="<?php echo htmlspecialchars($login); ?>" autocomplete="username">

                <label>Senha: </label>
                <input type="password" name="senha" autocomplete="curent-password">

                <button type="submit">Entar</button>
            </form>

            <p style="text-align: center; margin-top: 20px; font-size: 13px; color: #6b7280">
                <a href="../index.php" style="color: #3b579d;">&larr; Volar ao Inicio</a>
            </p>
        </div>
    </main>

    <?php require_once __DIR__ . "/../includes/rodape.php"; ?>
</body>
</html>


<!--
demorei acho que uma hora pra achar o erro o PHP estava todo certo então lembrei que para funcionar usamos o POST para capturar
o que o usuario digita e dps passamos isso para a variavel então fui conferir o HTML e o erro era super simples 
<input type="text" nome="usuario" value="<\\?php echo htmlspecialchars($login); ?>" autocomplete="username"> aqui no input do Usuario
ao inves de name estava nome esse era o unico erro porque estando desta forma escrito nome o metodo POST não sabe de onde puxar a entrada Usuario
-->
