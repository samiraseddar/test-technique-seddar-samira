<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
$servername = getenv("MYSQL_HOST");
$username = getenv("MYSQL_USER");
$password = getenv("MYSQL_PASSWORD");
$dbname = getenv("MYSQL_DATABASE");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie".PHP_EOL;
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
    
}
?>