<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/mystyles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/calendar.css">

    <title>Les 2 libellules</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    
</head>
<body>
    <?php 
        require '../../src/date/Month.php';
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
    ?>

    <!-- Header -->
    <div class="block">
        <header class="header">
            <a  class="header-logo" href="../../index.html">Logo</a>
            <nav class="header-menu">
                <a href="./villa.html">Aperçu</a>
                <a href="./photos.html">Photos</a>
                <a href="./calendar.php">Planning</a>
                <a href="#">Contact</a>
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
                    <td class="<?= $month->withInMonth($date) ? '' : 'othermonth'; ?>">
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
            <div class="select__date">
                <label for="month-select">Mois:</label>
                <select name="Mois" id="Month-select" onchange="<?php $month->jumpTo($value, null) ?>">
                    <option value="Janvier" <?= $month->getMonth() === "Janvier" ? 'selected': '' ;?>>Janvier</option>
                    <option value="Février" <?= $month->getMonth() === "Février" ? 'selected': '' ;?>>Février</option>
                    <option value="Mars" <?= $month->getMonth() === "Mars" ? 'selected': '' ;?>>Mars</option>
                    <option value="Avril" <?= $month->getMonth() === "Avril" ? 'selected': '' ;?>>Avril</option>
                    <option value="Mai" <?= $month->getMonth() === "Mai" ? 'selected': '' ;?>>Mai</option>
                    <option value="Juin" <?= $month->getMonth() === "Juin" ? 'selected': '' ;?>>Juin</option>
                    <option value="Juillet" <?= $month->getMonth() === "Juillet" ? 'selected': '' ;?>>Juillet</option>
                    <option value="Août" <?= $month->getMonth() === "Août" ? 'selected': '' ;?>>Août</option>
                    <option value="Septembre" <?= $month->getMonth() === "Septembre" ? 'selected': '' ;?>>Septembre</option>
                    <option value="Octobre" <?= $month->getMonth() === "Octobre" ? 'selected': '' ;?>>Octobre</option>
                    <option value="Novembre" <?= $month->getMonth() === "Novembre" ? 'selected': '' ;?>>Novembre</option>
                    <option value="Décembre" <?= $month->getMonth() === "Décembre" ? 'selected': '' ;?>>Décembre</option>
                </select>
                <label for="year-select">Année:</label>
                <select name="Year" id="Year-select">
                    <?php for($i=1970; $i < 2050; $i++): ?>
                        <option value="<?= $i ?>" <?= $month->getYear() === "$i" ? 'selected': '' ;?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>          
            </div>
        </div>
    </div>
</body>
</html>