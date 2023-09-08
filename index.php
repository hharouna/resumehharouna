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
require_once("private/private_resume.php");

require_once("url_page/url_controle.php");
require_once("function_php/f_session/f_session.php");
require_once("url_page/url_construtor/url_head.php");
require_once("url_page/url_construtor/url_body.php");
require_once("url_page/url_construtor/url_foot.php");
//
$url_session = new f_session();
$url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);

if(isset($_SESSION['info_recrute'])):
header("location: https://".$_HTTP_HOST."/sept_url/url_sept_1/".base64_encode($_SESSION['info_recrute']['id_recrute'])); 
endif;
/**/
$url_head = new url_head($_HTTP_HOST);
$url_body = new url_body();
$url_foot = new url_foot();
$url_page = new url_controle($_HTTP_HOST,$_HTTP_USER_AGENT,$dbh);



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


echo $url_head->_url_head.$url_body->html_body.$url_foot->foot; 


?>

    

</html>