<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$pagina_atual  = 'inicio';
$caminho_raiz  = './';
$titulo_pagina = 'Portfólio — Leonardo';


$nome      = 'LEONARDO';
$descricao = "Melhor estudante do IFPR com ampla experiência em todas as áreas da tecnologia. Estudo no IFPR desde 2023.";
$email     = '20241ctb0100029@escola.ifpr.edu.br';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/index_css.css">
    <title>Apresentação de <?php echo htmlspecialchars($nome); ?></title>
</head>
<body>
    <main>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
        <div class="topo">
            <div class="cor_da_margem">
                <img src="images/pikachu.webp" alt="minha foto">
            </div>

            <div class="topo_texto">
                <p class="faixa">&#9733; Disciplina WEB II &#9733;</p>
                <h1>MEU NOME É</h1>
                <h1><span class="nome"><?php echo htmlspecialchars($nome); ?> GARBUIO</span></h1>
                <p>Estudante do IFPR &bull; Técnico em Informática &bull; Desde 2023</p>
            </div>
        </div>

        <div class="sobre_mim">
            <p><?php echo htmlspecialchars($descricao); ?></p>
        </div>

        <ul class="blocos">
            <div class="box1">
                <li>
                    <p>Estudante do ensino médio técnico integrado em informática</p>
                </li>
            </div>
            <div class="box2">
                <li>
                    <p>IFPR Instituto Federal do Paraná</p>
                </li>
            </div>
            <div class="box3">
                <li>
                    <p>Tecnologia da Informação e Desenvolvimento</p>
                </li>
            </div>
            <div class="box4">
                <li>
                    <p>Estudando no IFPR desde 2023</p>
                </li>
            </div>
        </ul>

        <footer>
            <p class="footer">&copy; 2025 <?php echo htmlspecialchars($nome); ?> &bull; IFPR &bull; TECNICO EM INFORMATICA &bull; <?php echo htmlspecialchars($email); ?></p>
        </footer>

    </main>
</body>
</html>