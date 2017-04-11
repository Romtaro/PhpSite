<?php
//--------- BDD
$mysqli = new mysqli("azeqsd", "root", "root", "site");
if ($mysqli->connect_error) die('Un probl�me est survenu lors de la tentative de connexion � la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("utf8");

//--------- SESSION
session_start();

//--------- CHEMIN
define("RACINE_SITE","/PhpSite/SitePhp/");

//--------- VARIABLES
$contenu = '';

//--------- AUTRES INCLUSIONS
require_once("fonction.inc.php");
