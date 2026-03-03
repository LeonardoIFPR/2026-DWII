<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 03 - PHP Intro
  Autor      : Leonardo Garbuio
  Data       : 02/032026
-->
<?php
$nome = "LEONARDO GARBUIO";
$curso = "Técnico em Informática";
$escola = "IFPR"

/* então eu li um pouco e descobri o problema quanto as variaveis aparecerem no "index" e no "sobre" não é basicamente onde defini as variaveis como elas estão no index ele consegue puxar ja no sobre como não tem as variaveis definidas ele não consegue puxar
arrumaria somente colocar as variaveis no arquivo sobre assim como estão no index mas como o objetivo da tarefa era usar os includes para evitar a repetição optei por fazer um arquivo php novo com as variaveis agora que esse arquivo ja existe (config.php) 
é so colocar esta instrução "<?php include 'includes/config.php'; ?>" no inicio das paginas que as variaveis serão usadas fazendo isso evitamos repetição de codigo e arruma o problema de sobre estar sem as informações */
?>


