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

require_once __DIR__ . "/includes/conexao.php";
require_once __DIR__ . "/includes/auth.php";

if (usuario_logado()) {
    header("Location: painel.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["usuario"] ?? "");
    $senha = $_POST["senha"] ?? "";

if ($login === "" && $senha === "") {
    $erro = "informe usuario esenha";
}
else {
    $pdo = conectar();
    $stmt = $pdo->prepare(
    "select id login, senha and from usuarios where login = :login and status = 'ativo' limit 1"
);
$stmt->execute([":login" => $login]);
$usuario = $stmt->fetch();

if($usuario && password_verify($senha, $usuario["senha"])) {
    session_regenerate_id(true);
    $_SESSION["usuario"] = $usuario["login"];

$log = $pdo->prepare(
    "insert into logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
    values ('usuarios', :id, 'login', :login 'login bem sucedido')"
);

$stmt = $pdo->prepare(
    "select id login, senha and from usuarios where login = :login and status = 'ativo' limit 1"
);

$log->execute([
    ":id" => $usuario["id"],
    ":login" => $usuario["login"],
]);

header("location: painel.php");
exit;
}

$log = $pdo->prepare(
    "insert into logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
    values ('usuarios', 0, 'login_fail', :login 'credenciaisinvalidas')"
);

$log->execute([":login" => $login]);

$erro = "Usuario ou senha invalidos";
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


$titulo_pagina = "Login - Portfolio";
$caminho_raiz = "../";
$pagina_atual = "Login";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <main>
        <?php require_once __DIR__ . "/includes/cabecalho.php" ?>
        <h1>Login</h1>

        <?php if ($erro !== ""): ?>
            <p><?php htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form action="POST" action="logn.php">
            <label>Usuario<br>
            <input type="text" name="login" required>
            </label>
            <br><br>
            <label>Senha<br>
            <input type="password" name="senha" required>
            </label>
            <br><br>
            <button type="submit">Entrar</button>
        </form>
            <?php require_once __DIR__ . "/includes/rodape.php"; ?>
    </main>

</body>
</html>