<?php 
// REFERENCE A LA BASSE DE DONNEES 

// ZONE STRICTEMENT RESERVER ----***** MERCI DE NE PAS MODIFIER// TOUS DROIT RESERVER;
//LISTE DES HOSTS
/*
define('HOST_DB',"mysql:host=185.98.131.91;dbname=vetec1105121");
//USER ET MOT DE PASSE 
define('HOST_USER',"vetec1105121");
define('HOST_PASS',"0000001Le");
// ZONE STRICTEMENT RESERVER ----***** MERCI DE NE PAS MODIFIER// TOUS DROIT RESERVER;
//LISTE DES HOSTS
$valhostdb=""; 
*/
define("HOST_DB","mysql:78.138.45.54;dbname=c1prendall");
//USER ET MOT DE PASSE 
define("HOST_USER","admin");
define("HOST_PASS","43xOQ6X)q3J1B334");

class HOST{
	
		//LISTE DES HOSTS
		public static $HOST = HOST_DB;
		//public static $HOST_ADMIN = HOST_ADMIN;
		//public static $HOSTBOUTIQUE = HOST_DBBOUTIQUE;
		//USER ET LE MOT DE PASSE
		public static $USER = HOST_USER;
		public static $PASS = HOST_PASS;


};



?>