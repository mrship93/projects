<?php

session_start();

	// Наш FRONT CONROLLER

	ini_set('display_errors',1);   // Показывать ошибки на сайте
	error_reporting(E_ALL);
	
	
	
	
	define('ROOT', dirname(__FILE__));
	require_once(ROOT.'/components/autoload.php');
	require_once(ROOT.'/components/Router.php');  // Подключаем роутер, используя константу и функцию dirname (так получаем путь к нашему роутеру)
	
	
	
	$router = new Router();
	$router -> run();
	
	




?>