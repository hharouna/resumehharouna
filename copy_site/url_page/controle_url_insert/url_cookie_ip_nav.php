<?php


require_once("function_php/url_mysql.php");
 
class url_cookie_ip_nav extends __root_mysql{
 public $ip_cookie_connect;
   public function __construct()
   {
    
   }

public function ip_nav($_db, $sql,$array_nav){

    $prepare = "INSERT INTO ip_cookie_connect(nav_ip_adress,nav_consult) VALUES (:nav_ip_adress,:nav_consult)";
    $array = array(':nav_ip_adress'=>$array_nav['ip_nav'],':nav_consult'=>$array_nav['nav']); 

    $this->ip_cookie_connect =$this->__insert($prepare,$array,$_db);
 
    if($this->ip_cookie_connect):
    $form_contract = true;
    else:
    $form_contract =false;
    endif;

}
}








?>