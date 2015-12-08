<?php

// autor: Roman Prchal
// vytvoreno: 4.11.2015
// vytvoreno jako ukázka presenteru

namespace App\Presenters;

use Nette;
use App\Model;
use App\Forms\SignFormFactory;
use App\Forms\RegisterFormFactory;
use App\Forms\ProfileFormFactory;


class HomepagePresenter extends BasePresenter {

		/** @var SignFormFactory @inject */
		public $factory;

		/** @var RegisterFormFactory @inject */
		public $factory2;

		/** @var ProfileFormFactory @inject */
		public $factory3;

		/** @var Model\Database */
		private $database;


	/* --- --- KONSTRUKTOR PRESENTERU --- --- */
	public function __construct(Model\Database $database) {
		$this->database = $database;
	}

	/* --- --- RENDER METODY PRESENTERU --- --- */
	public function renderDefault() {
		/* staticka data z DB */
		$this->template->inzeraty = array(
			1 => array( // ID inzeratu
				'class' => 'elektronika',
				'header' => 'Pocitac',
				'body' => 'Muj stary pocitac ke koupi',
				'prize' => 250,
				'pictures' => 'pocitac.jpg',
				),
			2 => array(
				'class' =>'akce',
				'header' => 'Godot',
				'body' => 'Mam volny listek do divadla, kdo se prida? Ctvrtek 19:00.',
				'prize' => 500,
				'pictures' => '',
				),
			3 => array(
				'class' =>'akce',
				'header' => 'Koncert',
				'body' => 'Koncert...',
				'prize' => 250,
				'pictures' => 'koncert.jpg',
				),
			4 => array(
				'class' =>'jidlo',
				'header' => 'Burger Night',
				'body' => 'Delam burgery, pojdte se pridat.',
				'prize' => 0,
				'pictures' => 'burger.jpg',
				),
			5 => array(
				'class' =>'elektronika',
				'header' => 'Pocitac',
				'body' => 'Muj stary pocitac ke koupi',
				'prize' => 245,
				'pictures' => 'pocitac.jpg',
				),
			6 => array(
				'class' =>'jidlo',
				'header' => 'Burger Night',
				'body' => 'Delam burgery, pojdte se pridat.',
				'prize' => 0,
				'pictures' => 'burger.jpg',
				),
			7 => array(
				'class' =>'jine',
				'header' => 'Hledam douco',
				'body' => 'Potrebuji se doucit matematiku, umi nekdo zlomky?',
				'prize' => 200,
				'pictures' => 'koncert.jpg',
				),
			8 => array(
				'class' =>'jidlo',
				'header' => 'Burger Night',
				'body' => 'Delam burgery, pojdte se pridat.',
				'prize' => 0,
				'pictures' => 'burger.jpg',
				),
			9 => array(
				'class' =>'jine',
				'header' => 'Hledam douco',
				'body' => 'Potrebuji se doucit matematiku, umi nekdo zlomky?',
				'prize' => 200,
				'pictures' => 'koncert.jpg',
				),
			);

		$this->template->dbUser = $this->database->findById('user', 1);
		// vytvorim objekt pomoci me modelove tridy v app/model
		$mujZooObjekt = new Model\TestModelClass;
		// do promenne pro template nactu pole zvirat
		$this->template->zviratka = $mujZooObjekt->vratPole();

		//Zda je uzivatel prihlasen ci ne
		if (empty($_POST["prihlasen"]))
		{
		$prihlasen = false;
		} else
		{
		$prihlasen = true;
		}
		$profile = array(
			'nickname' => 'pribyto');

		$this->template->prihlasen = $prihlasen;

		$this->template->profile = $profile;
	}

	public function renderProfile($id = null) {

		$this->template->profile = $this->database->findById('user', $id); //načtění polí profilu z databáze
		if(!$this->template->profile) {
			$this->flashMessage('Je nám líto, ale hledaný uživatel v naší databázi není.');
			$this->redirect('Homepage:default');
		}
	}


	public function renderInzerat($id = NULL) {

		$this->template->inzerat = $this->database->findById('poster', 1);

		if(!$this->template->inzerat) {
			$this->flashMessage('Je nám líto, ale hledaný inzerát v naší databázi není.');
			$this->redirect('Homepage:default');
		}
	}


	/* --- --- ACTION METODY PRESENTERU --- --- */
	public function actionLogout() {
		$gender_id = $this->user->identity->id_gender;
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení proběhlo bez problémů.');
		$this->redirect('Homepage:default');
	}


	/* --- --- TOVARNICKY PRESENTERU --- --- */
	/**
	 * Tovarnicka pro prihlasovaci formular.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSign() {
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$this->flashMessage('Přihlášení proběhlo bez problémů.');
			$this->redirect('Homepage:default');
		};
		return $form;
	}

	protected function createComponentRegister() {
		$form = $this->factory2->create();
		$form->onSuccess[] = function ($form) {
			$this->flashMessage('Registrace proběhla bez problémů.');
			$this->redirect('Homepage:default');
		};
		return $form;
	}

	protected function createComponentProfile() {
		$form = $this->factory3->create();
		$form->onSuccess[] = function ($form) {
			$this->flashMessage('Profile uložen.');
			$this->redirect('Homepage:default');
		};
		return $form;
	}

}

