<?php
$csvFile = fopen("../sorted_data.csv", "r");
if ($csvFile === false) {
    die("Erreur lors de l'ouverture du fichier CSV trié");
}

echo "<table border='1'>";
echo "<tr><th>Classement</th><th>Nom</th><th>Chiffre d'affaires</th></tr>";

$classement = 1;
fgetcsv($csvFile);
while (($row = fgetcsv($csvFile, 1000, ",")) !== false) {
    $nom = $row[1];
    $ca = $row[2];
    echo "<tr><td>$classement</td><td>$nom</td><td>$ca</td></tr>";

    $classement++;
}

echo "</table>";
fclose($csvFile);
?>
