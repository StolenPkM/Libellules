<?php
    session_start();
    if($_SESSION["autoriser"] === "oui") {
        header("location:../../src/config/session.php");
        exit();
    } else {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../css/mystyles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/admin.css">


    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
</head>
<body>
    <!-- Header -->
    <div class="block">
        <header class="header">
            <a  class="header-logo" href="../../index.html">Logo</a>
            <nav class="header-menu">
                <a href="./villa.html">Aperçu</a>
                <a href="./photos.php">Photos</a>
                <a href="./calendar.php">Planning</a>
                <a href="#">Contact</a>
                <a href="#">
                    <i class="fas fa-user-lock"></i>
                </a>
            </nav>
        </header>
    </div>
    <!-- Header -->

    <!-- Formulaire de connexion -->
    <div class="block form-block">
        <form action="../../src/config/process.php" method="post">
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
    <!-- Formulaire de connexion -->
</body>
</html>
<?php } ?>