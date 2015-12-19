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


		//$form->addSelect('kat', 'Vyber kategorii:', (array)$this->database->findAll('kategorie')->nazev)
		//	->setPrompt('Pick a country');
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

		$form->addText('value', 'Cena:')
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
		$inzeratManager->zaloz_inzerat();
	}

}
