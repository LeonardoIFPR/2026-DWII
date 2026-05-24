<?php
require_once __DIR__ . "/includes/auth.php";
require_once __DIR__ . "/includes/conexao.php";
requer_login();

$pdo = conectar();

$stmt = $pdo->query("select * from logs order by criado_em desc");
$logs = $stmt->fetchAll();

$titulo_pagina = "Trilha de Auditoria (Logs)";
$caminho_raiz = "./";
$pagina_atual = "logs";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
</head>
<body>
<main>
    <?php require_once __DIR__ . "/includes/cabecalho.php"; ?>
    <h1 class="titulo-secao">Trilha de Auditoria</h1>
    
    <div class="box-info">
        <h3>Registro de Ações</h3>
        <p>Abaixo estão todas as ações registradas no sistema (criação, edição e exclusão/arquivamento de projetos, e logins).</p>
    </div>

    <a href="admin.php" class="btn-voltar">&larr; Voltar ao Painel</a>

    <?php if (empty($logs)): ?>
        <p>Nenhum log encontrado.</p>
    <?php else: ?>
        <table class="tabela-admin">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Ação</th>
                    <th>Tabela</th>
                    <th>Registro ID</th>
                    <th>Usuário</th>
                    <th>Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars(date("d/m/Y H:i:s", strtotime($log["criado_em"]))); ?></td>
                        <td>
                            <span class="badge-categoria"><?php echo htmlspecialchars($log["acao"]); ?></span>
                        </td>
                        <td><?php echo htmlspecialchars($log["tabela_afetada"]); ?></td>
                        <td><?php echo (int) $log["registro_id"]; ?></td>
                        <td><?php echo htmlspecialchars($log["usuario_login"] ?? "Sistema"); ?></td>
                        <td><?php echo htmlspecialchars($log["detalhes"] ?? "-"); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php require_once __DIR__ . "/includes/rodape.php"; ?>
</main>
</body>
</html>
