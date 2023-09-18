<?php 

class f_session{
                
    public function __construct(){

    }
    public function session($_url_session_name,$_true_false,$_domaine){
        $temps	   =  date("Y-d-m"); 
        $j=60*60*24;  //-- date actuelle de la machine 
        $Jstrtotime = strtotime($temps)+$j; // valeur du jour actuel en seconde...
        $tempspremis  = $Jstrtotime; ; // durée de la session
        $valeur = session_id();
        $dossier   = "/" ;// dossier de stockage de la session
        $domain   = $_domaine ;
        $https  =  $_true_false; //isset($_SERVER['HTTPS'] );
        $httponly  = $_true_false; 


    session_name($_url_session_name);
    session_set_cookie_params($tempspremis,$dossier,$domain,$https,$httponly);// parametre de sécurité de 
                if(session_id() == '') {
                   session_start();
                }
                else
                {
                   session_start();
                }
    /* function session
    gestion des cokkies pour le bon function du site
    */


    }  
    public function f_deconnect($_url_session_name,$true_false,$_domaine){
        /*
        sauvegarde des functions session pour annalyse des pages visiter 
        et controle le nombre de visite par jours 
        */
       // FUNCTION FIN DE SESSION  DE DECONNEXION
		           
				session_name($_url_session_name);
				//
				$J	        = date('d-m-Y');  //-- date actuelle de la machine 
              	$Jstrtotime = strtotime($J); // valeur du jour actuel en seconde...
		        $nomsession ='hharouna';
				$tempspremis  = $Jstrtotime+(60*60*24) ;
				$dossier   = "/" ;
				$domain   = $_domaine ;
				$https  =  $true_false; //isset($_SERVER['HTTPS'] );
				$httponly  = $true_false; 
				//session_start();// demarrage de la session start
				if(session_id() == '') {
						 session_start();
						}
						session_regenerate_id(true); // changer la valeur de ID  DU COOKIE
		        //$valeur = session_id();
                //session_unset($_SESSION);
                session_destroy();
				session_set_cookie_params($tempspremis,$dossier,$domain,$https,$httponly);// parametre de sécurité de session 
				//setcookie($nomsession,$valeur,$tempspremis,$dossier,$domain,$https,$httponly);
			    //setcookie("PHPSESSID", $_COOKIE["PHPSESSID"], $tempspremis,$dossier,$domain,$https,$httponly);
		
        
        
    }
    public function f_deconnet_(){
        /*
           deconnexion page
        */
        
        session_name('__vetech_formation');
				session_unset($_SESSION);
				session_destroy();
				session_write_close();
				$J	        = date('d-m-Y');  //-- date actuelle de la machine 
              	$Jstrtotime = strtotime($J); // valeur du jour actuel en seconde...
		        $nomsession ='__vetech_formation';
				$tempspremis  = $Jstrtotime+(60*60*24) ;
				$dossier   = "/" ;
				$domain   = "" ;
				$https  =  false; //isset($_SERVER['HTTPS'] );
				$httponly  = true; 
				//session_start();// demarrage de la session start
				 
				if(session_id() == '') {
						 session_start();
						}
						session_regenerate_id(true); // changer la valeur de ID  DU COOKIE
        
    }
    
    
} ?>