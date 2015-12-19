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


	public function __construct(User $user, Nette\Database\Context $database) {
		$this->user = $user;
		$this->database = $database;
	}

	/**
	 * @return Form
	 */
	public function create() {
		$form = new Form;

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

		$form->addSelect('kategorie', 'Vyberte kategorii:', $kategorie);

		$form->addTextArea('body', 'Popis:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno');

		$form->addTextArea('bodyEdit', 'Popis:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno');

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
		$inzeratManager = new Model\InzeratManager($values, $this->database);

		// Tady jedine co, tak je treba rozlisit kdy zavolat zaloz inzerat a kdy uloz_inzerat. A to na zaklade ID inzeratu (zda NULL ci ne), nevím jak to zjistím.
		$inzeratManager->zaloz_inzerat();
	}

}
