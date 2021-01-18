<?php

namespace App\Date;

class Month {

    private $months =['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $days =['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    public $month;
    public $year;

    public function __construct(?int $month = null, ?int $year = null) {

        if ($month === null) {
            $month = intval(date('m'));
        }
        if ($year === null) {
            $year = intval(date('Y'));
        }

        if($month < 1 || $month > 12) {
            throw new \Exception("le mois $month n'est pas valide !");
        }
        if ($year < 1970) {
            throw new \Exception("L'année est inférieur à 1970");
        }
        $this->month = $month;
        $this->year = $year;
    }

    public function getStartingDay() {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    public function toString() : string {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    public function getMonth(): string {
        return $this->months[$this->month - 1];
    }

    public function getYear(): string {
        return $this->year;
    }

    public function getWeeks() : int {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W') - $start->format('W')) + 1;
        if ($weeks < 0) {
            $weeks = intval($end->format('W')) +1;
        }
        return $weeks;
    }

    public function withInMonth(\DateTime $date): bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    public function nextMonth(): Month {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12) {
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }

    public function previousMonth(): Month {
        $month = $this->month - 1;
        $year = $this->year;
        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }
}

?>