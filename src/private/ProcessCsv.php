<?php
namespace App;

class ProcessCsv {
    public function readAndSortCsv($inputFile, $outputFile) {
        $csvFile = fopen($inputFile, "r");
        if ($csvFile === false) {
            die("Erreur lors de l'ouverture du fichier CSV");
        }
        $users = [];
        while (($row = fgetcsv($csvFile, 1000, ",")) !== false) {
            if (count($row) < 1) {
                continue;
            }
            $combined = trim($row[0]);
            $parts = explode(";", $combined);
            if (count($parts) < 2) {
                continue;
            }

            $nom = trim($parts[0]);
            $ca = trim($parts[1]);
            if (!is_numeric($ca)) {
                continue;
            }

            $users[] = [
                'nom' => $nom,
                'ca' => floatval($ca)
            ];
        }
        fclose($csvFile);

        if (empty($users)) {
            die("Aucun utilisateur trouvé dans le fichier CSV.");
        }
        usort($users, function($a, $b) {
            return $b['ca'] <=> $a['ca'];
        });
        $sortedCsvFile = fopen($outputFile, "w");
        if ($sortedCsvFile === false) {
            die("Erreur lors de la création du fichier CSV");
        }
        fputcsv($sortedCsvFile, ['id', 'nom', 'chiffre_affaires']);
        foreach ($users as $id => $user) {
            fputcsv($sortedCsvFile, [$id + 1, $user['nom'], $user['ca']]);
        }

        fclose($sortedCsvFile);
        echo "Fichier CSV trié créé avec succès.\n";
    }
}
