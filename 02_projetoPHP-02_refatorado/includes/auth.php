<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuario_logado(): bool
{
    return isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== "";
}

function usuario_atual(): ?string
{
    return $_SESSION["usuario"] ?? null;
}

function requer_login(): void
{
    if (!usuario_logado()) {
        header("Location: login.php");
        exit;
    }
}