<?php

include("Slim/Slim.php");

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get(
    '/', function () use ($app) {
        echo "¡¡Esto es una API para Kubide!!";
    }
)->setParams(array($app));


// Como USUARIO quiero poder llamar al API para crear notas.

$app->post(
    '/notes/', function () use ($app) {
        $values = $request->getParsedBody();
        $text = $values['text'];
        $note = NotesRepository::getInstance()->addNote($text);

        if (isset($text) && $text != "") {
            $res = array("success"=>true, $note);
            return json_encode($res);
        }
        $res = array("success"=>false, $note);
        return json_encode(res);
    }
);

// Como USUARIO quiero poder llamar al API para consultar las notas.
$app->get(
    '/notes/', function () use ($app) {
        $notes = NotesRepository::getInstance()->getNotes();
        $res = array("success"=>true, $notes);
        return json_encode($res);
    }
);


// Como USUARIO quiero poder llamar al API para consultar una sóla nota.
$app->get(
    '/notes/:noteId', function ($noteId) use ($app) {
        $note =  NotesRepository::getInstance()->getOneNote($noteId);
        if ($note!=null) {
            $res = array("success"=>true, $note);
            return json_encode($res);
        }
        $res = array("success"=>false, $note);
        return json_encode(res);
    }
);

// Como USUARIO quiero poder llamar al API para marcar favorita una nota.
$app->post(
    '/notes/fav/:idNote', function ($idNote) use ($app) {
        $values = $request->getParsedBody();
        $idNote = $values['idNote'];
        return NotesRepository::getInstance()->setFavorite($idNote);
    }
);

// Como USUARIO quiero poder llamar al API para consultar las notas marcadas como favoritas.
$app->get(
    '/notes/fav', function () use ($app) {
        return NotesRepository::getInstance()->getFavoriteNotes();
    }
);

// Como USUARIO quiero poder llamar al API, es decir, quiero poder tener un servidor local 
// al que hacer una llamada HTTP y que me devuelva algo.
$app->run();