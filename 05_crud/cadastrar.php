<?php
require_once __DIR__ . "/../04_sessoes/includes/auth.php";
requer_login();

require_once __DIR__ . "/includes/conexao.php";

$erro = "";
$sucesso = "";

$form = [
    "nome" => "",
    "descricao" => "",
    "tecnologias" => "",
    "link_github" => "",
    "ano" => date("Y"),
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $form["nome"] = trim($_POST["nome"] ?? "");
    $form["descricao"] = trim($_POST["descricao"] ?? "");
    $form["tecnologias"] = trim($_POST["tecnologias"] ?? "");
    $form["link_github"] = trim($_POST["link_github"] ?? "");
    $form["ano"] = trim($_POST["ano"] ?? date("Y"));

    if ($form["nome"] === "") {
        $erro = "O nome do projeto é obrigatorio";
    } elseif ($form["descricao"] === "") {
        $erro = "A descrição é obrigatoria";
    } elseif ($form["tecnologias"] === "") {
        $erro = "Informe ao menos uma tecnologia";
    } elseif ($form["ano"] < 2000 || $form["ano"] > (int) date("Y") + 1) {
        $erro = "Ano invalido";
    }

    if ($erro === "") {
        $pdo = conectar();

        $sql = "insert into projetos (nome, descricao, tecnologias, link_github, ano)
        values (:nome, :descricao, :tecnologias, :link_github, :ano)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $form["nome"],
            ":descricao" => $form["descricao"],
            ":tecnologias" => $form["tecnologias"],
            ":link_github" => $form["link_github"] !== "" ? $form["link_github"] : null,
            ":ano" => $form["ano"],
        ]);

        header("Location: index.php?cadastro=ok");
        exit;
    }
}

$titulo_pagina = "Cadastrar Projeto - Portfolio";
$caminho_raiz = "../";
$pagina_atual = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . "/../includes/cabecalho.php"; ?>
</head>
<body>
    <div class="container">
        <h1 class="titulo-secao">Cadastrar Novo Projeto</h1>

        <?php if ($erro): ?>
            <div class="alerta-erro">
                <p> <?php echo htmlspecialchars($erro); ?></p>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="cadastrar.php" method="post">
                <label for="name">Nome Projeto: <span>*</span></label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($form["nome"]); ?>" placeholder="Ex.: Sistema de Login com PHP" maxlength="120">
                <label for="descricao">Descrição: <span>*</span></label>
                <textarea name="descricao" id="descricao" rows="4" placeholder="Descreva o prpjeto em 2-3 frases..."><?php htmlspecialchars($form["descricao"]); ?></textarea>
                <label for="tecnologias">Tecnologias Usadas: <span>*</span></label>
                <input type="text" id="tecnologia" name="tecnologias" value="<?php echo htmlspecialchars($form["tecnologias"]); ?>" placeholder="Ex.: PHP, MariaDB, HTML, CSS" maxlength="200">
                <label for="link_github">Link do GitHub: <span>(opicional)</span></label>
                <input type="url" id="link_github", name="link_github" value="<?php echo htmlspecialchars($form["link_github"]); ?>" placeholder="https://github.com/usuario/repositorio">
                <label for="ano">Ano: <span>*</span></label>
                <input type="number" id="ano" name="ano" value="<?php echo htmlspecialchars($form["ano"]); ?>" min="2000" max="<?php echo date("Y") +  1; ?>">

                <button type="submit">Salvar Projeto</button>
            </form>
        </div>
        <a href="index.php">&larr; Voltar a Listagem</a>
    </div>

    <?php require_once __DIR__ . "/../includes/rodape.php" ?>
</body>
</html>