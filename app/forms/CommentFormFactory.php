<?php

namespace App\Forms;

use Nette;
use App\Model;
use Nette\Application\UI\Form;
use Nette\Security\User;


class CommentFormFactory extends Nette\Object {

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

        $form->addText('name', 'Jméno:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno')  //$user->name.$user->surname)
        	->setRequired('Zadejte prosím jméno.');

        $form->addTextarea('comment', 'Komentář:')
			->setAttribute('class', 'form-control')
			->setAttribute('rows', 'auto')
			->setAttribute('placeholder', 'Nevyplněno')  //$user->name.$user->surname)
        	->setRequired('Komentář je prázdný.');

        $form->addSubmit('submit', 'Uložit')
			->setAttribute('class', 'btn btn-primary');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values) {
/*
		try {
			$userManager = new Model\UserManager($this->user, $this->database);
			$userManager->register($values->username, $values->password, $values->repassword, $values->email);
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		} */
	}

}