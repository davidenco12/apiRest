<?php

include("Slim/Slim.php");

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(); 

$app->get(
    '/',function() use ($app){
        echo "¡¡Esto es una API para Kubide!!";
    }
)->setParams(array($app)); 


// Como USUARIO quiero poder llamar al API para crear notas.

$app->post(
    '/notes/',function() use ($app) {
        $values = $request->getParsedBody();
        $text = $values['text'];
        $note = self::getRepository()->addNote($text);

        if (isset($text) && $text != "") {
          return json_encode(new array("success"=>true, $note));
        }
        return json_encode(new array("success"=>false));
    }
);

// Como USUARIO quiero poder llamar al API para consultar las notas.
$app->get(
    '/notes/', function() use ($app){
       $notes = self::getRepository()->getNotes();
       return json_encode(new array("success"=>true, $notes));
    }
);


// Como USUARIO quiero poder llamar al API para consultar una sóla nota.
$app->get(
    '/notes/:noteId',function($noteId) use ($app){
       $note =  self::getRepository()->getOneNote($noteId);
       if($note!=null){
            return json_encode(new array("success"=>true, $note));
       }
       return json_encode(new array("success"=>false));
    }
);

// Como USUARIO quiero poder llamar al API para marcar favorita una nota.
$app->post(
    '/notes/fav/:idNote',function($idNote) use ($app){
       $values = $request->getParsedBody();
       $idNote = $values['idNote'];
       return self::getRepository()->setFavorite($idNote);
    }
);

// Como USUARIO quiero poder llamar al API para consultar las notas marcadas como favoritas.
$app->get(
    '/notes/fav',function() use ($app){
       return $NotesRepository->getFavoriteNotes();
    }
);

private static function getRepository(){
    return NotesRepository::getInstance();
}

// Como USUARIO quiero poder llamar al API, es decir, quiero poder tener un servidor local 
// al que hacer una llamada HTTP y que me devuelva algo.
$app->run();

?>