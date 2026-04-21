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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("delete from projetos where id = :id");
    $stmt->execute([":id" => $id]);

    header("Location: index.php?excluido=ok");
    exit;
}

$titulo_pagina = "Excluir Projeto - Potfolio";
$caminho_raiz = "../";
$pagina_atual = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . "/../includes/cabecalho.php"; ?>
</head>
<body>
    <div>
        <h1>Confirmar Exclusão</h1>

        <div>
            <p>Voce esta prestes a excluir o projeto</p>

            <p><?php echo htmlspecialchars($projeto["nome"]); ?></p>

            <p>Esta ação <strong>não pode ser desfeita</strong></p>

            <form action="excluir.php?id=<?php echo $id; ?>" method="POST">
                <div>
                    <button type="submit">Sim excluir</button>
                    <a href="index.php">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <?php require_once __DIR__ . "/../includes/rodape.php";?>
</body>
</html>