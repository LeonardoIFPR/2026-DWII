<?php
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();

$erro = "";
$projeto = null;

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    $erro = "ID invalido";
}

$stmt = $pdo->prepare("select * from projetos where id = :id");
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();

if (!$projeto) {
    $erro = "projeto não encontrado";
}
?>
