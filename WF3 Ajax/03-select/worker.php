<?php
header('Content-Type: application/json');

require_once __DIR__ . '/dbconnect.php';
// Définition de la requete
$sql = "SELECT * FROM `villes_france_free` WHERE `ville_departement` =" .$_GET['id'] ;
// Execution de la requete
$response = $db->query($sql);
// Recupération des résultats
$villes = $response->fetchAll(PDO::FETCH_OBJ);

echo json_encode ($villes);

// foreach($villes as $ville): {
//     echo $ville->ville_nom_reel .'<br/>';}