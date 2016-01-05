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
	public function renderDefault($idkat = 0, $page = 1) {
		$this->template->paginator = new Nette\Utils\Paginator;
		$this->template->paginator->setItemsPerPage(9); // počet položek na stránce
		$this->template->paginator->setPage($page);

		if ($idkat == 0) {
			$this->template->paginator->setItemCount($this->database->findAll('inzeraty')->where('NOW() <= expire')->count("*"));
			$this->template->inzeraty =$this->database->findAll('inzeraty')->where('NOW() <= expire')->order('added DESC')->limit($this->template->paginator->getLength(), $this->template->paginator->getOffset());
		}
		elseif ($idkat == 10) {
				$this->template->paginator->setItemCount($this->database->findAll('inzeraty')->where('NOW() <= expire AND id_user = ?',$this->user->id)->count("*"));
				$this->template->inzeraty =$this->database->findAll('inzeraty')->where('NOW() <= expire AND id_user = ?',$this->user->id)->order('added DESC')->limit($this->template->paginator->getLength(), $this->template->paginator->getOffset());
			}
			else {
				$this->template->paginator->setItemCount($this->database->findAll('inzeraty')->where('NOW() <= expire AND id_kategorie = ?',$idkat)->count("*"));
				$this->template->inzeraty =$this->database->findAll('inzeraty')->where('NOW() <= expire AND id_kategorie = ?',$idkat)->order('added DESC')->limit($this->template->paginator->getLength(), $this->template->paginator->getOffset());
			}

		$this->template->kategorie = $this->database->findAll('kategorie');
		$this->template->vybranakat = $this->database->findById('kategorie',$idkat);
		$this->template->dbUser = $this->database->findById('user', 1);
		// vytvorim objekt pomoci me modelove tridy v app/model
		$mujZooObjekt = new Model\TestModelClass;
		// do promenne pro template nactu pole zvirat
		$this->template->zviratka = $mujZooObjekt->vratPole();

		if (($this->template->vybranakat==null) and ($idkat==10)) //kliknuto na Moje inzeráty
		{
		$this->template->vybranakat= (object) array(
			'nazev' => 'Moje inzeráty',
			'id' => $idkat);
		}

		$this->template->pictures = $this->database->findAll('image');
	}

	public function renderProfile($id = null) {

		$this->template->profile = $this->database->findById('user', $id); //načtění polí profilu z databáze
		if(!$this->template->profile) {
			$this->flashMessage('Je nám líto, ale hledaný uživatel v naší databázi není.');
			$this->redirect('Homepage:default');
		}
	}


	public function renderInzerat($id = NULL, $user_id = NULL) {

		// priprava pro praci s formularem
		$form = $this['inzerat'];

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

			$form['id_inzerat']->value = $id; // novy inzerat ($id == 0)
			$this->template->inzerat = $inzerat;
			$this->template->autor_id = 0;
			$this->template->autor_nickname = NULL;
			$this->template->comments = NULL;
			$this->template->any_pictures = 0;
		}
		else{ // prohlizeni/ editace inzeratu

			$this->template->inzerat = $this->database->findById('poster', $id);
			if(!$this->template->inzerat) {
				$this->flashMessage('Je nám líto, ale hledaný inzerát v naší databázi není.');
				$this->redirect('Homepage:default');
			}

			// jedna se o editaci, nahraji tedy do formu data editovaneho inzeratu
			$form['id_inzerat']->value = $id;
			$form->setDefaults($this->template->inzerat);

			// (1) $this->template->nazevKategorie = $this->database->findById('kategorie', $this->template->inzerat->id_kategorie)->nazev; <- fuj (Roman)
			$this->template->nazevKategorie = $this->template->inzerat->kategorie->nazev; // lepsi verze zapisu nahore, vyuziti elegance FK a ORM db
			$this->template->autor_id = $this->template->inzerat->id_user;
			// (2) $this->template->autor_nickname = $this->database->findById('user', $this->template->inzerat->id_user)->nickname;
			$this->template->autor_nickname = $this->template->inzerat->user->nickname;
			// 1 a 2 netreba ukladat zvlast do promennych, v template k nim lze pristupovat stejne jako jsem naznacil u obou promennych o radek nize

			$this->template->comments = $this->database->find('komenty', 'id_poster', $id);

			$this->template->pictures = $this->database->find('image', 'id_poster', $id);
			$this->template->any_pictures = count($this->template->pictures);
		}
	}

	// výpis inzerátů pro konkrétního uživatele
	public function renderMyPosters() {
		$this->template->activePosters = $this->database->findByUser('poster', $this->user->id)
		->where('NOW() <= expire')->order('expire DESC');
		$this->template->inactivePosters = $this->database->findByUser('poster', $this->user->id)
		->where('NOW() > expire')->order('expire DESC');
	}

	public function handleDeactivateMyPoster($id) {

        $poster = $this->database->findById('poster', $id);
        $data['expire'] = $poster->added; // nastavim mu datum vyprseni stejny jako datum pridani, coz inzerat presune do inaktivity
        $poster->update($data);

        if ($this->isAjax()) {
            $this->redrawControl('myposters');
        }
    }

    public function handleActivateMyPoster($id) {

        $poster = $this->database->findById('poster', $id);
        $data['expire'] = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 30 day")); // pokud uzivatel bude chtit inzerat dodatecne prodlouzit tak, uz jen o mesic
        $poster->update($data);

        if ($this->isAjax()) {
            $this->redrawControl('myposters');
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

