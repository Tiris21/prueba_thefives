<?php 
	require_once "Config/Autoload.php";
	#require_once "ambiente.php";

	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)) . DS);
	
	define('AMBIENTE', 'dev');
	define('URL', 'http://localhost/prueba_thefives/');
	
	date_default_timezone_set('America/Mexico_City');
	setlocale(LC_ALL,"es_ES");
	
	Config\Autoload::run();

	session_start(); #INICIALIZACION DE LA VARIABLE DE SESSION

	Config\Enrutador::run(new Config\Request());

 ?>