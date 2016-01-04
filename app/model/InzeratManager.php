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
      'id_kategorie' =>  $this->inzerat['id_kategorie'],
      'body' =>  $this->inzerat['body'],
      'title' => $this->inzerat['title'],
      'value' => $this->inzerat['value'],
      'added' => date("Y-m-d H:i:s"),
      'expire' =>  date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")), //Expiration period 1 year by default
    ));
    $id_inzerat = $this->database->getInsertId();
    $this->upload_photos($id_inzerat);
  }

  public function uloz_inzerat($id){
    $this->delete_photos($id);
    $this->inzerat['expire'] = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 30 day"));
    unset($this->inzerat['bodyEdit']);
    $inzerat = $this->inzerat;
    unset($inzerat['photo']);
    $this->database->table('poster')->get($id)->update($inzerat);
    $this->update_photos($id);
  }

  private function update_photos($id_inzerat){ // remove and upload new photos
    $this->delete_photos($id_inzerat);
    $this->upload_photos($id_inzerat);
  }

  private function delete_photos($id_inzerat){ // remove photos
    //$images = $this->database->findAll('image')->where('id_poster = '.$this->inzerat->id_inzerat);
    $images = $this->database->query('SELECT * FROM image WHERE id_poster='.$id_inzerat);
    foreach ($images as $image){
      unlink('images/'.$image->id.'.'.$image->extension);
      $this->database->query('DELETE FROM image WHERE id='.$image->id);
    }
  }

  private function upload_photos($id_inzerat){ // upload new photos
    foreach ($this->inzerat['photo'] as $image) {
      // image into DB
      $file_name = pathinfo($image->name, PATHINFO_FILENAME);
      $ext = pathinfo($image->name, PATHINFO_EXTENSION);
      $this->database->query('INSERT INTO image (id_poster, name, extension) VALUES ('.$id_inzerat.',"'.$file_name.'","'.$ext.'")');
      // image onto server
      $id_image = $this->database->getInsertId();
      $target_dir = 'images/';
      $target_file = $target_dir.$id_image.'.'.$ext;
      if (move_uploaded_file($image->getTemporaryFile(), $target_file)){
        // success
      } else {
        // error
      }
    }
  }

}