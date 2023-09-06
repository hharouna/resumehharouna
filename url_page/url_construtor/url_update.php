<?php 

/*
07/10/2022

la class update ferivira la mise a jour en cours  

*/
require_once("../../function_php/url_mysql.php");

class url_update extends __root_mysql{



public $url_msg_update; 

public $array_select, $array_requete,$result_mysql;



public function __construct($HOST, $HOST_DB)
{
    $this->url_msg_update = $this->controle_update($HOST_DB);
}


public function update(){

}
public function controle_update($_DB){

$this->array_select ="SELECT * FROM url_update";
$this->array_requete=array();

$this->result_mysql= $this->__select($this->array_select,$this->array_requete,false,$_DB);

return $this->result_mysql; 

}



}





?>