<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 03 - PHP Intro
  Autor      : Leonardo Garbuio
  Data       : 02/03/2026
-->
<?php include 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Projetos · <?php echo $nome; ?></title>
</head>
<body>
    <main>
        <?php include 'includes/cabecalho.php'; ?>

        <div class="linha">
            <p class="faixa">&#9733; MEUS PROJETOS &#9733;</p>
            <h1>O QUE EU <span class="nome">DESENVOLVI</span></h1>
            <p>Trabalhos feitos na disciplina de Desenvolvimento Web II &bull; <?php echo $escola; ?></p>
        </div>

        <?php
        $projetos = [
            [
                "titulo" => "Apresentação WEB II",
                "desc" => "pagina de apresentação pessoal com PHP animações CSS e includes.",
                "github" => "https://github.com/LeonardoIFPR/2026-DWII.git"
            ],
            [
                "titulo" => "AppTemplate2026",
                "desc" => "começa do aplicativo que faremos com o professor jailton.",
                "github" => "https://github.com/LeonardoIFPR/AppTemplate2026.git"
            ],
            [      
                "titulo" => "Site 3D para uma loja online",
                "desc" => "Site 3D desenvolvido com HTML, CSS, JS e  Three.js(é oq faz os efeitos 3D).",
                "github" => "https://github.com/LeonardoGarbuio/ProjetoThiago"                
            ],
            [
                "titulo" => "PRIME-AI",
                "desc" => "Plataforma SaaS full-stack alimentada por Inteligência Artificial, construída com Next.js, Tailwind e Supabase (e mais algumas coisinhas que não da tempo de citar).",
                "github" => "https://github.com/LeonardoGarbuio/Prime_ai.git"
            ],
        ];
        ?>

        <ul class="blocos">
            <?php foreach ($projetos as $p): ?>
            <div class="box1 animacao_entrada">
                <li>
                    <p class="titulo_projetos"><?php echo $p['titulo']; ?></p>
                    <p class="descricao_projetos"><?php echo $p['desc']; ?></p>
                    <a href="<?php echo $p['github']; ?>" target="_blank">GitHub &rarr;</a>
                </li>
            </div>
            <?php endforeach; ?>
        </ul>

        <?php include 'includes/rodape.php'; ?>
    </main>
</body>
</html>


