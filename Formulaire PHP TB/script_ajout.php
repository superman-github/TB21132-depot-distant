<?php 

//détermine si la variable $_POST['envoi'] est définie
//en l'occurence, si oui, signifie que 

/****************************************/
/*****  le formulaire a été soumis  *****/
/****************************************/

if (isset($_POST['envoi'])){        

        //booléen pour la vérification du formulaire
        $verif_form=true;   

        //vérifie si le nom de la station est renseigné ou non
        //si vide
         if(empty ($_POST['nom_station']))
        {
            $_POST['erreur_nom'] = "Veuillez renseigner le nom de la station !";
            $verif_form=false;
        }       
        //vérifie la pertinence du nom de la station saisi
        else if(!preg_match("/^[a-z]+$/",($_POST['nom_station'])))
        {
            $_POST['erreur_nom'] = "Veuillez renseigner correctement le nom de la station !";
            $verif_form=false;
        }

        //vérifie si l'altitude de la station est renseignée ou non
        //si vide
        if(empty ($_POST['altitude_station']))
        {
            $_POST['erreur_altitude'] = "Veuillez renseigner l'altitude de la station !";
            $verif_form=false;
        }       
        //vérifie la pertinence de l'altitude de la station saisie
        else if(!preg_match("/^[0-9]+$/",($_POST['altitude_station'])))
        {
            $_POST['erreur_altitude'] = "Veuillez renseigner correctement l'altitude de la station !";
            $verif_form=false;
        }        

        
        /**********************************************/
        /*****  le formulaire n'est pas valide !  *****/
        /**********************************************/

        if($verif_form==false){

            //on exécute le fichier ajout.php
            include_once("ajout.php");         
        }


        /*********************************************/
        /*****    le formulaire est  valide !    *****/
        /*********************************************/

        //si OK on se connecte à la BDD 
        //puis insertion du nouvel enregistrement
        else{     

            //connection à la BDD
            try{        
                $db = new PDO('mysql:host=localhost;charset=utf8;dbname=hotel', 'root', '');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            //message si erreur de connection à la BDD 
            catch (Exception $e) {
                echo "Erreur : " . $e->getMessage() . "<br>";
                echo "N° : " . $e->getCode();
                die("Fin du script");
            }  

            //construction de la requête INSERT sans injection SQL

            $requete = $db->prepare("INSERT INTO station (sta_nom,sta_altitude) VALUES (:sta_nom,:sta_altitude)");

            $requete->bindValue(':sta_nom', $_POST['nom_station'], PDO::PARAM_STR);
            $requete->bindValue(':sta_altitude', $_POST['altitude_station'], PDO::PARAM_INT);

            //exécution de la requête
            $requete->execute();

            //libère la connection au serveur de BDD
            $requete->closeCursor();

            //redirection vers la page index.php
            header("Location: index.php");
                    
        }        
}

/******************************************/
/*****le formulaire n'a pas été soumis*****/
/******************************************/

else{

    //si le formulaire n'est pas soumis
    //c'est à dire si on accède directement par l'url ...
    //   127.0.0.1/essai php tb/script_ajout.php

    //on redirige vers le formulaire

    // header("Location:ajout.php");
    // exit;//arrêt du code

    //ou on affiche le code html ci-dessous :

?>
               
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>

        <body>           

        <h1>Script ajout</h1>

        <h2>Le formulaire n'a pas été soumis !</h2>

        </body>
        </html>

<?php
}
?>