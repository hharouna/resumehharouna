<?php

/*
dev : Harouna harouna 
date : 07/03/2022 
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
/*
Liste des require_once 
         "url/url_contrutor.php" // function construct de la index 
         "url/url_head.php" // liste des pages
*/


require_once("private/private_db_root.php");
require_once("function_php/url_mysql.php");

require_once("url/url_contrutor.php");

//require_once("url/url_construct/url_update.php");
require_once("url/url_construct/url_body.php");
require_once("url/url_construct/url_head.php");
require_once("url/url_construct/url_foot.php");
//require_once("url/url_construct/url_controle/url_nav_cookies/url_nav_cookies.php");


extract($_GET);
/*
LISTE DES COMPORTEMENT SERVEUR

*/
$_HTTP_SERVER= $_SERVER['SERVER_ADDR'];
$_HTTP_HOST= $_SERVER['HTTP_HOST'];
$_HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
$_HTTP_REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
/*
--------------

detail sur le nom de la session ouverte prendall
name => prendall : le nom de la session 
truefalse => true : la session est forcement ouverte en https
domaine => details sur le domaine 

*/
$_array_session_url = array("name"=>"prendall", "truefalse"=>true,"domaine"=>$_HTTP_SERVER); 
$array_select ="SELECT * FROM url_update WHERE url_update_active=:url_update_active";
//-------
// url_update_active => 1 la mise a jour est active donc le site function 
$array_requete=array(":url_update_active"=>1);

//__root_mysql() ensembles des functions sql insert,select,update,delete en PDO 
$root_mysql  =new __root_mysql();

// p_url() ensemble des functions initialisant la securite  
$url         =new p_url($url,$_array_session_url);

/*
 Token => sera utilisee pour une verification supplementaire dans l'ensemble des evenements, click, keyup etc... 
*/
$_SESSION['token']=$url->rand_token();// session de connexion demarrage 

//$url_update  = new url_update(($url ->isSecure() ? 'https' : 'http')."://".$_HTTP_HOST,$db); 
// url_head() ensembles de functions  initialize l'ensembles head 
 
$url_head    = new url_head(($url->isSecure() ? 'https' : 'http')."://".$_HTTP_HOST,$url_page); 

// url_body() ensembles de functions  initialize l'ensembles body
$url_boby    = new url_body($_SESSION['token'],($url ->isSecure() ? 'https' : 'http')."://".$_HTTP_HOST, $root_mysql,$db,$url_page); 

// url_foot() ensembles de functions  initialize l'ensembles foot
$url_foot    = new url_foot($_SESSION['token'],($url ->isSecure() ? 'https' : 'http')."://".$_HTTP_HOST, $root_mysql,$db,$url_page); 

/*
function sauvegarde, adresse ip , identifiant sur navigateur, recuperer  la liste des liens visites
P_url =
$url->url_nav_ip_cookies(); 
 
*/

//cette function permetra de recuperer l ensemble des liens visites pour permettre a analyser le comportemet des evenements.
$url->url_nav_ip_cookies($_HTTP_USER_AGENT,$_HTTP_REMOTE_ADDR,$db,$root_mysql,$url_page);

//---------------------------------------------------------


?>

<!DOCTYPE html>
<html lang="en">
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
    
      </div>
      
    </div>
  </div>
</div>

    <?php echo $url_head->_url_head; ?>

<body>

    <?php 

    //session_unset($_SESSION);
    $rs_select= $root_mysql->__select($array_select,$array_requete,true,$db);
    $_SESSION['update_active']= $rs_select;// SOCKAGE DE LISTE DES CONTINENTS
 
   
    if($rs_select==false):
      
         echo  "Site en maintenance....";

    elseif(isset($rs_select)):
        $rs_update = "" ; 
        foreach($rs_select['fectAll'] as $rs_fe => $_fecthAll){
            if($_fecthAll['url_update_active']==1):
            $rs_update.= $_fecthAll['url_update_active'];
            endif; 
          }
       // echo $url; 
        echo $url_boby->html_body.$url_foot->foot;
       


    endif; 



    ?>

    
</body>
</html>