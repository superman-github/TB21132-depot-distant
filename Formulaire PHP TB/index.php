<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<!-- ***************************************************-->
<!-- **********     PAGE ACCUEIL -> INDEX    ********** -->
<!-- ***************************************************-->

<body>    

<h1>Détail des stations</h1>

<?php

    //connection à la BDD
    try{        
        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=hotel', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //message si erreur de connection à la BDD
    catch (Exception $e) {
        echo "La connection à la base e données a échoué ! <br>";
        echo "Merci de bien vérifier vos paramètres de connection ...<br>";
        echo "Erreur : " . $e->getMessage() . "<br>";
        echo "N° : " . $e->getCode(). "<br>";
        die("Fin du script");
    }       

    //construction de notre requête

    //sélectionne toutes les informations de la table 'station'

    $requete = "SELECT * FROM station";

    //exécution de la requête
    $result = $db->query($requete);

    //$result->rowCount() : permet de renvoyer le nombre de lignes renvoyées par une requête
    //var_dump("nombre de lignes retournées par la requête : ".$result->rowCount());

    //**********     Rappel  **********//

    //si la requête renvoit un seul et unique résultat, on ne fait pas de boucle !
    // $row = $result->fetch(PDO::FETCH_OBJ);

    //dans la mesure où il y a un retour de plusieurs enregistrements, 
    //il faut inclure le résultat dans une boucle

    //récupère, ligne par ligne, les informations attendues, que l'on doit inclure dans notre page HTML ...

    while ($row = $result->fetch(PDO::FETCH_OBJ)) 
    {     
?>

     <div> 
          <?php  echo $row->sta_nom." ".$row->sta_altitude;?>          
     </div>

<?php
}
     // sert à finir proprement une série de fetch(),
     //libère la connection au serveur de BDD

     $result->closeCursor();
     
?>

<br>
<a href="ajout.php"><button> Créer un nouvel enregistrement</button></a>

</body>
</html>