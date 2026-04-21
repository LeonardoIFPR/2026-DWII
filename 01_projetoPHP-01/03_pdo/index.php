<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 05 — PHP + MariaDB: persistencia de dados via PDO
  Autor      : Leonardo Garbuio
  Data       : 21/03/2026
  Caminho    : /workspaces/2026-DWII/03_pdo/index.php
-->
<?php  
$nome = "Leonardo";
$titulo_pagina = "Catalogo de Tecnologias";
$pagina_atual = "Catalogo";

require_once "includes/conexao.php";

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo de tecnologias | Autor <?php echo $nome ?></title>
</head>
<body>

<main>
    <?php include "../includes/cabecalho.php"; ?>

    <div class="container container-catalogo">
        <h1 class="titulo-secao"> Catalogo de Tecnologias</h1>

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

        <p class="subtitulo-contador"><?php echo count($tecnologias); ?> item(s) encontrado(s)</p>
        <?php foreach ($tecnologias as $tec): ?> 
            <div class="card">
                <div class="card-header">
                    <h3><?php echo htmlspecialchars($tec["nome"]); ?></h3>
                    <span class="badge-categoria">
                        <?php echo htmlspecialchars($tec["categoria"]); ?>
                    </span>
                </div>
                <p><?php echo htmlspecialchars($tec["descricao"]); ?></p>
                <a href="/03_pdo/detalhe.php?id=<?php echo $tec["id"]; ?>" class="link-detalhe">Ver detalhes &rarr;</a>
            </div>
            <?php endforeach; ?>
    </div>

    <?php include "../includes/rodape.php"; ?>
</main>

</body>
</html>


<!--
so uma explicação da logica para não ter o conflito entre uma busca é basicamente o maior problema onde eu travei foi 
como fazer quando a pessoa pesquisa e ao msm tempo seleciona uma categoria a solução foi fazer um if e else como funciona
basicamente criamos duas variavies a variavel busca e a variavel categoria que pegam o valor da URL e a partir disso entramos
no bloco if que faz a parte mais logica ele analisa nossas variaveis PHP que são a busca e categoria e a partir desta informação 
executa o sql correto ate ai esta tudo ate que simples o que eu realmente travei um pouco foi como fazer quando a pessoa
pesquisa o nome da tecnologis com uma categoria selecionada é aqui que entra esta primeira parte 

if ($categoria && $busca) {
    $stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE categoria = :categoria AND (nome LIKE :palavra OR descricao LIKE :palavra2) ORDER BY nome ASC");
    $stmt->execute(['categoria' => $categoria, 'palavra' => "%$busca%", 'palavra2' => "%$busca%"]);
} 

ele é a verificação mais complexa ele ve se a pessoa esta em alguma categoria usando o where categoria e dps o and(pergunta se tem algo a mais) e esse algo a mais 
seria a palavra então ele ve a categoria pelo where e depois ve se tem alguma palavra e ai a partir destas informações esta parte assum o execute 
 $stmt->execute(['categoria' => $categoria, 'palavra' => "%$busca%", 'palavra2' => "%$busca%"]);
que faz oq sugere executa ele compara a nossa variavel categoria com a selecionada pelo usuario da um valor a ela faz a 
mesma coisa com a busca a unica diferença é essa palavra2 ela esta ali porque, por que ele não procura somente o nome da tecnologia
podemos procurar digamos uma palavra da descrição então é por isso que ele esta ali basicamente precisamos dessas 2 palavras a palavra e
palavra2 para "etiquetar" o valor da busca dentro do array dps com esse array mandamos os valores para o pdo que substitui no sql e faz a busca seja nome ou descrição
-->