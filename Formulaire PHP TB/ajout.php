<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<!-- ******************************************************-->
<!-- **********     PAGE FORMULAIRE ->   AJOUT  ********** -->
<!-- ******************************************************-->

<body>
<br>
<a href="index.php"><button>Retour à l'accueil</button></a>
    
<h1>Mon formulaire d'ajout</h1>


<form action="script_ajout.php" method="post">

    <!-- *****     nom de la station      ***** -->
    <label for="input_nom">Nom de la station : </label>
    <input type="text" name="nom_station" id="input_nom" value="<?php if(isset($_POST['nom_station'])) echo $_POST['nom_station'] ?>"><br><br>

    <!-- *****     message erreur pour le nom de la station      ***** -->
    <span>
    <?php if (isset($_POST['erreur_nom'])) echo $_POST["erreur_nom"] ?>
    </span><br><br>

    <!-- *****     altitude de la station      ***** -->
    <label for="input_altitude">Altitude de la station : </label>
    <input type="text" name="altitude_station" id="input_altitude" value="<?php if(isset($_POST['altitude_station'])) echo $_POST['altitude_station'] ?>"><br><br>

    <!-- *****     message erreur pour l'altitude de la station      ***** -->
    <span>
    <?php if (isset($_POST['erreur_altitude'])) echo $_POST["erreur_altitude"] ?>
    </span><br><br>
    <input type="submit" name="envoi" > &nbsp;
    <input type="reset" name="annuler" value="Annuler">

</form>

</body>
</html>