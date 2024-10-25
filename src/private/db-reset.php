<?php
require_once 'config.php';

try {
    $sql = "DROP TABLE IF EXISTS utilisateurs";
    $conn->exec($sql);
    echo "Table utilisateurs supprimée avec succès.<br>";

    $sql = "CREATE TABLE utilisateurs (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nom VARCHAR(255),
        ca DECIMAL(10, 2),
        attainment_rate DECIMAL(10, 2)
    )";
    
    $conn->exec($sql);
    echo "Table utilisateurs recréée avec succès.<br>";

} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>
