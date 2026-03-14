<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 03 - PHP Intro
  Autor      : Leonardo Garbuio
  Data       : 02/032026
-->
<?php 
if (!isset($titulo_pagina)) $titulo_pagina = "Portfolio DWII";
if (!isset($caminho_raiz)) $caminho_raiz = "../";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo_pagina); ?></title>
    <link rel="stylesheet" href="<?php echo $caminho_raiz; ?> includes/style.css">
    <?php include __DIR__ . "/nav.php"; ?>
</head>
<body>
</body>
</html>