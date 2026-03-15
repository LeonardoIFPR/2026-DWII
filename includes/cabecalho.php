<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 04 — PHP para Web: Formulários, GET e POST
  Autor      : Leonardo Garbuio
  Data       : 15/03/2026
  Caminho    : /workspaces/2026-DWII/includes/cabecalho.php
-->
<?php 
if (!isset($titulo_pagina)) $titulo_pagina = "Portfolio DWII";
if (!isset($caminho_raiz)) $caminho_raiz = "../";
?>

<link rel="stylesheet" href="<?php echo $caminho_raiz; ?>includes/style.css">
    
<?php include __DIR__ . "/nav.php"; ?>
