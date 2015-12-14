<?php

namespace App\Model;

use Nette,
	Nette\Security,
	Nette\Utils\Strings;


class InzeratManager {

	/** @var array */
	private $inzerat;

  /** @var Nette\Database\Context */
	private $database;


  public function __construct(array $inzerat, Nette\Database\Context $database) {
      $this->inzerat = $inzerat;
      $this->database = $database;
  }

  public function zaloz_inzerat(){
  	$this->database->query('INSERT INTO poster', $this->inzerat);
  }

}