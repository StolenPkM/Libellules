<?php

    require './config.php';
    $u = $_POST['username'];
    $pass = $_POST['password'];
    $valider = $_POST['valider'];

    print("<center>Bonjour $u $pass $valider</center>");

    try {
            $dbh = new PDO($dsn, $user, $password, $options);
            echo "connexion OK!";

        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
    };


    if (isset($valider)) {
        $req = $dbh->prepare('SELECT * from owner_table WHERE username=? and pass=? limit 1');
        $req = setFetchMode(PDO::FETCH_ASSOC);
        $req->execute(array($u, $pass));
        $tab = $req->fetchAll();
        if (count($tab) == 0) {
            echo 'erreur aucun utilisateur';
        } else {
            echo 'bienvenue!' . $tab[0]["username"] . " " . $tab[0]["pass"] ;
        }
    } else {
        echo "WESH il se passe quoi ?";
    }
?>