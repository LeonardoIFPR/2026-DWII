<?php  
function conectar(): PDO
{
    $dsn = "mysql:host=127.0.0.1;dbname=portfolio;charset=utf8mb4";
    $usuario = "root";
    $senha = "dwii2026";

    try {
        $pdo = new PDO($dsn, $usuario, $senha, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro de conexão verifique o banco");
    }
}
