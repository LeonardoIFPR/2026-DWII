<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 05 — PHP + MariaDB: persistencia de dados via PDO
  Autor      : Leonardo Garbuio
  Data       : 21/03/2026
  Caminho    : /workspaces/2026-DWII/03_pdo/index.php
-->
<?php  

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nome = "Leonardo";
$titulo_pagina = "Catalogo de Tecnologias";
$pagina_atual = "Catalogo";
$caminho_raiz = "./";

require_once __DIR__ . "/includes/conexao.php";

$pdo = conectar();

$stmt = $pdo->query("select * from tecnologias where status = 'ativo' order by nome asc");
$categoria = trim($_GET['categoria'] ?? '');
$busca = trim($_GET['busca'] ?? '');

if ($categoria && $busca) {
    $stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE categoria = :categoria AND (nome LIKE :palavra OR descricao LIKE :palavra2) ORDER BY nome ASC");
    $stmt->execute(['categoria' => $categoria, 'palavra' => "%$busca%", 'palavra2' => "%$busca%"]);
} elseif ($categoria) {
    $stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE categoria = :categoria ORDER BY nome ASC");
    $stmt->execute(['categoria' => $categoria]);
} elseif ($busca) {
    $stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE nome LIKE :palavra OR descricao LIKE :palavra2 ORDER BY nome ASC");
    $stmt->execute(['palavra' => "%$busca%", 'palavra2' => "%$busca%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM tecnologias ORDER BY nome ASC");
}

$tecnologias = $stmt->fetchAll();

$stmt_cats = $pdo->query("SELECT DISTINCT categoria FROM tecnologias ORDER BY categoria ASC");
$categorias = $stmt_cats->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?> | Autor <?php echo $nome; ?></title>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>

<main class="container">
    <div class="header-flex">
        <h1 class="titulo-secao">Catálogo de Tecnologias</h1>
        <span class="contador-texto">
            <?php echo count($tecnologias); ?> tecnologia(s)
        </span>
    </div>

    <div class="busca-container">
        <form method="get" action="index.php">
            <?php if ($categoria): ?>
                <input type="hidden" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>">
            <?php endif; ?>
            <input type="text" name="busca" placeholder="Buscar tecnologia..." value="<?php echo htmlspecialchars($busca); ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="filtros-categoria">
        <a href="index.php" class="btn-filtro <?php echo !$categoria ? 'ativo' : ''; ?>">Todos</a>
        <?php foreach ($categorias as $cat): ?>
            <a href="index.php?categoria=<?php echo urlencode($cat['categoria']); ?>" 
               class="btn-filtro <?php echo $categoria === $cat['categoria'] ? 'ativo' : ''; ?>">
                <?php echo htmlspecialchars($cat['categoria']); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($tecnologias)): ?>
        <div class="card card-vazio">

            <p>Nenhuma tecnologia ativa.</p>
        </div>
    <?php else: ?>
        <?php foreach ($tecnologias as $tec): ?>
            <div class="card">
                <div class="card-header-flex">
                    <h3><?php echo htmlspecialchars($tec['nome']); ?></h3>
                    <span class="badge-categoria">
                        <?php echo htmlspecialchars($tec['categoria']); ?>
                    </span>
                </div>
                <p><?php echo htmlspecialchars($tec['descricao']); ?></p>
                <a href="detalhe.php?id=<?php echo (int)$tec['id']; ?>" class="btn-secundario">
                    Ver detalhes &rarr;
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php include __DIR__ . '/includes/rodape.php'; ?>
</main>

</body>
</html>