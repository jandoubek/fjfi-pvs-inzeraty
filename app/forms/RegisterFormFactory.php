<?php

namespace App\Forms;

use Nette;
use App\Model;
use Nette\Application\UI\Form;
use Nette\Security\User;


class RegisterFormFactory extends Nette\Object {

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
		$form->addText('username', 'Username:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno')
			->setRequired('Prosím vyplňte Váš nick.');

		$form->addPassword('password', 'Password:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno')
			->setRequired('Prosím vyplňte Vaše heslo.');

		$form->addPassword('repassword', 'RePassword:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno')
			->setRequired('Prosím vyplňte znovu Vaše heslo.');

		$form->addText('email', 'Email:')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Nevyplněno')
			->setRequired('Prosím vyplňte Váš email.');



		$form->addSubmit('send', 'Registrovat')
		->setAttribute('class', 'btn btn-primary');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values) {

		try {
			$userManager = new Model\UserManager($this->user, $this->database);
			$userManager->register($values->username, $values->password, $values->repassword, $values->email);
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
