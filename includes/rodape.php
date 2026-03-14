<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 03 - PHP Intro
  Autor      : Leonardo Garbuio
  Data       : 02/03/2026
  pagina     : DWII - includes - rodape
-->
<?php 
$autor = isset($nome) ? htmlspecialchars($nome) : "Portfolio";
?>

<footer>
    <?php echo $autor; ?>
    &copy; <?php echo date("Y"); ?>
    | Desenvolvido com PHP
    | IFPR - Ponta Grossa
</footer>
