<?php 

	class Note {

		public $idNote;
		public $idUser;
		public $text;
		public $favorite;

		function Note($idNote, $idUser, $text)
	    {
	       $this->text = $text;
		   $this->idNote = $idNote;
		   $this->idUser = $idUser;
		   $this->favorite = false;
	    }

		public function getText()
		{
		    return $this->text;
		}

		public function isFavorite()
		{
		    return $this->favorite;
		}
		
		public function setFavorite()
		{
		    $this->favorite = true;
		    return $this;
		}

		public function getIdNote()
		{
		    return $this->idNote;
		}

		public function getIdUser)
		{
		    return $this->idUser;
		}
	}
