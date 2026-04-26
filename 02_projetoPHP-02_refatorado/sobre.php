<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 09 — codigo PHP refatorado mudando o arquivo "sobre" para a raiz
  Autor      : Leonardo Garbuio
  Data       : 26/04/2026
  Caminho    : /workspaces/2026-DWII/02_projetoPHP-02_refatorado/sobre.php
-->
<?php include "includes/config.php"; 
$nome = "Leonardo";
$pagina_atual = "sobre";
$caminho_raiz = "./";
$titulo_pagina = "Portfolio - {$nome}";
$formacoes = ["cursando tecnico em informatica"]
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfolio de <?php echo $nome; ?></title>
</head>
<body>
    <main>
        <?php include "includes/cabecalho.php"; ?>
               
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
                    <p><?php echo $formacoes[0] ;?></p>
                </li>
            </div>
            <div class="box4">
                <li>
                    <p>Estudando no <?php echo $escola; ?> desde 2024</p>
                </li>
            </div>
        </ul>

        
        <?php include "includes/rodape.php"; ?>
    </main>
</body>
</html>