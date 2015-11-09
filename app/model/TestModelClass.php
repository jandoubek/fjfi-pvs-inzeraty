<?php

// autor: Roman Prchal
// vytvoreno: 4.11.2015
// vytvoreno jako ukázka modelove tridy

namespace App\Model;

use Nette;

class TestModelClass extends Nette\Object {

	private $moje_pole;

	// konstruktor
	public function __construct() {
		$this->moje_pole = array('Ryba', 'Papouch', 'Lev', 'Tygr', 'Žirafa', 'Toník');
	}

	// vraci array
	public function vratPole() {
  		return $this->moje_pole;
	}
}
