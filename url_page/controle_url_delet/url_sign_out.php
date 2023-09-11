<?php 
/* HAROUNA HAROUNA 
9/11/2023
SESSION SIGN OUT 
*/
require_once("../../function_php/f_session/f_session.php");
$url_session = new f_session();
    
$url_session->f_deconnect("hharouna",true,$_SERVER['SERVER_NAME']);
header("location: http://".$_SERVER['HTTP_HOST']); 
exit; 


?>