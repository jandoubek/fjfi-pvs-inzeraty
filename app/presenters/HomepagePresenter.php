<?php

// autor: Roman Prchal
// vytvoreno: 4.11.2015
// vytvoreno jako ukázka presenteru

namespace App\Presenters;

use Nette;
use App\Model;
use App\Forms\SignFormFactory;
use App\Forms\RegisterFormFactory;
use App\Forms\CommentFormFactory;
use App\Forms\ProfileFormFactory;
use App\Forms\InzeratFormFactory;


class HomepagePresenter extends BasePresenter {

		/** @var SignFormFactory @inject */
		public $factory;

		/** @var RegisterFormFactory @inject */
		public $factory2;

		/** @var ProfileFormFactory @inject */
		public $factory3;

		/** @var CommentFormFactory @inject */
		public $factory4;

		/** @var InzeratFormFactory @inject */
		public $inzerat_factory;

		/** @var Model\Database */
		private $database;


	/* --- --- KONSTRUKTOR PRESENTERU --- --- */
	public function __construct(Model\Database $database) {
		$this->database = $database;
	}

	/* --- --- RENDER METODY PRESENTERU --- --- */
	public function renderDefault($idkat = 0) {
		$this->template->inzeraty = $this->database->findAll('poster');
		$this->template->kategorie = $this->database->findAll('kategorie');
		$this->template->vybranakat = $this->database->findById('kategorie',$idkat);
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


	public function renderInzerat($id = NULL, $user_id = NULL) {

		if($id == 0){ // nový inzerát
			$inzerat = (object)array(
				'id' => 0,
				'id_user' => $user_id,
				'id_kategorie' => 1,
				'title' => '',
				'body' => '',
				'added' => '',
				'expire' => '',
				'value' => ''
			);

			$this->template->inzerat = $inzerat;
			$this->template->autor_id = 0;
			$this->template->autor_nickname = NULL;
			$this->template->comments = NULL;
		}
		else{ // prohlizeni/ editace inzeratu
			$this->template->inzerat = $this->database->findById('poster', $id); //$id misto 0
			$this->template->inzeratName = $this->database->findById('poster', $id)->title;
			if(!$this->template->inzerat) {
				$this->flashMessage('Je nám líto, ale hledaný inzerát v naší databázi není.');
				$this->redirect('Homepage:default');
			}
			$this->template->autor_id = $this->template->inzerat->id_user;
			$this->template->autor_nickname = $this->database->findById('user', $this->template->inzerat->id_user)->nickname;
			$this->template->comments = $this->database->find('komenty', 'id_poster', 1);
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

	protected function createComponentComment(){
		$form = $this->factory4->create();
        $form->onSuccess[] = function ($form) {
			$this->flashMessage('Váš příspěvek byl uložen.');
			$this->redirect('Homepage:default');
		};
        return $form;
	}

	protected function createComponentInzerat(){
		$form = $this->inzerat_factory->create();
    $form->onSuccess[] = function ($form) {
			$this->flashMessage('Váš inzerát byl založen.');
			$this->redirect('Homepage:default');
		};
    return $form;
	}

}

