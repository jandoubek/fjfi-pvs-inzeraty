<?php

namespace App\Forms;

use Nette;
use App\Model;
use Nette\Application\UI\Form;
use Nette\Security\User;


class ProfileFormFactory extends Nette\Object {

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

		$form->addSubmit('send', 'Uložit a zavřít')
		->setAttribute('class', 'btn btn-primary');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values) {

		try {
			$userManager = new Model\UserManager($this->user, $this->database);
			$userManager->saveprofile($form->getHttpData($form::DATA_TEXT, 'profile_email_input'), $form->getHttpData($form::DATA_TEXT, 'profile_telephone_input'), $form->getHttpData($form::DATA_TEXT, 'profile_address_input'), $form->getHttpData($form::DATA_TEXT | $form::DATA_KEYS, 'profile_comment_input'));
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
