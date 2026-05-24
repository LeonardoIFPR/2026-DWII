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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/includes/conexao.php";
require_once __DIR__ . "/includes/auth.php";

if (usuario_logado()) {
    header("Location: painel.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["login"] ?? "");
    $senha = $_POST["senha"] ?? "";

if ($login === "" || $senha === "") {
    $erro = "informe usuario e senha";
}
else {
    $pdo = conectar();
    $stmt = $pdo->prepare(
    "select id, login, senha from usuarios where login = :login and status = 'ativo' limit 1"
);
$stmt->execute([":login" => $login]);
$usuario = $stmt->fetch();

if($usuario && password_verify($senha, $usuario["senha"])) {
    session_regenerate_id(true);
    $_SESSION["usuario"] = $usuario["login"];

$log = $pdo->prepare(
    "insert into logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
    values ('usuarios', :id, 'login', :login, 'login bem sucedido')"
);

$log->execute([
    ":id" => $usuario["id"],
    ":login" => $usuario["login"],
]);

header("Location: painel.php");
exit;
}

$log = $pdo->prepare(
    "insert into logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
    values ('usuarios', 0, 'login_fail', :login, 'credenciaisinvalidas')"
);

$log->execute([":login" => $login]);

$erro = "Usuario ou senha invalidos";
}
}

$titulo_pagina = "Login - Portfolio";
$caminho_raiz = "./";
$pagina_atual = "Login";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <main>
        <?php require_once __DIR__ . "/includes/cabecalho.php" ?>
        <h1 class="titulo-secao" style="text-align: center; width: 100%;">Login</h1>

        <?php if ($erro !== ""): ?>
            <p class="alerta-erro" style="text-align: center;"><?php echo htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form class="form_container form-login-box" method="POST" action="login.php">
            <label>Usuario<br>
            <input type="text" name="login" required>
            </label>
            <br><br>
            <label>Senha<br>
            <input type="password" name="senha" required>
            </label>
            <br><br>
            <button type="submit" class="btn">Entrar</button>
        </form>
            <?php require_once __DIR__ . "/includes/rodape.php"; ?>
    </main>

</body>
</html>