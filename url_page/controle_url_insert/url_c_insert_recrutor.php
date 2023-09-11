<?php
/*
/HAROUNA HAROUNA 
8/25/2023

*/


extract($_POST);
require_once("../../function_php/private_connect/root_mail_sms.php");
require_once("../../function_php/f_session/f_session.php");
require_once("../../function_php/url_mysql.php");
require_once("../../private/private_db_root.php"); 

class url_c_insert_recrutor extends __root_mysql{

    public $_mail_recrutor,$_user,$_info_compagny, $array_c, $resultat_c,$_ip, $select_info,$T,$CC,$IN, $array_tccin , $resultat_tccin, $select_tccin; 

    public function __construct($recrutor_mail, $compagny)
    {

    //require_once("../private/private_db_root.php"); 
        
        $this->_mail_recrutor = $recrutor_mail; 
        $this->_info_compagny = $compagny; 
        $this->_user= $_SERVER['HTTP_USER_AGENT'];
        $this->_ip = $_SERVER['REMOTE_ADDR'];
    }

 public function recrutor_controle($db_){
    //connexion db
/*
//$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");
$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
   */
    $prepare = "SELECT * FROM info_recrute WHERE info_email=:info_email";

    $select_array =array(":info_email"=>$this->_mail_recrutor);
    $this->select_info =$this->__select($prepare,$select_array,false,$db_);  
    $_rst = $this->select_info;

   if($_rst["info_email"]== $this->_mail_recrutor && $_rst["info_active"]==0 ): 

    $this->select_confirme_code($db_,$_rst["id_recrute"]); 
    return array("r_id"=>base64_encode($_rst["id_recrute"]),
    "r_tccin"=>base64_encode($this->select_confirme_code($db_,$_rst["id_recrute"])),
    "r_active"=>$_rst["info_active"], "r_email"=>$_rst["info_email"]); endif; 
    
   if($_rst["info_email"]== $this->_mail_recrutor &&  $_rst["info_active"]==1):  
    $_SESSION['E_MAIL']=$_rst["info_email"];
    return array("r_id"=>base64_encode($_rst["id_recrute"]),"r_active"=>$_rst["info_active"],"link"=>"http://".$_SERVER['HTTP_HOST']."/sept_url/url_sept_1/".base64_encode($_rst["id_recrute"])) ; endif;

   if(empty($_rst)): 
    return $this->recrutor_insert($db_); endif;

 }

