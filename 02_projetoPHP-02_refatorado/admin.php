<?php
require_once __DIR__ . "/includes/auth.php";
require_once __DIR__ . "/includes/conexao.php";
requer_login();

$pdo = conectar();
$erro = "";
$em_edicao = null;

function registrar_log(PDO $pdo, string $acao, int $registro_id, string $detalhes): void
{
    $stmt = $pdo->prepare("insert into logs (tabela_afetada, registro_id, acao, usuario_login, detalhes) values (\"projetos\", :id, :acao, :usuario, :detalhes)");
    $stmt->execute([":id" => $registro_id, ":acao" => $acao, ":usuario" => usuario_atual(), ":detalhes" => $detalhes]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";
    
    if ($acao === "salvar") {
        $id = (int) ($_POST["id"] ?? 0);
        $nome = trim($_POST["nome"] ?? "");
        $descricao = trim($_POST["descricao"] ?? "");
        $tecnologias = trim($_POST["tecnologias"] ?? "");
        $link_github = trim($_POST["link_github"] ?? "");
        $ano = (int) ($_POST["ano"] ?? date("Y"));
        $status = $_POST["status"] ?? "rascunho";

        if ($nome === "" || $descricao === "" || $tecnologias === "") {
            $erro = "Preencha todos os campos obrigatorios.";
        } else {
            $link = $link_github !== "" ? $link_github : null;
            if ($id > 0) {
                $stmt = $pdo->prepare("update projetos set nome = :nome, descricao = :descricao, tecnologias = :tecnologias, link_github = :link, ano = :ano, status = :status where id = :id");
                $stmt->execute([":nome" => $nome, ":descricao" => $descricao, ":tecnologias" => $tecnologias, ":link" => $link, ":ano" => $ano, ":status" => $status, ":id" => $id]);
                registrar_log($pdo, "update", $id, "Projeto editado: $nome");
            } else {
                $stmt = $pdo->prepare("insert into projetos (nome, descricao, tecnologias, link_github, ano, status) values (:nome, :descricao, :tecnologias, :link, :ano, :status)");
                $stmt->execute([":nome" => $nome, ":descricao" => $descricao, ":tecnologias" => $tecnologias, ":link" => $link, ":ano" => $ano, ":status" => $status]);
                $id = (int) $pdo->lastInsertId();
                registrar_log($pdo, "insert", $id, "Projeto criado: $nome");
            }
            header("Location: admin.php?ok=salvo");
            exit;
        }
        $em_edicao = ["id" => $id, "nome" => $nome, "descricao" => $descricao, "tecnologias" => $tecnologias, "link_github" => $link_github, "ano" => $ano, "status" => $status];
    }

    if ($acao === "arquivar") {
        $id = (int) ($_POST["id"] ?? 0);
        if ($id > 0) {
            $stmt = $pdo->prepare("update projetos set status = \"arquivado\" where id = :id");
            $stmt->execute([":id" => $id]);
            registrar_log($pdo, "status", $id, "Status alterado para arquivado");
        }
        header("Location: admin.php?ok=arquivado");
        exit;
    }

    if ($acao === "desarquivar") {
        $id = (int) ($_POST["id"] ?? 0);
        if ($id > 0) {
            $stmt = $pdo->prepare("update projetos set status = \"rascunho\" where id = :id");
            $stmt->execute([":id" => $id]);
            registrar_log($pdo, "status", $id, "Status alterado para rascunho (desarquivado)");
        }
        header("Location: admin.php?ok=desarquivado");
        exit;
    }
}

if ($em_edicao === null && isset($_GET["editar"])) {
    $stmt = $pdo->prepare("select * from projetos where id = :id");
    $stmt->execute([":id" => (int) $_GET["editar"]]);
    $em_edicao = $stmt->fetch() ?: null;
}

$filtros_validos = ["todos", "rascunho", "publicado", "arquivado"];
$filtro = $_GET["filtro"] ?? "todos";
if (!in_array($filtro, $filtros_validos, true)) { $filtro = "todos"; }

$busca = trim($_GET["busca"] ?? "");

$contagem = $pdo->query("select status, count(*) as total from projetos group by status")->fetchAll(PDO::FETCH_KEY_PAIR);

if ($filtro === "todos") {
    if ($busca !== "") {
        $stmt = $pdo->prepare("select * from projetos where nome like :busca order by criado_em desc");
        $stmt->execute([":busca" => "%$busca%"]);
        $projetos = $stmt->fetchAll();
    } else {
        $projetos = $pdo->query("select * from projetos order by criado_em desc")->fetchAll();
    }
} else {
    if ($busca !== "") {
        $stmt = $pdo->prepare("select * from projetos where status = :s and nome like :busca order by criado_em desc");
        $stmt->execute([":s" => $filtro, ":busca" => "%$busca%"]);
        $projetos = $stmt->fetchAll();
    } else {
        $stmt = $pdo->prepare("select * from projetos where status = :s order by criado_em desc");
        $stmt->execute([":s" => $filtro]);
        $projetos = $stmt->fetchAll();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
</head>
<body>
<main>
     <?php require_once __DIR__ . "/includes/cabecalho.php"; ?> 
        <div class="header-admin-flex">
            <h1 class="titulo-secao">Painel Administrativo</h1>
            <a href="logs.php" class="btn-secundario">Ver Trilhas de Auditoria</a>
        </div>
        
        <div class="contadores box-info">
            <strong>Resumo:</strong> 
            Rascunho: <?php echo $contagem['rascunho'] ?? 0; ?> | 
            Publicado: <?php echo $contagem['publicado'] ?? 0; ?> | 
            Arquivado: <?php echo $contagem['arquivado'] ?? 0; ?>
        </div>

        <?php if (isset($_GET["ok"])): ?> 
            <div class="alerta-sucesso">Operacao realizada.</div> 
        <?php endif; ?>
        
        <h2 class="secao"><?php echo $em_edicao ? "Editar projeto" : "Novo projeto"; ?></h2>
        <form class="form_container" action="admin.php" method="post">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo (int) ($em_edicao["id"] ?? 0); ?>">
            <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($em_edicao["nome"] ?? ""); ?>" required>
            <textarea name="descricao" placeholder="Descricao" required><?php echo htmlspecialchars($em_edicao["descricao"] ?? ""); ?></textarea>
            <input type="text" name="tecnologias" placeholder="Tecnologias" value="<?php echo htmlspecialchars($em_edicao["tecnologias"] ?? ""); ?>" required>
            <input type="url" name="link_github" placeholder="Link GitHub" value="<?php echo htmlspecialchars($em_edicao["link_github"] ?? ""); ?>">
            <input type="number" name="ano" value="<?php echo (int) ($em_edicao["ano"] ?? date("Y")); ?>" required>
            <select name="status">
                <?php $st = $em_edicao["status"] ?? "rascunho"; 
                foreach (["rascunho", "publicado", "arquivado"] as $op): ?>
                    <option value="<?php echo $op; ?>" <?php echo $op === $st ? "selected" : ""; ?>><?php echo ucfirst($op); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn">Salvar</button>
        </form>

        <h2 class="secao">Projetos cadastrados</h2>
        <div class="busca-container">
            <form method="get" class="flex-busca">
                <input type="text" name="busca" placeholder="Buscar por nome" value="<?php echo htmlspecialchars($busca); ?>" class="flex-1">
                <select name="filtro">
                    <?php foreach ($filtros_validos as $op): ?>
                        <option value="<?php echo $op; ?>" <?php echo $op === $filtro ? "selected" : ""; ?>><?php echo ucfirst($op); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn">Pesquisar</button>
            </form>
        </div>

        <?php if (empty($projetos)): ?> <p>Nenhum projeto encontrado.</p>
        <?php else: ?>
            <table class="tabela-admin">
                <thead><tr><th>Nome</th><th>Ano</th><th>Status</th><th>Acoes</th></tr></thead>
                <tbody>
                    <?php foreach ($projetos as $p): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($p["nome"]); ?></td>
                            <td><?php echo (int) $p["ano"]; ?></td>
                            <td>
                                <?php 
                                $cor = match($p["status"]) { "publicado" => "#10b981", "arquivado" => "#ef4444", default => "#6b7280" };
                                ?>
                                <span style="background-color: <?php echo $cor; ?>; color: white; padding: 2px 8px; border-radius: 10px; font-size: 12px;"><?php echo ucfirst($p["status"]); ?></span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <a href="admin.php?editar=<?php echo (int) $p["id"]; ?>" class="btn-editar">Editar</a>
                                <?php if ($p["status"] !== "arquivado"): ?>
                                    <form action="admin.php" method="post" onsubmit="return confirm('Arquivar?');" class="form-inline-acao">
                                        <input type="hidden" name="acao" value="arquivar">
                                        <input type="hidden" name="id" value="<?php echo (int) $p["id"]; ?>">
                                        <button type="submit" class="btn-arquivar">Arquivar</button>
                                    </form>
                                <?php else: ?>
                                    <form action="admin.php" method="post" onsubmit="return confirm('Desarquivar este projeto?');" class="form-inline-acao">
                                        <input type="hidden" name="acao" value="desarquivar">
                                        <input type="hidden" name="id" value="<?php echo (int) $p["id"]; ?>">
                                        <button type="submit" class="btn-desarquivar">Desarquivar</button>
                                    </form>
                                <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php require_once __DIR__ . "/includes/rodape.php"; ?>
</main>
</body>
</html>