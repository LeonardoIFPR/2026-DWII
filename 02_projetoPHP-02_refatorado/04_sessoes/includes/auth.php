<?php  
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 06 — Autenticação com sessões e controle de acesso
  Autor      : Leonardo Garbuio
  Data       : 25/03/2026
  Caminho    : /workspaces/2026-DWII/04_sessoes/includes/auth.php
*/

function requer_login(): void
{
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["usuario"])) {
        header("Location: /../04_sessoes/login.php");
        exit;
    }
}

function redireciona_se_logado(): void 
{
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION["usuario"])) {
        header("Location: painel.php");
        exit;
    }
}

function usuario_logado(): string 
{
    return $_SESSION["usuario"] ?? "";
}



/*
eu encontrei um pequeno não problema mas incomodo que era quando a pessoa esta logada e tenta forçar entrar em login.php da erro que ele tenta abrir a todo jeito e como esta bloqueado não vai 
dai criei essa outra função ela é literalmente um copia e cola da que ja tem a unica diferença é que muda para aonde ela aponta ao inves de login é para o painel.php 
*/