<?php 


require_once("../../../private/private_db_root.php");
require_once("../../url_contrutor.php");
require_once("../../../function_php/url_mysql.php");


$_HTTP_HOST= $_SERVER['HTTP_HOST'];//lien du site 
$_HTTP_SERVER= $_SERVER['SERVER_ADDR'];
$_HTTP_HOST= $_SERVER['HTTP_HOST'];
$_array_session_url = array("name"=>"prendall", "truefalse"=>true,"domaine"=>$_HTTP_SERVER); 

$url   =new p_url($url,$_array_session_url);
$root_mysql  =new __root_mysql();
extract($_POST);

$url_cookies_session = new url_cookies_session($db,($url ->isSecure() ? 'https' : 'http')."://".$_HTTP_HOST,$root_mysql,$url_cookies_actives,$id_hua,$id_cookies);

echo json_encode(array("url_actives"=> $url_cookies_session->url_actives, "code"=>0) );

class url_cookies_session{
public $url_cookies,$url_cookies_contenu, $url_cookies_page,$host, $array_c, $prepare_c, $resultat,$resultat_c;
public $url_c_a, $id_hua,$id_cookies, $url_actives;
public function __construct($_db,$url_host,$url_mysql,$_url_cookies_actives,$_id_hua,$_id_cookies) 
{   
    
            $this->id_hua=$_id_hua;
            $this->id_cookies= $_id_cookies ;
            $this->host = $url_host ;

            if($_url_cookies_actives!=2):

                        if($_url_cookies_actives==1):

                        $this->url_c_a=0;

                        elseif($_url_cookies_actives==0):    
                        $this->url_c_a=1;
                        else:
                        $this->url_c_a=1;
                        endif;

        
$this->array_c = array(":tf_id_url_nav_cookies"=>$_id_hua,":id_url_cookies"=>$_id_cookies); 
$this->prepare_c ="SELECT * FROM url_prendall_net.url_cookies_truefalse 
WHERE 
url_prendall_net.url_cookies_truefalse.tf_id_url_nav_cookies=:tf_id_url_nav_cookies
 AND 
url_prendall_net.url_cookies_truefalse.id_url_cookies=:id_url_cookies ";
$this->resultat = $url_mysql->__select($this->prepare_c,$this->array_c,false,$_db); 

        if($this->resultat==true):


        $rs_truefalse=  $this->update_nav_cookies($url_mysql,$_db);
        
        $this->url_actives=true;// variable de confirmation 

        elseif($this->resultat==false):

        
        $this->insert_nav_cookies($url_mysql,$_db);
        $this->url_actives=true;// variable de confirmation 

        endif;

    else:
        $this->url_cookies_page =  true;
    $this->url_actives=true;// variable de confirmation 

    endif;


    
}

public function update_nav_cookies($_url_mysql,$__db){

    $this->array_c = array(":id_cookies_truefalse"=>$this->resultat["id_cookies_truefalse"],":truefalse"=>$this->url_c_a); 
    $this->prepare_c ="UPDATE url_prendall_net.url_cookies_truefalse SET url_prendall_net.url_cookies_truefalse.truefalse =:truefalse 
    WHERE 
    url_prendall_net.url_cookies_truefalse.id_cookies_truefalse=:id_cookies_truefalse ";
    $this->resultat_c = $_url_mysql->__update($this->prepare_c,$this->array_c,$__db); 
    $this->url_cookies_page =  $this->resultat_c;
  return true ; 
}
public function insert_nav_cookies($_url_mysql,$__db){

    $this->array_c = array(":tf_id_url_nav_cookies"=>$this->id_hua,":id_url_cookies"=>$this->id_cookies,":truefalse"=>0); 
   
    $this->prepare_c ="INSERT INTO url_prendall_net.url_cookies_truefalse(tf_id_url_nav_cookies,id_url_cookies, truefalse) 
    VALUES(:tf_id_url_nav_cookies,:id_url_cookies, :truefalse) ";
    $this->resultat_c= $_url_mysql->__insert($this->prepare_c,$this->array_c,$__db); 
    $this->url_cookies_page =  $this->resultat_c;
    var_dump($this->url_cookies_page);
}


}










?>