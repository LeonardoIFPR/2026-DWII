<?php
require_once __DIR__ . "/../04_sessoes/includes/auth.php";
requer_login();

require_once __DIR__ . "/includes/conexao.php";

$id = (int) ($_GET["id"] ?? 0);

if ($id <= 0) {
    header("Location: index.php?erro=id_invalido");
    exit;
}

$pdo = conectar();
$stmt = $pdo->prepare("select * from projetos where id = :id");
$stmt->execute([":id" => $id]);
$projeto = $stmt->fetch();

if (!$projeto) {
    header("Location: index.php?erro=nao_encontrado");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $tecnologias = trim($_POST["tecnologias"] ?? "");
    $link_github = trim($_POST["link_github"] ?? "");
    $ano = trim($_POST["ano"] ?? date("Y"));

    if ($nome === "" || $descricao === "" || $tecnologias === ""){
        $erro = "preencha todos os campos";
    }

    if ($erro === "") {
        $sql = "update projetos set nome = :nome, descricao = :descricao, tecnologias = :tecnologias, link_github = :link_github, ano = :ano where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $nome,
            ":descricao" => $descricao,
            ":tecnologias" => $tecnologias,
            ":link_github" => $link_github !== "" ? $link_github :null,
            ":ano" => $ano,
            ":id" => $id,
        ]);

        header("Location: index.php?editado=ok");
        exit;
    }

    $projeto["nome"] = $nome;
    $projeto["descricao"] = $descricao;
    $projeto["tecnologias"] = $tecnologias;
    $projeto["link_github"] = $link_github;
    $projeto["ano"] = $ano;
}

$titulo_pagina = "Editar Projeto - Portfolio";
$caminho_raiz = "../";
$pagina_atual = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <main>
        <?php require_once __DIR__ . "/../includes/cabecalho.php" ?>
        <h1>Editar Projeto</h1>

        <?php if ($erro): ?>
            <div>
                <p><?php echo htmlspecialchars($erro); ?></p>
            </div>
        <?php endif; ?>

        <form action="editar.php?id=<?php echo $id; ?>" method="POST" class="formulario">

        <div class="campo">
            <label class="label-campo">Nome do Projeto</label>

            <input type="text" name="nome" class="input-texto" value="<?php echo htmlspecialchars($projeto["nome"]); ?>">
        </div>

        <div class="campo">
            <label class="label-campo">Descrição</label>

            <textarea name="descricao" class="input-texto" rows="4"><?php echo htmlspecialchars($projeto["descricao"]); ?></textarea>        </div>

        <div class="campo">
            <label class="label-campo">Tecnologias</label>

            <input type="text" name="tecnologias" class="input-texto" value="<?php echo htmlspecialchars($projeto["tecnologias"]); ?>">
        </div>

        <div class="campo">
            <label class="label-campo">Link do gitHub (opcional)</label>

            <input type="text" name="link_github" class="input-texto" value="<?php echo htmlspecialchars($projeto["link_github"]); ?>">
        </div>

        <div class="campo">
            <label class="label-campo">Ano</label>

            <input type="number" name="ano" class="input-texto" value="<?php echo htmlspecialchars( (int) $projeto["ano"]);?>" min="2000" max="2099" >
        </div>

        <div class="campo">
            <button type="submit" class="btn-primario">Salvar alterações</button>
            <a href="index.php" class="btn-secundario">Cancelar</a>
        </div>
        </form>
    </main>
    <?php require_once __DIR__ . "/../includes/rodape.php"; ?>
</body>
</html>