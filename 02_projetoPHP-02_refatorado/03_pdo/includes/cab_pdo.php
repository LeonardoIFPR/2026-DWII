<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 05 — PHP + MariaDB: persistencia de dados via PDO
  Autor      : Leonardo Garbuio
  Data       : 21/03/2026
  Caminho    : /workspaces/2026-DWII/03_pdo/includes/cab_pdo.php
-->
<?php 
if(!isset($titulo_pagina)) $titulo_pagina = "Catalogo de Tecnologias";
if(!isset($pagina_atual)) $pagina_atual = "";

$caminho_raiz = "../";

include __DIR__ . "/../../includes/cabecalho.php";
?>