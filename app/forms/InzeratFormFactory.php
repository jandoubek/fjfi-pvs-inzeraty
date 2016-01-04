<?php

namespace App\Forms;

use Nette;
use App\Model;
use Nette\Application\UI\Form;
use Nette\Security\User;


class InzeratFormFactory extends Nette\Object {

		/** @var User */
		private $user;

		/** @var Nette\Database\Context */
		private $database;

		private $inzerat;
		private $id;


	public function __construct(User $user, Nette\Database\Context $database) {
		$this->user = $user;
		$this->database = $database;
	}

	/**
	 * @return Form
	 */
	public function create($id = null) {
		$form = new Form;

		$form->addtext('id_inzerat', 'Id inzerátu');

		$form->addText('title', 'Název inzerátu:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno')
			->setRequired('Vyplňte prosím nadpis inzerátu.');
	// The categories need to be retrieved from the database, ToDO
	//	$kategorie_ex = $this->database->findAll('kategorie');
	//	$kategorie;
	//	foreach ($kategorie_ex as $kategorie_i)
	//		array_push($kategorie, $kategorie_i);

		$kategorie = array(
		    '1' => 'Elektronika',
		    '2' => 'Akce',
		    '3'  => 'Jidlo',
		    '4'  => 'Jine',
		);

		$form->addSelect('id_kategorie', 'Vyberte kategorii:', $kategorie);

		$form->addTextArea('body', 'Popis:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno');

		$form->addTextArea('bodyEdit', 'Popis:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno');

		$form->addMultiUpload('photo', 'Fotky:')
			->addRule(Form::IMAGE, 'Obrázek musí být JPEG, PNG nebo GIF.')
			->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost obrázku je 4MB', 4 * 1000 * 1024);

		$form->addText('value', 'Cena:')
			//->addRule(Form::FLOAT, 'Cena musí být číslo')    NEFUNGUJE NEVIM PROC
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno');

		$form->addSubmit('send', 'Uložit inzerát')
		->setAttribute('class', 'btn btn-primary');

		$form->onSuccess[] = array($this, 'save_inzerat');
		return $form;
	}

	public function save_inzerat(Form $form, $values) {
		$values = (array)$values;
		$values['id_user'] = $this->user->id;

		// preulozeni id inzeratu a uvolneni z values kvuli ukladani do db
		$id_inzerat = $values['id_inzerat'];
		unset($values['id_inzerat']);

		$inzeratManager = new Model\InzeratManager($values, $this->database);
		// Tady jedine co, tak je treba rozlisit kdy zavolat zaloz inzerat a kdy uloz_inzerat. A to na zaklade ID inzeratu (zda NULL ci ne), nevím jak to zjistím.
		if ($id_inzerat == 0) {
			$inzeratManager->zaloz_inzerat();
		} else {
			$inzeratManager->uloz_inzerat($id_inzerat);
		}
	}

}
