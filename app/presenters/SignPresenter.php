<?php

namespace App\Presenters;

use Nette;
use App\Forms\SignFormFactory;
use App\Forms\RegisterFormFactory;


class SignPresenter extends BasePresenter
{
	/** @var SignFormFactory @inject */
	public $factory;
	/** @var RegisterFormFactory @inject */
	public $factoryy;

	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSign()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->redirect('Homepage:');
		};
		return $form;
	}

		protected function createComponentRegister()
	{
		$form = $this->factoryy->create();
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->redirect('Homepage:');
		};
		return $form;
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
