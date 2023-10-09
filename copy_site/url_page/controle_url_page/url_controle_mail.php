<?php 

/*
HAROUNA Harouna 

controle mail recrute 
8/25/2023
mail_recrute.

*/


require_once("../../function_php/url_mysql.php"); 
require_once("../../function_php/private_connect/root_mail_sms.php");


class mail_insert_controle extends __root_mysql{

public $_mail;

public function __construct()
{
  

}
public function _select_mail($id_re){
  
    //$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");
    $dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
    $prepare = "SELECT * FROM info_recrute, code_t_cc_in WHERE info_recrute.id_recrute=:id_recrute AND  code_t_cc_in.id_recrutre_tccin=:id_recrutre_tccin";
    $select_array =array(":id_recrute"=>$id_re,":id_recrutre_tccin"=>$id_re);
    $select_mail =$this->__select($prepare,$select_array,false,$dbh);


    $_send_mail = new root_mail_sms();
    $_message  = "<h3> Hello, ".$select_mail["info_company_recrute"]." </h3> </br>  <hr>";
    $_message .= "<h4> Information Resume : T , CC , In  </h4> </br> <hr>";
    $_message .="T  : ".$select_mail["c_t"]." , </br> </hr>";
    $_message .="CC : ".$select_mail["c_cc"]." , </br> </hr>";
    $_message .="IN : ".$select_mail["c_in"]."</br> </hr>";

    
    //$contenumail,$pmail,$pform,$psujet,$ptitle,$piedpage, $pdonnearray, $commentmail
    $_array_donne = array("resultat"=>true, "r_id"=>base64_encode($select_mail["id_recrute"])  ,"r_active"=>$select_mail["info_active"], "r_email"=>$select_mail["info_email"]);
    $info_compagny = $select_mail['info_company_recrute'] ;

    return $_send_mail->cssmail($_message,$select_mail["info_email"],"hharouna@resumehharouna.net","T, CC , IN $info_compagny  by Harouna Harouna", "","resumehharouna.net",$_array_donne,"");
 
} 



}

extract($_POST);


$form_id= preg_replace('#[^a-zA-Z0-9=@._-]#i','', $form_id);
$decode_base64_form_id= base64_decode($form_id);

$mail_insert_controle = new mail_insert_controle(); 

echo $mail_insert_controle->_select_mail($decode_base64_form_id); 





?>