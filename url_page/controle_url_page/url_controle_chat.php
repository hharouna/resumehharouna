<?php 
extract($_GET); 

require_once("../../private/private_db_root.php"); 
require_once("../../function_php/url_mysql.php"); 
require_once("../../function_php/private_connect/root_mail_sms.php");
require_once("../../function_php/f_session/f_session.php");
require_once("../url_construtor/url_head.php");


/*
LISTE DES COMPORTEMENT SERVEUR

*/
$_HTTP_SERVER= $_SERVER['SERVER_ADR'];
$_HTTP_HOST= $_SERVER['HTTP_HOST'];
$_HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
$_HTTP_REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];


$_sql_root = new __root_mysql(); 
$url_head = new url_head($_HTTP_HOST);
$url_session = new f_session();
$url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);

if(empty($_SESSION['chat_id'])):
   echo "Noting ";
    header("location: http://".$_SERVER['HTTP_HOST']); 
   endif;
   


if(isset($_SESSION['chat_id'])):
      /*active and creat cheat $url_session */
   $_prepare_chat= "UPDATE url_creat_assistance SET chat_active=:chat_active WHERE  session_id=:session_id ";
   $_array = array(":session_id"=>$url_connexion, ":chat_active"=>1);
   $_sql_root->__update($_prepare_chat,$_array,$db);
endif; 

/*-----

creaction function connect chat


recuperation de la session en function du chat
*/


?>

<!DOCTYPE html>
<html lang="en">

<?php

//$url_sept_page= $url_head->_url_head; // ------------ 



echo $url_head->_url_head;


?> 
</html>