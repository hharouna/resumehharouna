<?php

extract($_GET);


/*
///http://resume:8887/url_page/url_sept/url_sept.php?url_sept=url_sept_1
echo "commande /---/ ".$url_sept; 
exit; 

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
url_sept.php?$url_sept=url_sept_1 

http://resume:8887/url_page/url_sept/url_sept.php?url_sept=url_sept_1
recriture du lien    
http://resume:8887/sept_url/url_sept_1

LISTE DES COMPORTEMENT SERVEUR

*/
$_HTTP_SERVER= $_SERVER['SERVER_ADR'];
$_HTTP_HOST= $_SERVER['HTTP_HOST'];
$_HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
$_HTTP_REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
/**/
//require_once("../../private/private_resume.php");
/*
$npath =  dirname(dirname(dirname(__FILE__)))."/function_php/f_session/f_session.php";
$npath = str_replace('\\', '/', $npath);
var_dump($npath);
exit; */

require_once("../../function_php/f_session/f_session.php");
require_once("../../function_php/url_mysql.php");

require_once("../url_construtor/url_head.php");
require_once("../url_construtor/url_foot.php");
require_once("../../private/private_db_root.php"); 

//$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
//$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");

$id_recrute = base64_decode($url_recrute);

$url_session = new f_session();
$url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);

$url_mysql = new __root_mysql();
$prepare_recrutre = "SELECT * FROM info_recrute,url_sept WHERE info_recrute.id_recrute=:id_recrute AND info_recrute.id_recrute=url_sept.url_id_info_recrute";

$array_recrutre= array("id_recrute"=>$id_recrute);
$select_recrutre = $url_mysql->__select($prepare_recrutre,$array_recrutre,false,$db); 

if($_SESSION['E_MAIL']!=$select_recrutre['info_email'] ||  $select_recrutre==false):

 unset($_SESSION['E_MAIL']);
 unset($_SESSION['info_recrute']); 
 $url_session->f_deconnect("hharouna",true,$_SERVER['SERVER_NAME']);
 header("location: http://".$_SERVER['HTTP_HOST']); 

  exit; 
endif; 
// INFORNATION RECRUTEUR


$_SESSION['info_recrute'] = $select_recrutre;
//var_dump($_SESSION['info_recrute']);
//$_SESSION['harouna']="harouna";
$url_head = new url_head($_HTTP_HOST);
$url_foot = new url_foot();



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

$url_sept_page= $url_head->_url_head;
if(isset($url_sept)&& $select_recrutre==true):
   require_once("url_sept_page/$url_sept.php");
  
   require_once("url_sept_function.php");
   
 $url_html_sept = new url_sept_page(); 
 $url_sept_function = new url_sept_function($url_sept);

 $url_sept_page.= $url_sept_function->sept_progress($_SESSION['info_recrute']['id_recrute'],$url_sept,$db);
 //$url_sept_page.= $url_sept_function->style_background($url_sept);
   
 $url_sept_page.= '<div class="container-lg shadow-sm rounded bg-light text-light p-2 mb-5" style ="margin-top:100px;  ">';
 $url_sept_page.=  $url_sept_function->html_sept($url_sept,$db);//initialisation du contenu sept 
 
 $url_sept_page.=  $url_html_sept->url_sept_html($url_sept,$db);// initialition du contenu url_sep_N
 $url_sept_page.=  "</div>";

 
 
else:
     unset($_SESSION['info_recrute']);
     header("location: http://".$_SERVER['HTTP_HOST']); 
endif;
$url_sept_page.= $url_foot->foot;
 


echo  $url_sept_page; 


?>

    

</html>