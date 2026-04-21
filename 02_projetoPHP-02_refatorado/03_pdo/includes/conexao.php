<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 05 — PHP + MariaDB: persistencia de dados via PDO
  Autor      : Leonardo Garbuio
  Data       : 21/03/2026
  Caminho    : /workspaces/2026-DWII/03_pdo/includes/conexao.php
-->
<?php 
$host = "127.0.0.1";
$db = "dwii_db";
$user = "dwii_user";
$pass = "dwii2026";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;sslmode=disabled";

$opcoes = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

    PDO::ATTR_EMULATE_PREPARES => false

];

try {
    $pdo = new PDO($dsn, $user, $pass, $opcoes);
} catch (PDOException $e) {
    die("erro de conexão com o banco de dados");
}
?>