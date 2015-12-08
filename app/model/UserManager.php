<?php

namespace App\Model;

use Nette,
	Nette\Security,
	Nette\Utils\Strings;


class UserManager {

    	/** @var Nette\Security\User */
    	private $user;

    	/** @var Nette\Database\Context */
		private $database;


    public function __construct(Nette\Security\User $user, Nette\Database\Context $database) {

        $this->user = $user;
        $this->database = $database;
    }


	public function login($nick, $password) {

		$row = $this->database->table('user')->where('nickname', $nick)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('Zadejte prosím správný nick.');
		}

		if ($row->password !== $this->generateHash($password, $row->password)) {
			throw new Security\AuthenticationException('Zadejte prosím správné heslo.');
		}

		$arr = $row->toArray();
		unset($arr['password']);

	    $this->user->login(new Security\Identity($row->id, null, $arr));
	}

	public function register($nick, $password, $repassword, $email) {

		$row = $this->database->table('user')->where('nickname', $nick)->fetch();

		if ($row) {
			throw new Security\AuthenticationException('Zadaná přezdívka již existuje.');
		}

		if ($password != $repassword) {
			throw new Security\AuthenticationException('Zadaná hesla se neshodují.');
		}

		if (!$row)
		{
			if ($password == $repassword)
			{
			$this->database->query('INSERT INTO user', array(
   		'nickname' => $nick,
   	  'password' =>  $this->generateHash($password),
   	  'email' => $email,
					));
			}

		}
	}

	/**
	 * Generuje hash hesla i se solicim retezcem
	 * @return string
	 */
	public function generateHash($password, $salt = NULL) {

		if ($password === Strings::upper($password)) { // v pripade zapleho capslocku
			$password = Strings::lower($password);
		}

		return crypt($password, $salt ?: '$2a$07$' . Strings::random(23));
	}

}