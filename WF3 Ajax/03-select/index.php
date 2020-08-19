<?php

require_once "dbconnect.php";

// Définition de la requete
$sql = "SELECT * FROM `departement`";
// Execution de la requete
$response = $db->query($sql);
// Recupération des résultats
$departements = $response->fetchAll(PDO::FETCH_OBJ);


// Définition de la requete
$sql = "SELECT * FROM `villes_france_free` WHERE `ville_departement` = 59 ORDER BY `ville_nom` ASC" ;
// Execution de la requete
$response = $db->query($sql);
// Recupération des résultats
$villes = $response->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Villes</title>
    </head>
    <body>
        <h2>Afficher la liste des départements: </h2>    
        <div>
            <select name="departement" id="departement">
                <option value="">Choisir le departement</option>
                <?php foreach($departements as $departement){
                    echo "<option value=\"$departement->departement_code\">$departement->departement_nom</option>";} ?>
                <hr>
            </select>


            <h2>Afficher la liste des villes: </h2> 
            <ul id="cities"></ul>
            

            <hr>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            $('#departement').on ('change', function (){
                //On récupere le departement choisi
                var departement = $(this).val(); 
                //On supprime les villes existantes
                $('#cities').empty();
                //On récupére les villes du département en AJAX
                $.get('./worker.php?id='+departement).done(function(cities){
                    //On parcourt les villes pour les afficher dans le DOM
                    for (city of cities){
                        var li = $('<li></li>');
                        li.html(city.ville_nom_reel);
                        $('#cities').append(li);
                    }
                    
                    //On écoute le click sur une ville
                    $('#cities li').on('clik', function (event){
                        console.log($(this));
                    });
                });
            });

            
        </script>
    </body>
</html>