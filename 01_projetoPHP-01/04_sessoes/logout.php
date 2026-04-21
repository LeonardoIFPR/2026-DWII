<?php 
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 06 — Autenticação com sessões e controle de acesso
  Autor      : Leonardo Garbuio
  Data       : 25/03/2026
  Caminho    : /workspaces/2026-DWII/04_sessoes/logout.php
*/

session_start();

session_unset();

session_destroy();

header("Location: login.php");
exit;
?>