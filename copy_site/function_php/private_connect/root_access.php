<?php

define('nav', $_SERVER["HTTP_USER_AGENT"]);//
define('ip', $_SERVER["REMOTE_ADDR"]);//

class root_db_connect{

public function controle_root_access($_base, $_name_db,$_info_connect,$__u){
		$root_explode= explode("/-/",$_info_connect); 
		$_adress_email =  $root_explode[0]; 
		$_mdp = $root_explode[1]; 
		
        $arraycompte = array($_adress_email , $_mdp); 
		$com = array("Le champ Adresse E-mail est vide",
		 "Le champ mot de passe est vide !!!"); 
		$c=count($arraycompte); 
		
		for($i=0; $i<$c; $i++){
			// -- compte -- // 
			if($arraycompte[$i]==''): 
			return json_encode(array("code"=>"0","contenu"=>$com[$i]));  exit(); endif; 
			}; 
    
    //oot_prenom 	root_nom 	id_root_admin 	root_mail 	root_user 	root_niveau 	root_mdp 	root_date 
	  $q= $_base->prepare('
		  SELECT 
		  '.$_name_db['root_db'].'.root_admin.id_root_admin as id_root,
		  '.$_name_db['root_db'].'.root_admin.root_nom as nom,
		  '.$_name_db['root_db'].'.root_admin.root_prenom as prenom,
		  '.$_name_db['root_db'].'.root_admin.root_contact as contact,
		  '.$_name_db['root_db'].'.root_admin.root_user as user,
		  '.$_name_db['root_db'].'.root_admin.root_mdp as mdp,
		  
		  '.$_name_db['root_db'].'.root_admin.root_date as root_date,
		  '.$_name_db['root_db'].'.root_admin.root_niveau as niveau
		  FROM 
		  '.$_name_db['root_db'].'.root_admin
		  WHERE 
		  '.$_name_db['root_db'].'.root_admin.root_mail=:email');
        $q->execute(array(':email'=>$_adress_email));
        $countselect = $q-> rowCount();
        $rs_info = $q-> fetch();
		
if(isset($countselect)&&$countselect>=1):
    $mdp_verify = $__u->__c_verify_mdp($_mdp,$rs_info["mdp"]); 
  if($mdp_verify==1):  

    $n = $rs_info["niveau"];
	if($n==1):
    $_SESSION["root_session"]=array(
                'id_info'=>$rs_info["id_root"],
                'nom'=>$rs_info["nom"],
                'prenom'=>$rs_info["prenom"],
                'contact'=>$rs_info["contact"],
                'email'=>$rs_info["email"],
                'mdp'=>$rs_info["mdp"],
                'date'=>$rs_info["root_date"],
                'nav'=>nav,
                'ip'=>ip,
                'type' => $rs_info["niveau"]   
	 ); 
            $_url_return = json_encode(array("code"=>1, "url"=>$this->connect_client));
            return($_url_return); 
	exit();
    
	elseif($n==2):
    $_SESSION["INFO_CONNECTER"]=array(
                'id_info'=>$rs_info["id_info"],
                'nom'=>$rs_info["nom"],
                'prenom'=>$rs_info["prenom"],
                'contact'=>$rs_info["contact"],
                'email'=>$rs_info["email"],
                'mdp'=>$rs_info["mdp"],
                'date'=>$rs_info["date_insc"],
                'nav'=>nav,
                'ip'=>ip,
                'type' => $rs_info["type"]   
	 ); 
	$_url_return = json_encode(array("code"=>1, "url"=>$this->connect_dessinateur));
	return($_url_return); 
	exit();
    elseif($n==2):
    	$_url_return = json_encode(array("code"=>1, "url"=>$this->site_serveur));
	    return($_url_return); 
	    exit();
	elseif($n==10):	
        $_url_return = json_encode(array("code"=>0, "contenu"=>"Vérifier votre adresse E-mail !!! "));
        return($_url_return); 
        exit();
    endif; 
    
    else: 
    
         return json_encode(array("code"=>"0","contenu"=>'Erreur sur votre mot de passe !!!'));  exit();
    endif; 
  

	

	
	 else: 

    	return json_encode(array("code"=>"0","contenu"=>' Vérifier votre adresse E-mail !!!'));  exit();
    
    
    endif;


	
		 
		 
		 
	 }
	


public function root_controle_nav(){
   // function controle nav_root acces page / page active nav  lien=>/active?code=0000001Le


	}
	
public function root_active_nav($_code_000001Le){




}
	
}






?>