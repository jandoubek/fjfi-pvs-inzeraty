<?php

// autor: Roman Prchal
// vytvoreno: 4.11.2015
// vytvoreno jako ukázka presenteru

namespace App\Presenters;

use Nette;
use App\Model;


class HomepagePresenter extends BasePresenter {

	public function renderDefault() {
		// vytvorim objekt pomoci me modelove tridy v app/model
		$mujZooObjekt = new Model\TestModelClass;
		// do promenne pro template nactu pole zvirat
		$this->template->zviratka = $mujZooObjekt->vratPole();
	}

	public function renderDefaultAlternative() {
		/* staticka data z DB */
		$inzeraty = array(
			12 => array( // ID inzeratu
				'header' => 'Prodam ledničku s mrazákem',
				'body' => 'Lednicka koupena roku 2004. Narocne pouzivana. Fungujici',
				'prize' => 1800,
				'pictures' => array('111.png', '123.jpg', '124.png'), // seznam obrazku, ktery jsou ulozeny na serveru.. obrazky budou na serveru ulozeny pod ID, nikoliv pod svym jmenem
				),
			33 => array(
				'header' => 'Prodam ledničku s mrazákem',
				'body' => 'Lednicka koupena roku 2008. Narocne pouzivana. Fungujici',
				'prize' => 500,
				'pictures' => array(), // nekde obrazky nebudou vubec => zobrazit cast body
				),
			);

		$this->template->inzeraty = $inzeraty;
	}
}

