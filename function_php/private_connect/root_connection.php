<?php

extract($_POST);




include_once("../../secure.vetechdesign.net/root_session/root_session.php");
include_once("root_access.php");




$_root_session = new f_session();
$_root_access = new root_db_connect();

$_root_session->session("root",false,"");//

//$sms_curl = $_root_access->root_sms("2250749989779", "je t aime tu me manque");
 
if($token_nav==$_SESSION['nav_root'] || $nav==$_SESSION['nav_root']):
    echo $sms_curl ;
endif; 

echo rand(101010, 202023);

?>