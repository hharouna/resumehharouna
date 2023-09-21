<?php 
/* HAROUNA HAROUNA 
9/11/2023
SESSION SIGN OUT 
*/
require_once("../../function_php/f_session/f_session.php");
$url_session = new f_session();
    
$url_session->f_deconnect_("hharouna",true,$_SERVER['SERVER_NAME']);
header("location: https://".$_SERVER['HTTP_HOST']); 
exit; 

hharouna:"n4gr45o1jb3k69sbtd4ptd0aq2"

?>