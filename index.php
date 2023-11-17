<?php

/*
dev : Harouna harouna 
date : 8/22/2023
*/

//---------------------------------------------------------
/*
   ouverture de la page index :

   p_url construct 

        regroupement de tous les elements de chargement de la page prendall.net
            -> menu
            -> recherche
            -> session de connection
            -> contenu 
            -> information 
            -> publication 
            -> pied de page 
            
  listes des bibliotheques
    
    -> jquery v3.2.1 
    -> bootstrap 5.1.3
    -> php version 7.3.12  -> infini
    -> python 3
    -> mysql  10.7.3-MariaDB

    */


extract($_GET);
/*
LISTE DES COMPORTEMENT SERVEUR

*/
$_HTTP_SERVER= $_SERVER['SERVER_ADR'];
$_HTTP_HOST= $_SERVER['HTTP_HOST'];
$_HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
$_HTTP_REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

$_array_nav = array('ip_nav'=>$_HTTP_REMOTE_ADDR,"nav"=>$_HTTP_USER_AGENT);
require_once("private/private_db_root.php");
//require_once("function_php/url_mysql.php");
require_once("function_php/f_session/f_session.php");
require_once("function_php/private_connect/root_mail_sms.php");
require_once("url_page/controle_url_insert/url_cookie_ip_nav.php");
require_once("url_page/url_construtor/url_head.php");
require_once("url_page/url_construtor/url_body.php");
require_once("url_page/url_construtor/url_foot.php");
//
    $url_session = new f_session();
    $url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);
    if(isset($_SESSION['E_MAIL'])):
    header("location: https://".$_HTTP_HOST."/sept_url/url_sept_1/".base64_encode($_SESSION['info_recrute']['id_recrute'])); 
    endif;

$url_head = new url_head($_HTTP_HOST);
$url_body = new url_body($db);
//$url_mysql = new __root_mysql();
$url_mysql = "";

/* insert for  cookies session connexion for all nav*/

$url_cookie_ip_nav =new url_cookie_ip_nav(); 
$r_ip_nav = $url_cookie_ip_nav->ip_nav($db,$url_mysql,$_array_nav);

/*

$_send_mail = new root_mail_sms();
$_array_donne = array("r_ip"=>$_HTTP_REMOTE_ADDR);

$_message  ="<h4>Connect index page</h4></hr>";
$_message .="<h3> IP  : </h3>". $_HTTP_REMOTE_ADDR ;
$_message .= "</hr> <h3> Navigateur n: </h3> " .$_HTTP_USER_AGENT;

$info_company=$_rst["info_company_recrute"];

$_array_donne = array("r_id"=>base64_encode($_rst["id_recrute"]),"r_active"=>$_rst["info_active"], "r_email"=>$_rst["info_email"]);

$_send_mail->cssmail($_message,"hharouna86usa@gmail.com","hharouna@resumehharouna.net","Compagny Connect :  $info_company", "","resumehharouna.net",$_array_donne,"");

*/
?>




<!DOCTYPE html>
<html lang="en">
<?php 

//$url_session->session("prendall",true,".".$_HTTP_REMOTE_ADDR);

/* Creation resume Harouna Harouna by myself 
 contenu : 
    information 
    summary 
    work exprerience 
    Education 
    Skills 
    Languages 
    quize recruteur
echo $url_page->affiche; 
echo $url_page->contenu($dbh); 

*/


echo $url_head->_url_head.$url_body->html_body


?>

    

</html>