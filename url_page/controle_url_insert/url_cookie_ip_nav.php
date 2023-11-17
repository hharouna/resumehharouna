<?php


require_once("function_php/private_connect/root_mail_sms.php");
require_once("function_php/url_mysql.php");
 
class url_cookie_ip_nav extends __root_mysql{
 public $ip_cookie_connect, $select_ip;
   public function __construct()
   {
    
   }

    public function ip_nav($_db, $sql,$array_nav){

        $prepare_select = "SELECT * FROM ip_cookie_connect WHERE  nav_ip_adress=:nav_ip_adress"; 
        $array_select = array(":nav_ip_adress"=>$array_nav['ip_nav']); 
        $this->select_ip= $this->__select($prepare_select,$array_select,false,$_db); 

        $_send_mail = new root_mail_sms();
        $_array_donne = array("Ip: "=>$array_nav['ip_nav'], "Nav : " => $array_nav['nav']);
        $_message = "Ip : ".$array_nav['ip_nav']."Nav : ".$array_nav['nav']; 

        if(empty($this->select_ip)):

        $prepare = "INSERT INTO ip_cookie_connect(nav_ip_adress,nav_consult) VALUES (:nav_ip_adress,:nav_consult)";
        $array = array(':nav_ip_adress'=>$array_nav['ip_nav'],':nav_consult'=>$array_nav['nav']); 
        $this->ip_cookie_connect =$this->__insert($prepare,$array,$_db);
       
        $_send_mail->cssmail($_message,"hharouna86usa@gmail.com","hharouna@resumehharouna.net","New ip and nav connect", "","resumehharouna.net",$_array_donne,"");
        
        else : 
      if(date($this->select_ip["date_ip_nav_cookie"])!=date("d")):
        //2023-10-05 16:03:36    afert 
     endif;
        $_send_mail->cssmail($_message,"hharouna86usa@gmail.com","hharouna@resumehharouna.net","New ip and nav connect", "","resumehharouna.net",$_array_donne,"");
  
        endif;   
        if($this->ip_cookie_connect):
        $form_contract = true;
        else:
        $form_contract =false;
        endif;

    }


    public function ip_nav_consulter($_db, $sql,$array_nav){

      $prepare_select = "SELECT * FROM ip_cookie_connect WHERE  nav_ip_adress=:nav_ip_adress"; 
      $array_select = array(":nav_ip_adress"=>$array_nav['ip_nav']); 
      $this->select_ip= $this->__select($prepare_select,$array_select,false,$_db); 

      $_send_mail = new root_mail_sms();
      $_array_donne = array("Ip: "=>$array_nav['ip_nav'], "Nav : " => $array_nav['nav']);
      $_message = "Ip : ".$array_nav['ip_nav']."Nav : ".$array_nav['nav']; 

      if(empty($this->select_ip)):

      $prepare = "INSERT INTO ip_cookie_connect(nav_ip_adress,nav_consult) VALUES (:nav_ip_adress,:nav_consult)";
      $array = array(':nav_ip_adress'=>$array_nav['ip_nav'],':nav_consult'=>$array_nav['nav']); 
      $this->ip_cookie_connect =$this->__insert($prepare,$array,$_db);
     
      $_send_mail->cssmail($_message,"hharouna86usa@gmail.com","hharouna@resumehharouna.net","Consultation du resumehharouna", "","resumehharouna.net",$_array_donne,"");
      
      else : 
    if(date($this->select_ip["date_ip_nav_cookie"])!=date("d")):
      //2023-10-05 16:03:36    afert 
   endif;
      $_send_mail->cssmail($_message,"hharouna86usa@gmail.com","hharouna@resumehharouna.net","Consultation du resumehharouna", "","resumehharouna.net",$_array_donne,"");

      endif;   
      if($this->ip_cookie_connect):
      $form_contract = true;
      else:
      $form_contract =false;
      endif;

  }
}







?>