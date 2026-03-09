<?php 
$nome = "Leonardo";
$subtitulo = "2026 Repositorio - Desenvolvimento WEB-II";

$aulas = [
    [
        "numero" => "02",
        "nome" => "Apresentação Pessoal",
        "desc" => "Pagina estatica com HTML e CSS - foto de perfil e layout",
        "link" => "00_apresentação/index.html",
        "icone" => "🧑🏻‍💻",
        "cor" => "#FF6B00",
        "conceitos" => "HTML sêmantico e CSS flexbox"
    ],
    
    [
        "numero" => "03",
        "nome" => "Portfolio dinamico com PHP",
        "desc" => "Mini portfolio com includes e menu dinamico",
        "link" => "01_php-intro/index.php",
        "icone" => "👨🏻‍✈️",
        "cor" => "#FF6B00",
        "conceitos" => "variaveis, echo, include, foreach, operador, ternario"
    ],

    [
        "numero" => "04",
        "nome" => "Formularios de contato",
        "desc" => "Formulario com validação no servidor, proteção XSS e padrão PRG",
        "link" => "02_formularios/contato.php",
        "icone" => "🥷🏻",
        "cor" => "#FF6B00",
        "conceitos" => '$_post, validação, htmlspecialchars(), header() + exit'
    ],

];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subtitulo); ?></title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($nome); ?></h1>
        <p><?php echo htmlspecialchars($nome); ?><p>
    </header>    

    <div class="container">
        <div class="box-info" Style="margin-top: 0;">
            <h3>Como executar este repositorio</h3>
            <p style="font-size: 14px; color: #375151">
                suba o servidor PHP na <strong>raiz</strong> para acessar todas as aulas
            </p>
            <div style="background: #010000; color #a8e6a3; padding:10px 16px; border-radius: 6px; margin-top: 10px; font-family: 'arial'; font-size: 13px; line-heigt: 1.8">
                cd ~/workspace/2026-DWII<br>php -S localhost:8000
            </div>
            <p style="font-size: 13px; color: #6b7280; margin-top: 8px;">
                Esta pagina é o HUB de navegação, Use os botões abaixo para acesssar cada projeto
            </p>
        </div>
        <h2 class=""secao>Projeto das aulas</h2>

        <?php foreach ($aulas as $aula): ?>

        <div class="card-aula">
            <div class="icone"><?php echo $aula["icone"]; ?></div>

            <div class="conteudo">
                <span class="badge">Aula <?php echo htmlspecialchars ($aula["numero"]); ?></span>

                <h3>
                    <?php echo htmlspecialchars($aula["nome"]); ?>
                </h3>

                <p><?php echo htmlspecialchars($aula["desc"]); ?></p>

                <span clss="conceitos">
                    <?php echo htmlspecialchars($aula["conceitos"]); ?>
                </span><br>

                <a href="<?php echo htmlspecialchars($aula["link"]) ?>" class="btn" style="background <?php echo $aula["cor"]; ?>">Abrir &rarr;</a>
            </div>
        </div>

            <?php endforeach; ?>

            <p style="text-align: rigth; font-size: 13px; color: #9ca3af; margin-top: 8px">
                gerado em <?php echo date("d/m/Y a\s H:i:s") ?>
            </p>
    </div>

    <footer>
        <?php echo htmlspecialchars($nome); ?>
        &copy; <?php echo date("Y"); ?>
        | Desenvolvido com PHP | IFPR - PONTA GROSSA
    </footer>

    
</body>
</html>