<?php

    require './config.php';
    $u = $_POST['username'];
    $pass = $_POST['password'];
    $valider = $_POST['valider'];
    session_start();

    print("<center>Bonjour $u $pass $valider</center>");

    if (isset($valider)) {
        $req = $dbh->prepare('SELECT * from owner_table WHERE username=? and pass=? limit 1');
        $req->execute(array($u, $pass));
        $tab = $req->fetchAll();
        if (count($tab) == 0) {
            echo 'erreur aucun utilisateur';
        } else {
            $_SESSION["autoriser"] = "oui";
            $_SESSION["nom"] = "Maman ou Papa";
            header("location:session.php");
        }
    } else {
        echo "WESH il se passe quoi ?";
    }
?>