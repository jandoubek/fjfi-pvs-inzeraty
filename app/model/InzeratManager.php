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
  $this->database->query('INSERT INTO poster', array(
      'id_user' => $this->inzerat['id_user'],
      'id_kategorie' =>  $this->inzerat['kategorie'],
      'body' =>  $this->inzerat['body'],
      'title' => $this->inzerat['title'],
      'value' => $this->inzerat['value'],
      'added' => date("Y-m-d H:i:s"),
      'expire' =>  date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")), //Expiration period 1 year by default
    ));
  }

  public function uloz_inzerat(){
    $this->database->query('UPDATE poster', array(
      'id_kategorie' =>  $this->inzerat['kategorie'],
      'body' =>  $this->inzerat['body'],
      'title' => $this->inzerat['title'],
      'value' => $this->inzerat['value'],
      'expire' =>  date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")), //Expiration period 1 year by default, the 'added' property does not change
    ));
  }

}