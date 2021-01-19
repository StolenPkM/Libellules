<?php
    session_start();
    if($_SESSION["autoriser"] != "oui") {
        header("location:../../nav/villa/admin.php");
        exit();
    };
    require './config.php';

    $requete = $dbh->prepare("SELECT * FROM reservation_villa");
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_ASSOC);
    $requete->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/mystyles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/session.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <title>Admin Session</title>
</head>
<body>
        <!-- Header -->
    <div class="block">
        <header class="header">
            <a  class="header-logo" href="../../index.html">Logo</a>
            <nav class="header-menu">
                <a href="../../nav/villa/villa.html">Aperçu</a>
                <a href="../../nav/villa/photos.php">Photos</a>
                <a href="../../nav/villa/calendar.php">Planning</a>
                <a href="#">Contact</a>
                <a href="#">
                    <i class="fas fa-user-lock"></i>
                </a>
            </nav>
        </header>
    </div>
    <!-- Header -->
    
    <div class="block">
        <h1 class="title first-title">Bienvenue <?= $_SESSION["nom"]?></h1>
        <h3>Voici les reservations actuelle de la maison:</h3>
        <table class="all_reservation">
            <tr>
                <th>Nom</th>
                <th>Date entrée</th>
                <th>Date sortie</th>
            </tr>
            <?php foreach($result as $r): ?>
                <tr>
                    <td><?= $r['nom'] ?></td>
                    <td><?= $r['entry_date'] ?></td>
                    <td><?= $r['out_date'] ?></td>
                    <td>
                        <a href="../admin/delete.php?id=<?= $r['id'] ?>" onclick="return confirm('Es-tu sur de vouloir supprimer cette reservation?')"><p>x</p></a>
                    </td>
                    <td>
                        <a onclick="javascript:openModal(<?= $r['id'] ?>)">
                            Edit
                            <div class="modal is-id<?= $r['id'] ?>">
                                <div class="modal-background"></div>
                                <div class="modal-content">
                                    <form action="../admin/update.php" method="post">
                                        <fieldset disabled>
                                        <div class="field transparent">
                                            <p class="control">
                                                <input class="input" type="id" placeholder="id" name="id" value="<?= $r['id'] ?>">
                                            </p>
                                        </div>
                                        </fieldset>
                                        <div class="field">
                                            <p class="control has-icons-left">
                                                <input class="input" type="name" placeholder="Username" name="username" value="<?= $r['nom'] ?>">
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="field">
                                            <p class="control">
                                                <input class="input" type="date" placeholder="Date d'entrée" name="entry_date" value="<?= $r['entry_date'] ?>">
                                            </p>
                                        </div>
                                        <div class="field">
                                            <p class="control">
                                                <input class="input" type="date" placeholder="Date de sortie" name="out_date" value="<?= $r['out_date'] ?>">
                                            </p>
                                        </div>
                                        <div class="field is-grouped">
                                            <p class="control">
                                                <button class="button is-success" type="submit" name="valider" value='confirm' onclick="javascript:closeModal(<?= $r['id'] ?>)">
                                                    Modifier
                                                </button>
                                            </p>
                                            <p class="control">
                                                <button class="button is-danger" name="valider" value='cancel' onclick="javascript:closeModal(<?= $r['id'] ?>)">
                                                    Annuler
                                                </button>
                                            </p>
                                        </div>
                                    </form>
                                    <button class="modal-close is-large" aria-label="close" onclick="javascript:closeModal(<?= $r['id'] ?>)"></button>
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="block">
            <h3>Créer une nouvelle reservation</h3>
            <form method="post" action='../admin/create.php'>
                <div class="form-group">
                    <label for="name">Nom client</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="entry">Date d'entrée</label>
                    <input type="date" name="entry" id="entry" class="form-control">
                </div>
                <div class="form-group">
                    <label for="out">Date de sortie</label>
                    <input type="date" name="out" id="out" class="form-control">
                </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-info">Créer la réservation</button>
                </div>
        </form>
        </div>
    </div>
    <!-- <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <form action="" method="post">
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="name" placeholder="Username" name="username">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Password" name="password">
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <p class="control">
                        <button class="button is-success" type="submit" name="valider" value='Login'>
                            Login
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div> -->
</body>
<script type="text/javascript">
    function openModal(id) {
        var idClass = ".is-id" + id;
        var elem = document.querySelector(idClass);
        if (elem.classList.contains("is-active")) {
        }
        else {
            elem.classList.add("is-active");  
        }
    }

    function closeModal(id) {
        var idClass = ".is-id" + id;
        console.log(idClass);
        var elem = document.querySelector(idClass);
        console.log(elem);
        elem.classList.remove("is-active");
        console.log(elem);
    }
</script>
</html>