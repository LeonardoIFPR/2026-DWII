<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 04 — PHP para Web: Formulários, GET e POST
  Autor      : Leonardo Garbuio
  Data       : 15/03/2026
  Caminho    : /workspaces/2026-DWII/includes/rodape.php
-->
<?php 
$autor = isset($nome) ? htmlspecialchars($nome) : "Portfolio";
?>

<link rel="stylesheet" href="<?php echo $caminho_raiz; ?>includes/style.css">
<footer>
    <?php echo $autor; ?>
    &copy; <?php echo date("Y"); ?>
    | Desenvolvido com PHP
    | IFPR - Ponta Grossa
</footer>
