<?php 
extract($_POST);

require_once("../../private/private_db_root.php"); 
require_once("../../function_php/url_mysql.php"); 
require_once("../../function_php/private_connect/root_mail_sms.php");
require_once("../../function_php/f_session/f_session.php");


class assistance extends __root_mysql{

public function __construct()
{
    
}

public function assistance(){

   
}

public function creat_session_id($_db){
    $_SESSION['chat_id']=rand(1521256326,7521256326);
    $prepare_sql = "INSERT INTO url_creat_assistance(session_id, chat_active) VALUES (:session_id, :chat_active)"; 
    $array = array(":session_id"=>$_SESSION['chat_id'], ":chat_active"=>0);
    $insert_rsp_rsq = $this->__insert($prepare_sql,$array,$_db); 
    
    sleep(2);
    /*
    $prepare_sql_select = "SELECT url_asistance FROM id_assistance=:id_assistance"; 
    $array_select = array(":id_assistance"=>$insert_rsp_rsq);
    
    $select_rsp_rsq = $this->__select($prepare_sql_select,$array_select,false,$_db); 
    */
        $_send_mail = new root_mail_sms();
        $script_upate="<script>
        (function() {
            // log all calls to setArray
         creat_chat ={
            chat: function chat_update(){
                alert('ok')
            }

         }
  setInterval(creat_chat.chat(), 10);  
          })();
        </script>";
        $_array_donne = array("resultat"=>true,"msg"=>"connect load", "connexion"=>$_SESSION['chat_id'], "last_insert"=>$insert_rsp_rsq,"update"=>$script_upate);
    
        $_message  ="nouvelle demande de connection chat : <a href='https://resumehharouna.net/chat/session/".$_SESSION['chat_id']."'> <h2>GO</h2> </a>";
    
        return  $_send_mail->cssmail($_message,"hharouna86usa@gmail.com","hharouna@resumehharouna.net","Demande de chat avec ".$_SESSION['chat_id'], "","resumehharouna.net",$_array_donne,"");
    
   
}


public function assistance_rsp_rsq($_db,$rsp_rsq, $val_rsp_rsq,$ip_rsp_rsq,$_session_chat_id){

$prepare_sql = "INSERT INTO url_asistance(ip_$rsp_rsq,msg_$rsp_rsq) VALUE (ip_$rsp_rsq,msg_$rsp_rsq)"; 
$array = array(":msg_$rsp_rsq"=>$val_rsp_rsq,":ip_$rsp_rsq"=>$ip_rsp_rsq);
$insert_rsp_rsq = $this->__insert($prepare_sql,$array,$_db); 

sleep(2);

$prepare_sql_select = "SELECT url_asistance FROM id_assistance=:id_assistance"; 
$array_select = array(":id_assistance"=>$insert_rsp_rsq);

$select_rsp_rsq = $this->__select($prepare_sql_select,$array_select,false,$_db); 

    $_send_mail = new root_mail_sms();
    $_array_donne = array();

    $_message  ="<h4>Company connect</h4></hr>";

$_send_mail->cssmail($_message,"hharouna86usa@gmail.com","hharouna@resumehharouna.net","Demande echange", "","resumehharouna.net",$_array_donne,"");

return json_decode($select_rsp_rsq); 
}

public function assistance_rsq(){


}

}

$_HTTP_SERVER= $_SERVER['SERVER_ADR'];
$_HTTP_HOST= $_SERVER['HTTP_HOST'];
$_HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
$_HTTP_REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

$assistance = new assistance(); 
$url_session = new f_session();
$url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);

if(isset($chat)&&$chat=='creat'){
    unset($_SESSION['chat_id']);
//$_SESSION['chat_id']=rand(1521256326,7521256326);
echo $assistance->creat_session_id($db); 
}

















?>