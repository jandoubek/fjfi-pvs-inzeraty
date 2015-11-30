<?php

// autor: Roman Prchal
// vytvoreno: 4.11.2015
// vytvoreno jako ukázka presenteru

namespace App\Presenters;

use Nette;
use App\Model;


class HomepagePresenter extends BasePresenter {

		/** @var Model\Database */
		private $database;


	/* --- --- KONSTRUKTOR PRESENTERU --- --- */
	public function __construct(Model\Database $database) {
		$this->database = $database;
	}


	/* --- --- RENDER METODY PRESENTERU --- --- */
	public function renderDefault() {
		$this->template->dbUser = $this->database->findById('user', 1);
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
		//Zda je uzivatel prihlasen ci ne
		$prihlasen = true;

		$this->template->inzeraty = $inzeraty;

		$this->template->prihlasen = $prihlasen;
	}

	public function renderDefaultAlternative2() {
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
		//Zda je uzivatel prihlasen ci ne
		if (empty($_POST["prihlasen"])) 
		{	
		$prihlasen = false;
		} else
		{
		$prihlasen = true;	
		}

		$this->template->inzeraty = $inzeraty;

		$this->template->prihlasen = $prihlasen;
	}

	public function renderProfile() {
		// !! nepouzivat uvozovky "", jsou pomalejsi nez ''
		//defaultní hodnoty proměnných
		$profile = array(
			'nickname' => 'pribyto',
			'password' => 'nevim',
			'email' => 'tomas.pribyl.89@gmail.com',
			'contacts' => array(
				array(
					'type' => 'Email',
					'contact' => 'tomas.pribyl.89@gmail.com',
					'info' => ''),			
				array(
					'type' => 'Telefon',
					'contact' => 604555666,
					'info' => ''),
				array(
					'type' => 'Adresa',
					'contact' => 'koleje Strahov, blok 3, pokoj 105',
					'info' => 'jen behem tydne'),
				),
			'comment' => 'Telefonní číslo je smyšlené a na uvedené adrese mě nikdy nenajdete, takže zkuste radši email.',
			);

		$this->template->profile = $profile;
	}


	public function renderInzerat() {
		$nazev = "Lednička Whirlpool BLF 8121 W";

		$this->template->nazev = $nazev;
	}
}

