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

//$dbh =  ('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
*/
define("HOST_DB","mysql:host=localhost;dbname=resumehharouna");
//USER ET MOT DE PASSE 
define("HOST_USER","root");
define("HOST_PASS","0000001LE@");

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