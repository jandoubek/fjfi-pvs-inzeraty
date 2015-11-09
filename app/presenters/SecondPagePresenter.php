<?php

// autor: Tomas Hubinek
// vytvoreno: 9.11.2015
// Pokusny presenter

namespace App\Presenters;

use Nette;
use App\Model;


class SecondPagePresenter extends BasePresenter
{

	public function renderUkazkovaMetoda()
	{	
		// vytvorim objekt, pomoci me modelove tridy v app/model
		$komentareVsechny = new Model\TestModelClass;
		// do promenne pro template nactu pole zvirat
		$this->template->komentare = $komentareVsechny->vratPole(); 
	}
}