
<?php

//Si controller pas objet
//header('Location: Controleur/adminController.php');
//si controller objet
//chargement config

//chargement autoloader pour autochargement des classes
//require_once(__DIR__.'/config/Autoload.php');
//Autoload::charger();


require_once './config/config.php';

//require './Controleur/adminController.php';
//$cont = new adminController();

//require './Controleur/userController.php';
//$cont = new userController();

require './Controleur/frontController.php';
$f = new frontController();

