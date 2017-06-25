<?php


//incluyo el archivo principal
include("Slim/Slim.php");

//registro la instancia de slim
\Slim\Slim::registerAutoloader();

//aplicacion 
$app = new \Slim\Slim(); //instancia de la clase Slim

//routing 
//accediendo VIA URL
//http:///www.google.com/

//localhost/apiRest/index.php 
$app->get(
    '/',function() use ($app){
    	
    	//consultas a la base de datos 
    	// peticiones a otro rest 
    	// etcetera
    	$datos = array(
    					"nombre" => "David", 
    					"edad" => "28"
    					);

    	//json 
        echo json_encode($datos);
    }
)->setParams(array($app)); 

//localhost/apiRest/index.php/usuario/paco 
    // "Hola,bienvenido Paco"
$app->get(
    '/usuario/:nombre',function($nombre) use ($app){
    	$id = $nombre;
    	//almaceno el ID
    	//conexion con base de datos
    	//el proceso
    	// retorno un JSON
        echo "Hola,bienvenido " . $nombre; 
    }
);

//inicializamos la aplicacion(API)
$app->run();

