<?php

require_once "private/config.php";

try {
    $stmt = $conn->query('SELECT id, nom, ca, attainment_rate FROM utilisateurs');
    $rankings = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Classement des utilisateurs par chiffre d'affaires</h1>
    <table border="1">
        <tr>
            <th>Utilisateur</th>
            <th>Chiffre d'affaires</th>
            <th>Classement</th>
            <th>Taux d'atteinte (%)</th>
        </tr>
        <?php
        $rank = 1;
        foreach ($rankings as $ranking): ?>
        <tr>
            <td><?= htmlspecialchars($ranking['nom']) ?></td>
            <td><?= number_format($ranking['ca'], 2) ?> €</td>
            <td><?= $rank ?></td>
            <td><?= number_format($ranking['attainment_rate'], 2) ?>%</td>
        </tr>
        <?php
        $rank++;
        endforeach;
        ?>
    </table>
</body>
</html>