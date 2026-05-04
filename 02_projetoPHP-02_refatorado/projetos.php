<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/05_crud/includes/conexao.php";

$pdo = conectar();

$pagina_atual_paginacao = (int)($_GET["pagina_atual_paginacao"] ?? 1); //o int ta aqui pra evita sql injection //verifica se é null se não tivesse aquele 1 daria problrma porque o sistema acharia que é para ir para uma pagina vazia nulla 
$pula_3 = ($pagina_atual_paginacao - 1) * 3; /*a logica aqui foi a unica que eu pensei e funcionou o que ta fazendo aqui criei a função pula_3 ele pega a pagina atual da variavel pagina_atual que estamos tipo o 1 e subtrai 1 e multiplica por 3 sabemos que isso
 da 0 e na teoria esta errado mas o 0 é contado então o primeiro projeto é o 0 o 1 e o 2 se mudarmos pra pagina 2 seria 2 menos 1 vezes 3 que seriam os projetos 3, 4 e 5 é a mesma logica de delimitar o array discutida em aula so não usei a ideia do array 
 por que isso deixaria lento dependendo de quantos projetos temos diferente de usar o SQL que é muito mais eficiente e a logica é a mesma do array e se quisermos deixar mais projeto em uma pagina é so mudar o 3 pelo numero de projetos que quer que a
 pagina tenha*/


$busca = trim($_GET["busca"] ?? "");
$filtro_tecnologias = trim($_GET["tecnologia"] ?? "");

$stmt_tecnologias = $pdo->query("select distinct tecnologias from projetos");
$total_tecnologias = $stmt_tecnologias->fetchAll(PDO::FETCH_COLUMN); //organiza as informações que traz do banco o que facilita a escrita no HTML daria pra usae sem mas daria mais trabalho de escrita

if ($busca != "" || $filtro_tecnologias != "") {
    $sql = "select * from projetos where status = 'publicado' and nome like :termo and tecnologias like :tecnologia order by destaque desc, criado_em desc limit 3 offset $pula_3";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":termo" => "%" . $busca . "%", ":tecnologia" => "%" . $filtro_tecnologias . "%"]);
} else {
    $stmt = $pdo->query("select * from projetos where status = 'publicado' order by destaque desc, criado_em desc limit 3 offset $pula_3");
}


$projetos = $stmt->fetchAll();

//esse aqui de baixo todo não precisa so coloquei pq tava estranho quando trocava de pagina e ficava como se não existissem projetos esse é uma trava ele conta quantos projetos tem e não deixo vc ir para uma pagina vazia sem projetos a logica é a msm do de cima a diferença é o count(*) ele é quem faz a contagem de projetos e diz se existe um depois ou não 
$sql_total = "select count(*) from projetos where status = 'publicado' and nome like :termo and tecnologias like :tecnologia";
$stmt_total = $pdo->prepare($sql_total);
$stmt_total->execute([":termo" => "%" . $busca . "%", ":tecnologia" => "%" . $filtro_tecnologias . "%"]);
$total_registros = $stmt_total->fetchColumn();

$tem_proxima = ($pula_3 + count($projetos)) < $total_registros;

$cadastroOK = isset($_GET["cadastro"]) && $_GET["cadastro"] === "ok";

$editadook = isset($_GET["editado"]) && $_GET["editado"] === "ok";

$excluidook = isset($_GET["excluido"]) && $_GET["excluido"] === "ok";

$erroMsg = isset($_GET["erro"]) ? $_GET["erro"] : "";

$titulo_pagina = "Meua Projetos - Portfolio";
$caminho_raiz = "./";
$pagina_atual = "catalogo de projetos";
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div class="container">
          <?php require_once __DIR__ . "/includes/cabecalho.php" ?>
        <div>
            <h1 class="titulo-secao">Meus Projetos</h1>
            <form action="index.php" method="get">
                <input type="text" name="busca" value="<?php echo htmlspecialchars($busca); ?>" placeholder="Buscar pelo nome do projeto">
                    <select name="tecnologia">
                        <option value="">Todas as tecnologias</option>
                            <?php if (isset($total_tecnologias)): ?>
                                <?php foreach ($total_tecnologias as $tecnologia_selecionada): ?>
                                    <option value="<?php echo htmlspecialchars($tecnologia_selecionada); ?>" <?php echo $filtro_tecnologias == $tecnologia_selecionada ? "selected" : ""; ?>> <?php echo htmlspecialchars($tecnologia_selecionada); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                    </select>

                    <button type="submit">Buscar</button>
                        <?php if($busca || $filtro_tecnologias): ?>
                            <p>Nenhum projeto encontrado para "<strong><?php echo htmlspecialchars($busca); ?></strong>" na tecnologia "<strong><?php echo htmlspecialchars($filtro_tecnologias); ?></strong>".</p>
                            <a href="index.php">Limpar</a>
                        <?php endif; ?>  
                </form>
        </div>

        <?php if ($erroMsg === "não encontrado"): ?>
            <div>
                <p>Projeto não encontrado pode ter sido apagado</p>
            </div>
        <?php elseif ($erroMsg === "id_invalido"): ?>
            <div>
                <p>Requisição invalida</p>
            </div>
        <?php endif; ?>

        <?php if (empty($projetos)): ?>
        <div class="card">
            <p>***</p>
            <p>Nenhum projeto cadastrado ainda</p>
        </div>

        <?php else: ?>
            <div>
                <?php foreach ($projetos as $projeto): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($projeto["nome"]); ?></h3>

                        <p><?php echo htmlspecialchars($projeto["descricao"]); ?></p>

                        <p><?php echo htmlspecialchars($projeto["tecnologias"]); ?></p>

                        <p><?php echo htmlspecialchars((int) $projeto["ano"]); ?></p>

                        <?php if ($projeto["link_github"]): ?><a href="<?php echo htmlspecialchars($projeto["link_github"]); ?>" target="_blank" rel="noopener noreferrer" class="btn-secundario">Ver no GitHub</a>
                    <?php endif ?>  
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="paginacao">
                <?php if ($pagina_atual_paginacao > 1): ?>
                    <a href="index.php?pagina_atual_paginacao=<?php echo $pagina_atual_paginacao - 1; ?>&busca=<?php echo urlencode($busca); ?>&tecnologia=<?php echo urlencode($filtro_tecnologias); ?>" class="btn-pag">
                        &larr; Anterior
                    </a>
                <?php endif; ?>

                <span class="pagina-numero">Página <?php echo $pagina_atual_paginacao; ?></span>

                <?php if ($tem_proxima): ?>
                    <a href="index.php?pagina_atual_paginacao=<?php echo $pagina_atual_paginacao + 1; ?>&busca=<?php echo urlencode($busca); ?>&tecnologia=<?php echo urlencode($filtro_tecnologias); ?>" class="btn-pag">
                        Próxima &rarr;
                    </a>
                <?php endif; ?>
            </div>
            <p><?php echo $total_registros;//aqui eu troquei o count($projetos); por $total_registros; para pegar todos os registros que tem no banco ao inves de so os que tem na pagina a variavel $total_registros foi criada la encima é ela quem faz a trava ?> 
            Projetos(s) cadastrados(s)</p>
        <?php endif ?>
        <?php require_once __DIR__ . "/includes/rodape.php"?>
    </div>
</body>
</html>