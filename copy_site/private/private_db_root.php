<?php 

// function define
include_once("private_acces.php");
//$connect = new HOST();

try{
	$db = new PDO(HOST::$HOST, HOST::$USER, HOST::$PASS);
	//$db_admin = new PDO(HOST::$HOST_ADMIN, HOST::$USER, HOST::$PASS);
    $db-> setAttribute(PDO::ATTR_ERRMODE, 'ATTR_EXCEPTION');
	$db-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8'");
   }
catch(PDOException $e){
die('Erreur :' .$e-> getMessage("Probléme de connexion !!! "));
	};

?>