<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 05 — PHP + MariaDB: persistencia de dados via PDO
  Autor      : Leonardo Garbuio
  Data       : 21/03/2026
  Caminho    : /workspaces/2026-DWII/03_pdo/detalhe.php
-->
<?php 
$caminho_raiz = "../";

require_once "includes/conexao.php";

$id = filter_input (INPUT_GET, "id", FILTER_VALIDATE_INT);

if(!$id) {
    header("location: index.php");
    exit;
}

$stmt = $pdo->prepare("select * from tecnologias where id = :id");
$stmt->execute(["id" => $id]);
$tec = $stmt->fetch();

if(!$tec) {
    include "404.php";
    exit;
}

$titulo_pagina = htmlspecialchars($tec["nome"]) . " - Catalogo";
$pagina_atual = "catalogo";

$categoria = trim($_GET['categoria'] ?? '');
$url_voltar = $categoria ? "index.php?categoria=" . urlencode($categoria) : "index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
</head>
<body>

<main>
    <?php include "../includes/cabecalho.php"; ?>

    <div class="container container-catalogo">
        <a href="<?php echo $url_voltar; ?>" class="btn-voltar">&larr; Voltar ao Catalogo</a>
        <div class="card">
            <div class="detalhe-header">
                <h1><?php echo htmlspecialchars($tec["nome"]) ?></h1>
                <span class="badge-categoria"><?php echo htmlspecialchars($tec["categoria"]) ?></span>
            </div>
            <p class="detalhe-descricao">
                <?php echo htmlspecialchars($tec["descricao"]); ?>
            </p>
            <table class="tabela-detalhes">
                <tr>
                    <td>ID</td>
                    <td><?php echo $tec["id"]; ?></td>
                </tr>
                <tr>
                    <td>Ano de Criação</td>
                    <td><?php echo $tec["ano_criacao"]; ?></td>
                </tr>
                <tr>
                    <td>Cadastrado em</td>
                    <td><?php echo date("d/m/Y \a\s H:i", strtotime($tec["criado_em"])) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <?php include "../includes/rodape.php"; ?>
</main>

</body>
</html>