 public function select_confirme_code($__db, $__id_recrute){
    
    $prepare = "SELECT * FROM code_t_cc_in WHERE id_recrutre_tccin=:id_recrutre_tccin";

    $select_array =array(":id_recrutre_tccin"=>$__id_recrute);
    $this->select_tccin =$this->__select($prepare,$select_array,false,$__db);  
    $_rst = $this->select_tccin["id_tccin"];

    return  $_rst;

 }
 public function form_Confirme_email(){

    $_confirme_email ='<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Confirme E-mail</h1>
    <button type="button" class="btn-close btn-info-r-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <div class="input-group">
    <span class="input-group-text">Code :</span>
    <input type="text" aria-label="First name"  placeholder="T: " class="form-control t">
    <input type="text" aria-label="Last name" placeholder="CC:" class="form-control cc ">
    <input type="text" aria-label="Last name" placeholder="In: " class="form-control in">
    </div>
    <div class="alert-confirme-code" > </div>
    </div>
    
    <div class="modal-footer">
    <div class="btn-group shadow-sm" role="group" aria-label="Basic mixed styles example">
    <button type="button" class="btn btn-success confirme-code btn-sm " id_tccin="'.base64_encode($this->resultat_tccin).'" form_id="'.base64_encode($this->select_info["id_recrute"]).'">Confirme code <i class="fa-solid fa-check"></i></button>
    <button type="button" class="btn btn-primary reload-code btn-sm " id_tccin="'.base64_encode($this->resultat_tccin).'"  form_id="'.base64_encode($this->select_info["id_recrute"]).'"> Relaod code <i class="fa-solid fa-rotate-right"></i></button>
    </div>
    
    </div>
    <div class="alert-reload-code " role="">  </div>
    </div>';
    return $_confirme_email;
 }
 public function recrutor_insert($__db){

    /* insertion des information company  */
    $this->array_c = array(":info_email"=>$this->_mail_recrutor,
    ":ip_recrute"=>$this->_ip,
    ":user_html"=>$this->_user,
    ":info_company_recrute"=>$this->_info_compagny); 
     
    $prepare = "INSERT INTO info_recrute(info_email,ip_recrute,user_html,info_company_recrute) 
    VALUES (:info_email,:ip_recrute,:user_html,:info_company_recrute)";
    $this->resultat_c= $this->__insert($prepare,$this->array_c,$__db); 

/* insertion des information company  */
    sleep(2);  

    $this->T  =rand(100000,200000);
    $this->CC =rand(458525,825632);
    $this->IN =base64_encode($this->resultat_c);
 
    $this->array_tccin = array(":id_recrutre_tccin"=>$this->resultat_c,":c_t"=>$this->T,
    ":c_cc"=>$this->CC,":c_in"=>$this->IN); 
  
    $prepare_tccin = "INSERT INTO code_t_cc_in(id_recrutre_tccin,c_t,c_cc,c_in) 
    VALUES (:id_recrutre_tccin,:c_t,:c_cc,:c_in)";
    $this->resultat_tccin= $this->__insert($prepare_tccin,$this->array_tccin,$__db); 
    
    /*recuperation des informations recruteur */
    $prepare = "SELECT * FROM info_recrute WHERE id_recrute=:id_recrute ";
    $select_array =array(":id_recrute"=>$this->resultat_c);
    $this->select_info =$this->__select($prepare,$select_array,false,$__db);  
    $_rst = $this->select_info;
   
    $_send_mail = new root_mail_sms();
    $_message  = "<h3> Hello, ".$_rst["info_company_recrute"]." </h3> </br>  <hr>";
    $_message .= "<h4> Information Resume : T , CC , In  </h4> </br> <hr>";
    $_message .="T  : ".$this->T." , </br> </hr>";
    $_message .="CC : ".$this->CC." , </br> </hr>";
    $_message .="IN : ".$this->IN."</br> </hr>";

    //$contenumail,$pmail,$pform,$psujet,$ptitle,$piedpage, $pdonnearray, $commentmail
    $_array_donne = array("r_id"=>base64_encode($_rst["id_recrute"])  ,"r_active"=>$_rst["info_active"], "r_email"=>$_rst["info_email"]);
    $info_compagny = $_rst['info_company_recrute'] ;
    return $_send_mail->cssmail($_message,$_rst["info_email"],"hharouna@resumehharouna.net","T, CC , IN $info_compagny  by Harouna Harouna", "","resumehharouna.net",$_array_donne,"");

}
}

    
$_array_preg = array($email, $compagny);
$_count_preg = count($_array_empty);

        for($i = 0; $i<=$_count_preg-1; $i++){
                $_array_preg[$i]= preg_replace('#[^a-zA-z0-9=@._-]#i','', $_array_preg[$i]);
        }

            $_array_empty = array($email, $compagny);
            $value = array("E-mail !!!","The Name Company !!!");
            $_count_array = count($_array_empty);

        for($i = 0; $i<=$_count_array-1; $i++){
                if(empty($_array_empty[$i])):
                    echo json_encode(array("contenu"=>"Require : $value[$i]","Error"=>0));
                    exit;
                    endif;
        }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)): 
    echo json_encode(array("contenu"=>"Adresse E-mail incorrect !!!","Error"=>0)); exit(); 
    endif; 


    $controle_insert_compagny = new url_c_insert_recrutor($email, $compagny); 
    $url_session = new f_session();
    $url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);
    
    // resultat des donnees    
    $_resultat = array('resultat'=> true, "r"=>$controle_insert_compagny->recrutor_controle($db), 
    "email"=>$controle_insert_compagny->_mail_recrutor,"form_tccin"=>$controle_insert_compagny->form_Confirme_email()); 


    if(isset($email)&& isset($compagny)):
    echo json_encode($_resultat); 
    exit; 
    else:
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
    endif; 

?>