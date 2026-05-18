<?php 
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 06 — Autenticação com sessões e controle de acesso
  Autor      : Leonardo Garbuio
  Data       : 25/03/2026
  Caminho    : /workspaces/2026-DWII/04_sessoes/logout.php
*/

require_once __DIR__ . "/includes/auth.php";

$_SESSION = [];

if (ini_get("session.use_cookies")) {
  $p = session_get_cookie_params();
  setcookie(
    session_name(), "", time() - 4200, $p["path"], $p["domain"], $p["secure"], $p["httponly"]
  );
}

session_destroy();

header("location: index.php");
exit;
?>