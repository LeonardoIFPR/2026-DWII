<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 03 - PHP Intro
  Autor      : Leonardo Garbuio
  Data       : 02/032026
-->
<?php
$cor_inicio = ($pagina_atual === "inicio")   ? "color: #f0b341; font-weight: bold;" : "color: #FF6B00;";
$cor_sobre = ($pagina_atual === "sobre")    ? "color: #f0b341; font-weight: bold;" : "color: #FF6B00;";
$cor_projetos = ($pagina_atual === "projetos") ? "color: #f0b341; font-weight: bold;" : "color: #FF6B00;";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="linha">
        <nav>
            <ul>
                <li class="nav_inicio">
                    <a href="index.php" style="<?= $cor_inicio ?>">INICIO</a>
                </li>
                <li class="nav_sobre">
                    <a href="sobre.php" style="<?= $cor_sobre ?>">SOBRE</a>
                </li>
                <li class="nav_projetos">
                    <a href="projetos.php" style="<?= $cor_projetos ?>">PROJETOS</a>
                </li>       
            </ul>
        </nav>
    </div>
</nav>
</body>
</html>
