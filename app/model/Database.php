<?php

namespace App\Model;

use Nette;


class Database extends Nette\Object
{
	/** @var Nette\Database\Context */
	private $database;
  

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

  /********************* findAll *********************/
  
  // vstupem nazev tabulky
  // vystup vybrana tabulka (objekt)
  /** @return Nette\Database\Table\Selection */
  public function findAll($what)
	{
    return $this->database->table($what);
	}
  
    /********************* findByUser *********************/
  
  // vstupem nazev tabulky a id uzivatele
  // vystupem vybrana cast tabulky pro urciteho uzivatele (objekt)
  /** @return Nette\Database\Table\Selection */
  public function findByUser($what,$user)
	{
  	return $this->database->table($what)->where('id_user', $user);
	}

  /********************* findById *********************/
  
  // vstupem nazev tabulky a id, ktere hledam
  // vystupem vybrany radek z tabulky dle id (objekt)
  /** @return Nette\Database\Table\ActiveRow */
	public function findById($what,$id)
	{
		return $this->findAll($what)->get($id);
	} 

  /********************* insert *********************/
  
  // vstupem nazev tabulky a pole vkladanych dat
  // vystupem vlozena data v tabulce
  /** @return Nette\Database\Table\ActiveRow */
	public function insert($what,$values)
	{
		return $this->findAll($what)->insert($values);
	}

  /********************* array *********************/
  
  // tvorba pole id a libovolneho sloupecku z db tabulky
  // vstupem nazev tabulky, vybrany sloupec, prvni podminka (nepovinna) a druha podminka (nepovinna) 
  // vystupem pole, pole[id] = hodnota sloupce pro toto id
  public function arrayColumn($what,$column,$condition1=null,$condition2=null)
	{
    // pokud obe podminky nezadane -> proved bez podminek
    if($condition1 == null && $condition2 == null)
    {
      foreach ($this->findAll($what) as $value) {
        $values[$value->id] = $value->$column;
      }
    }
    // pokud jedna z nich zadana -> proved tu co je zadana
    elseif(($condition1 != null && $condition2 == null) || ($condition1 == null && $condition2 != null))
    { 
      if($condition1 == null)
      {
        foreach ($this->findAll($what)->where($condition2) as $value) {
          $values[$value->id] = $value->$column;
        }
      }
      else
      {
        foreach ($this->findAll($what)->where($condition1) as $value) {
          $values[$value->id] = $value->$column;
        }
      }
    }
    // pokud zadane obe -> proved obe
    else
    {
      foreach ($this->findAll($what)->where($condition1)->where($condition2) as $value) {
        $values[$value->id] = $value->$column;
      }
    }    
  
    if(isset($values))
      return $values;
    else
		  return NULL; 
	}
  
  // tvorba pole id a libovolneho sloupecku z db tabulky pro konkretniho uzivatele 
  // vstupem nazev tabulky, id uzivatele a nazev sloupce
  // vystupem pole, pole[id] = hodnota sloupce pro toto id
  public function arrayColumnForUser($what,$user,$column)
	{
    foreach ($this->findByUser($what,$user) as $value) {
      $values[$value->id] = $value->$column;
    }
    if(isset($values))
      return $values;
    else
		  return NULL; 
	}
 
}
