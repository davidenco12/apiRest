<?php 

class NotesRepository {

	private static $instance;

	private $notes;

	public static function getInstance(){
		if($instance==null) {
			$instance = new NotesRepository();
		}
		return $instance;
	}

	private function __construct()
	{
		$this->notas = array();
	}

	public function getNotes()
	{
	    return $this->notes;
	}

	public function getFavoriteNotes()
	{
		return array_filter($this->notes, function($note){
			return $note->isFavorite();
		});
	}
	
	public function getOneNote($noteId)
	{
	    foreach ($notes as $key => $value) {
	       if($key == $noteId){
	         return $value;
	       }
	    }
		return null;
	}
	
	public function addNote($text)
	{
		$this->notes[$this->notes->length()] = new Note($this->notes->length(), $text);
	}

	public function setFavorite($nodeId){//Comprobar si existe la nota  y si existe lo haces return true si no existe no lo haces return false
		if(isset($nodeId)){
			$fav = $this->notes[$noteId]->setFavorite();
			return json_encode(new array("success"=>true, $fav));
		}
		return json_encode(new array("success"=>false));
	}
	
}
