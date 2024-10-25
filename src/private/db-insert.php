<?php
require_once 'config.php';

try {
   $csvPath = __DIR__.'/sorted_data.csv';
   echo "Chemin du fichier CSV : " . $csvPath . "<br>";
   if (!file_exists($csvPath)) 
       throw new Exception("Le fichier CSV n'existe pas à l'emplacement : " . $csvPath);
   
   $csvFile = fopen($csvPath, "r");
   if ($csvFile === false) {
       throw new Exception("Impossible d'ouvrir le fichier CSV");
   }
   fgetcsv($csvFile);
   $count = 0;
   $conn->beginTransaction();

   try {
    $objectives = [
        "Mathilde" => 12300,
        "Jacque" => 8000,
        "Vincent" => 18921,
        "Ahcene" => 13111,
        "Kevin" => 9432,
        "Sofiane" => 6500,
        "Sandra" => 14000
    ];
    
       while (($row = fgetcsv($csvFile, 1000, ",")) !== false) {
           if (count($row) >= 3) {
               $id = intval($row[0]);
               $nom = $row[1];
               $ca = floatval($row[2]);
               $attainment_rate = round(($ca / $objectives[$nom]) * 100, 2);
               echo "$attainment_rate";
               $stmt = $conn->prepare("INSERT INTO utilisateurs (id, nom, ca,attainment_rate) VALUES (?, ?, ?,?)");
               $stmt->execute([$id, $nom, $ca, $attainment_rate]);
               $count++;
           }
       }
       $conn->commit();
       fclose($csvFile);
       echo "<br>Importation réussie : $count lignes ont été insérées dans la base de données";

   } catch (Exception $e) {
       $conn->rollBack();
       fclose($csvFile);
       throw new Exception("Erreur lors de l'insertion des données : " . $e->getMessage());
   }

} catch (Exception $e) {
   die("<br>Erreur : " . $e->getMessage());
}
?>
