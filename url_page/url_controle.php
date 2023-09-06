<?php

require_once("function_php/url_mysql.php");

class url_controle extends __root_mysql{

public $affiche , $__db ,$array_select, $array_requete, $result_mysql;

public function __construct($_HTTP_HOST_,$_HTTP_USER_AGENT_,$db_)
{
    /*controle page */

$this->affiche = "test".$_HTTP_HOST_.$_HTTP_USER_AGENT_."/-------------\/ commande";

}

public function contenu($__db){

    $this->array_select ="SELECT * FROM info_recrute";
    $this->array_requete=array();
    
    $this->result_mysql= $this->__select($this->array_select,$this->array_requete,false,$__db);
    
    return $this->result_mysql["info_email"]."/----// ".$this->result_mysql["info_company_recrute"]."/----// ".$this->result_mysql["date_recrute"]; 
    

}


}













?>