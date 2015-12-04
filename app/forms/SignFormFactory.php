<?php

namespace App\Forms;

use Nette;
use App\Model;
use Nette\Application\UI\Form;
use Nette\Security\User;


class SignFormFactory extends Nette\Object {
	
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

		$form->addCheckbox('remember', 'Chcete zůstat přihlášen?');

		$form->addSubmit('send', 'Přihlásit')
		->setAttribute('class', 'btn btn-primary');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values) {
		if ($values->remember) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}

		try {
			$userManager = new Model\UserManager($this->user, $this->database); 
			$userManager->login($values->username, $values->password);
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
