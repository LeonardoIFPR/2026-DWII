<?php 
require_once __DIR__ . "/../04_sessoes/includes/auth.php";
requer_login();

require_once __DIR__ . "/includes/conexao.php";

$pdo = conectar();

$busca =trim($_GET["busca"] ?? "");

if ($busca != "") {
    $sql = "select * from projetos where nome like :termo order by criado_em desc";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':termo' => '%' . $busca . '%']);
} else {
    $stmt = $pdo->query("select * from projetos order by criado_em desc");
}

$projetos = $stmt->fetchAll();

$cadastroOK = isset($_GET["cadastro"]) && $_GET["cadastro"] === "ok";

$editadook = isset($_GET["editado"]) && $_GET["editado"] === "ok";

$excluidok = isset($_GET["excluido"]) && $_GET["excluido"] === "ok";

$erroMsg = isset($_GET["erro"]) ? $_GET["erro"] : "";

$titulo_pagina = "Meua Projetos - Portfolio";
$caminho_raiz = "../";
$pagina_atual = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . "/../includes/cabecalho.php" ?>
</head>
<body>
    <div class="container">
        <div>
            <h1 class="titulo-secao">Meus Projetos</h1>
            <form action="index.php" method="get">
                <input type="text" name="busca" value="<?php echo htmlspecialchars($busca); ?>" placeholder="Buscar pelo nome do projeto">
                    <button type="submit">Buscar</button>
                        <?php if($busca): ?>
                            <a href="index.php">Limpar</a>
                        <?php endif; ?>
            </form>
            <a href="cadastrar.php" class="btn-primario">Novo Projeto</a>
        </div>

        <?php if ($cadastroOK): ?>
            <div>
                <p>Projeto Cadastrado com sucesso</p>
            </div>
        <?php endif; ?>

        <?php if ($editadoOK): ?>
            <div>
                <p>Projeto Atualizado com sucesso</p>
            </div>
        <?php endif; ?>

        <?php if ($excluidoOK): ?>
            <div>
                <p>Projeto Excluido com sucesso</p>
            </div>
        <?php endif; ?>

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
            <a href="cadastrar.php" class="btn-primario">Cadastrar o primeiro projeto</a>
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
                    
                    <div>
                        <a href="editar.php?id=<?php echo htmlspecialchars((int) $projeto["id"]); ?>" class="button_edita">Editar</a>

                        <a href="excluir.php?id=<?php echo htmlspecialchars((int) $projeto["id"]); ?>" class="perigo_apaga">Excluir</a>
                    </div>
                    </div>
            </div>
        <?php endforeach; ?>

    <p><?php echo count($projetos); ?> Projetos(s) cadastrados(s)</p>
    <?php endif ?>
</div>
<?php require_once __DIR__ . "/../includes/rodape.php"?>
</body>
</html>