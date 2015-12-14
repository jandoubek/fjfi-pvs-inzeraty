<?php

namespace App\Forms;

use Nette;
use App\Model;
use Nette\Application\UI\Form;
use Nette\Security\User;


class InzeratFormFactory extends Nette\Object {

		/** @var Inzerat */
		private $inzerat;

		/** @var Nette\Database\Context */
		private $database;

	public function __construct(Nette\Database\Context $database) {
		$this->database = $database;
	}

	/**
	 * @return Form
	 */
	public function create() {
		$form = new Form;
		$form->addText('title', 'Nadpis:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno')
			->setRequired('Vyplňte prosím nadpis inzerátu.');

		$form->addTextArea('body', 'Popis:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno');

		$form->addText('value', 'Cena:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno');

		//$form->addSelect('category') // kategorie nejsou pridany do DB

		$form->addSubmit('send', 'Uložit inzerát')
		->setAttribute('class', 'btn btn-primary');


		//$form->setDefaults(); // nastavit (array)inzerat z DB ..ale jen pouze header, prize a body

		$form->onSuccess[] = array($this, 'save_inzerat');
		return $form;
	}

	public function save_inzerat(Form $form, $values) {
		$values = (array)$values;
		$values['id_user'] = 1;
		$inzeratManager = new Model\InzeratManager($values, $this->database);
		$inzeratManager->zaloz_inzerat();
	}

}
