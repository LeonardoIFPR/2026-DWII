<?php
$nome = "LEONARDO GARBUIO";
$curso = "Técnico em Informática";
$escola = "IFPR"
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>portfolio</title>
</head>
<body>
    <main>
        <?php include 'includes/cabecalho.php'; ?>

        <div class="topo">
            <div class="cor_da_margem">
                <img src="imgs/pikachu.webp" alt="minha foto">
            </div>

            <div class="topo_texto">
                <p class="faixa">
                <h1>MEU NOME É</h1>
                <h1><span class="nome"><?php echo $nome; ?></span></h1>
                <p>Estudante do <?php echo $escola; ?> &bull; <?php echo $curso; ?> &bull; Desde 2023</p>
            </div>
        </div>

        <div class="sobre_mim">
            <p>Melhor estudante do IFPR com ampla experiência em todas as áreas da tecnologia. Estudo no IFPR desde 2023.</p>
        </div>

        <ul class="blocos">
            <div class="box1">
                <li>
                    <p>Estudante do ensino médio <?php echo $curso; ?></p>
                </li>
            </div>
            <div class="box2">
                <li>
                    <p><?php echo $escola; ?> Instituto Federal do Paraná</p>
                </li>
            </div>
            <div class="box3">
                <li>
                    <p>Tecnologia da Informação e Desenvolvimento</p>
                </li>
            </div>
            <div class="box4">
                <li>
                    <p>Estudando no <?php echo $escola; ?> desde 2023</p>
                </li>
            </div>
        </ul>

        <?php include 'includes/rodape.php'; ?>

    </main>
</body>
</html>