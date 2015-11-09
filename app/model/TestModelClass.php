<?php

// autor: Roman Prchal
// vytvoreno: 4.11.2015
// vytvoreno jako ukázka modelove tridy

namespace App\Model;

use Nette;

class TestModelClass extends Nette\Object {

	private $moje_pole;
	private $komentare_uzivatelu;
	private $komentare_datum;

	// konstruktor
	public function __construct() {
		$this->moje_pole = array('Ryba', 'Papouch', 'Lev', 'Tygr', 'Žirafa', 'Toník', 'Tapír');
		$this->komentare_uzivatelu = array('Nuda, nuda tady.', 
					'Proc je ta lednice tak draha, dam pulku!');
		$this->komentare_datum = array(date("Y/m/d"), date("F j, Y", time() - 60 * 60 * 24));
	}

	// vraci array
	public function vratPole() {
  		return $this->moje_pole;
	}

	public function vratKomentare() {
  		return $this->komentare_uzivatelu;
	}

	public function vratDataKomentaru() {
  		return $this->komentare_datum;
	}
}
