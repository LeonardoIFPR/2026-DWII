<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 04 — PHP para Web: Formulários, GET e POST
  Autor      : Leonardo Garbuio
  Data       : 15/03/2026
  Caminho    : /workspaces/2026-DWII/index.php
-->
<?php 
$nome = "Leonardo";
$subtitulo = "2026 Repositorio - Desenvolvimento WEB-II";
$pagina_atual = "hub";  

$aulas = [
    [
        "numero" => "02",
        "nome" => "Apresentação Pessoal",
        "desc" => "Pagina estatica com HTML e CSS - foto de perfil e layout",
        "link" => "00_apresentacao/index.html",
        "conceitos" => ["HTML semântico", "CSS flexbox"]
    ],
    [
        "numero" => "03",
        "nome" => "Portfolio dinamico com PHP",
        "desc" => "Mini portfolio com includes e menu dinamico",
        "link" => "01_php-intro/index.php",
        "conceitos" => ["variaveis", "echo", "include", "foreach", "operador", "ternario"]
    ],
    [
        "numero" => "04",
        "nome" => "Formularios de contato",
        "desc" => "Formulario com validação no servidor, proteção XSS e padrão PRG",
        "link" => "02_formularios/contato.php",
        "conceitos" => ['$_post', 'validação', 'htmlspecialchars()', 'header()', 'exit']
    ],
    [
        "numero" => "05",
        "nome" => "Catalogo de tecnologias",
        "desc" => "Conexão com banco de dados via PDO, listagem dinâmica de registros e página de detalhe com consulta de parametros",
        "link" => "03_pdo/index.php",
        "conceitos" => ['PDO', 'prepare()', 'fetchAll()', 'filter_input()']
    ],
    [
        "numero" => "06",
        "nome" => "Login e autenticação",
        "desc" => "Login para area restrita com proteção de dados e proteção contra força bruta simples",
        "link" => "04_sessoes/publico.php",
        "conceitos" => ['timer()', 'session_start()', 'session_unset()', 'session_destroy()', 'auth.php']
    ],
    [
        "numero" => "07",
        "nome" => "Login e autenticação",
        "desc" => "Login para area restrita com proteção de dados e proteção contra força bruta simples",
        "link" => "05_crud/index.php",
        "conceitos" => ['timer()', 'session_start()', 'session_unset()', 'session_destroy()', 'auth.php']
    ],
    [
        "numero" => "08",
        "nome" => "Cadastro de Projetos",
        "desc" => "Cadastro simples de projetos realizados contendo link github, titulo e etc",
        "link" => "05_crud/index.php",
        "conceitos" => ['timer()', 'session_start()', 'session_unset()', 'session_destroy()', 'auth.php']
    ],
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subtitulo); ?></title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <header>
        <div class="hdr-tag">IFPR &mdash; DWII &mdash; 2026</div>
        <h1 class="hdr-nome">LEO<span>N</span>ARDO</h1>
        <p class="hdr-sub">Desenvolvimento Web II &mdash; Repositório de Aulas</p>
        <div class="hdr-dots">
            <span class="ativo"></span>
            <span></span><span></span><span></span><span></span>
        </div>
    </header> 

    <div class="container">
        <div class="box-info" style="margin-top: 0;">
            <h3>Como executar este repositorio</h3>
            <p style="font-size: 14px; color: #375151;">
                suba o servidor PHP na <strong>raiz</strong> para acessar todas as aulas
            </p>
            <div style="background: #010000; color: #a8e6a3; padding: 10px 16px; border-radius: 6px; margin-top: 10px; font-family: monospace; font-size: 13px; line-height: 1.8;">
                cd ~/workspace/2026-DWII<br>php -S localhost:8000
            </div>
            <p style="font-size: 13px; color: #6b7280; margin-top: 8px;">
                Esta pagina é o HUB de navegação. Use os botões abaixo para acessar cada projeto
            </p>
        </div>

        <h2 class="secao">Projeto das aulas</h2>

        <?php foreach ($aulas as $aula): ?>

        <div class="card-aula">
            <div class="numero"><?php echo htmlspecialchars($aula["numero"]); ?></div>

            <div class="conteudo">
                <span class="badge">Aula <?php echo htmlspecialchars($aula["numero"]); ?></span>

                <h3><?php echo htmlspecialchars($aula["nome"]); ?></h3>

                <p><?php echo htmlspecialchars($aula["desc"]); ?></p>

                <div class="tags">
                    <?php foreach ($aula["conceitos"] as $conceito): ?>
                        <span class="tag"><?php echo htmlspecialchars($conceito); ?></span>
                    <?php endforeach; ?>
                </div>

                <a href="<?php echo htmlspecialchars($aula["link"]); ?>" class="btn">ABRIR &rarr;</a>
            </div>
        </div>

        <?php endforeach; ?>

        <p style="font-size: 13px; color: #9ca3af; margin-top: 8px;">
            gerado em <?php echo date("d/m/Y \a\s H:i:s"); ?>
        </p>
    </div>

    <footer>
        <?php echo htmlspecialchars($nome); ?>
        &copy; <?php echo date("Y"); ?>
        | Desenvolvido com PHP | IFPR - PONTA GROSSA
    </footer>
</body>
</html>