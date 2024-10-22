<?php
$dsn = 'mysql:host=localhost;dbname=testdb;charset=utf8';
$user = 'root';
$password = '';
try {
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   $pdo = new PDO($dsn, $user, $password);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connexion réussie à la base de données<br>";
   $csvPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'sorted_data.csv';
   echo "Chemin du fichier CSV : " . $csvPath . "<br>";
   if (!file_exists($csvPath)) {
       throw new Exception("Le fichier CSV n'existe pas à l'emplacement : " . $csvPath);
   }
   $csvFile = fopen($csvPath, "r");
   if ($csvFile === false) {
       throw new Exception("Impossible d'ouvrir le fichier CSV");
   }
   fgetcsv($csvFile);
   $count = 0;
   $pdo->beginTransaction();

   try {
       while (($row = fgetcsv($csvFile, 1000, ",")) !== false) {
           if (count($row) >= 3) {
               $id = intval($row[0]);
               $nom = $row[1];
               $ca = floatval($row[2]);

               $stmt = $pdo->prepare("INSERT INTO utilisateurs (id, nom, ca) VALUES (?, ?, ?)");
               $stmt->execute([$id, $nom, $ca]);
               $count++;
           }
       }
       $pdo->commit();
       fclose($csvFile);
       echo "<br>Importation réussie : $count lignes ont été insérées dans la base de données";

   } catch (Exception $e) {
       $pdo->rollBack();
       fclose($csvFile);
       throw new Exception("Erreur lors de l'insertion des données : " . $e->getMessage());
   }

} catch (Exception $e) {
   die("<br>Erreur : " . $e->getMessage());
}
?>