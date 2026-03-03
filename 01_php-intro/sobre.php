<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 03 - PHP Intro
  Autor      : Leonardo Garbuio
  Data       : 02/032026
-->
<?php include 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfolio de <?php echo'nome'; ?></title>
</head>
<body>
    <main>
        <?php include 'includes/cabecalho.php'; ?>
               
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