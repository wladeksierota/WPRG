<?php
class NoweAuto {
    public $model = '';
    public $cenaEuro;
    public $kursEuroPLN;

    public function __construct($model,$cenaEuro,$kursEuroPLN) {
        $this->model = $model;
        $this->cenaEuro = $cenaEuro;
        $this->kursEuroPLN = $kursEuroPLN;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getCenaEuro() {
        return $this->cenaEuro;
    }

    public function setCenaEuro($cenaEuro) {
        $this->cenaEuro = $cenaEuro;
    }

    public function getKursEuroPLN() {
        return $this->kursEuroPLN;
    }

    public function setKursEuroPLN($kursEuroPLN) {
        $this->kursEuroPLN = $kursEuroPLN;
    }

    public function ObliczCene() {
        return $this->cenaEuro * $this->kursEuroPLN;
    }
}

class AutoZDotatkami extends NoweAuto {
    public $alarm;
    public $radio;
    public $klima;

    public function __construct($alarm,$radio,$klima) {
        parent::__construct($alarm,$radio,$klima);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klima = $klima;
    }

    public function ObliczCene() {
        return parent::ObliczCene() + $this->alarm + $this->radio + $this->klima;
    }
}

class Ubezpieczenie extends AutoZDotatkami {
    public $procent;
    public $lata;

    public function __construct($procent,$lata) {
        parent::__construct($procent,$lata);
        $this->procent = $procent;
        $this->lata = $lata;
    }
    public function ObliczCene() {
        return parent::ObliczCene() * $this->procent * ((100-$this->lata)/100);
    }
}
