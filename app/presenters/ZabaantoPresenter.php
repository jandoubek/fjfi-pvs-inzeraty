<?php

namespace App\Presenters;

use Nette;
use App\Model;


class ZabaantoPresenter extends BasePresenter
{

	public function renderDefault()
	{
		$this->template->jmeno = array('Jmeno' => 'Tonda');
		$this->template->date = date('Y-m-d H:i:s', strtotime('now'));
	}
}
