<?php
$dsn = 'mysql:host=localhost;dbname=testdb;charset=utf8';
$user = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
    $stmt = $pdo->query('SELECT id, nom, ca, attainment_rate FROM utilisateurs');
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
