<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/mystyles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/calendar.css">

    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

    <title>Les 2 libellules</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    
</head>
<body>
    <?php 
        require '../../src/date/Month.php';
        require '../../src/date/reservation.php';
        require '../../src/config/config.php';

        $requete = $dbh->prepare("SELECT * FROM reservation_villa");
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();

        try {
            $month = new App\Date\Month($_GET["month"] ?? null, $_GET["year"] ?? null);
        }catch(\Exception $e){
            $month = new App\Date\Month();
        }
        if ($month->getStartingDay()->format('D') == 'Mon') {
            $start = $month->getStartingDay();
        }else {
            $start = $month->getStartingDay()->modify('last monday');
        }

        $today = date('Y-m-d');
    ?>

    <!-- Header -->
    <div class="block">
        <header class="header">
            <a  class="header-logo" href="../../index.html">Logo</a>
            <nav class="header-menu">
                <a href="./villa.html">Aperçu</a>
                <a href="./photos.php">Photos</a>
                <a href="./calendar.php">Planning</a>
                <a href="#">Contact</a>
                <a href="./admin.php">
                    <i class="fas fa-user-lock"></i>
                </a>
            </nav>
        </header>
    </div>
    <!-- Header -->

    <h5><?= $month->toString(); ?></h5>

    <div class="calendar__container">
        <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">
            <tr>
                <td class="weekDay">Lun</td>
                <td class="weekDay">Mar</td>
                <td class="weekDay">Mer</td>
                <td class="weekDay">Jeu</td>
                <td class="weekDay">Ven</td>
                <td class="weekDay">Sam</td>
                <td class="weekDay">Dim</td>
            </tr>
            <?php for($i = 0; $i < $month->getWeeks(); $i++): ?>
                <tr>
                    <?php foreach($month->days as $k => $day):
                        $date=(clone $start)->modify("+" . ($k + $i * 7) . " days");
                    ?>
                    <td class="<?= $month->withInMonth($date) ? '' : 'othermonth'; ?> <?=  $date->format('Y-m-d') > $today ? 'available' : 'unavailable'; ?> <?= isReserved($result, $date->format('Y-m-d')) ? 'reserved' : ''; ?>">
                        <div class="calendar__day"><?= $date->format('d'); ?></div>
                    </td>
                    <?php endforeach ?>
                </tr>
            <?php endfor; ?>  
        </table>
        <div class="change__date">
            <div class="btn-prev-next">
                <a href="./calendar.php?month=<?= $month->previousMonth()->month ?>&year=<?= $month->previousMonth()->year ?>" class="btn">&lt;</a>
                <a href="./calendar.php?month=<?= $month->nextMonth()->month ?>&year=<?= $month->nextMonth()->year ?>" class="btn">&gt;</a>
            </div>
            <div class="go-back">
                <a href="./calendar.php" class="btn">Aujourd'hui</a>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="description">
            <h1 class="title is-3 description-title">Conditions de réservation / Tarifs</h1>
            <p class="description-text">
                A completer !!
            </p>
        </div>
    </div>
</body>
</html>