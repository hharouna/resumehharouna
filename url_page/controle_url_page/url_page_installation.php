<?php

class url_page{
 
/*
harouna harouna 

8/19/2022

la page_container() dans url_body recois en require_once(lien) 
  
-> le lien et la class new url_page correspondant a la page appeler a l'affichage
  
$_url,$_dir,$_conditon,$_token,$_other;

*/


public $_url,$_dir,$_conditon,$_token,$_other,$_page_container,$list_pays, $url_host ;



  public function __construct($_HOST,$_url_decode,$page_db,$page_root_mysql)
  {


    /*
    array("url"=>$_url,"dir"=>$_dir,"condition"=>$_conditon,"token"=>$this->__token,"other"=>$_other))

    parametre ID = 
    array("ID_continent"=>$_fecthAll['ID_continent'])
    */
    $this->_url = $_url_decode["url"];
    $this->_dir = $_url_decode["dir"];
    $this->_conditon = $_url_decode["condition"];
    $this->_token = $_url_decode["token"];
    $this->_other = $_url_decode["other"];
    $this->url_host =$_HOST;
 


  }
  


  public function page(){

    return $this->page_container();

  }
  public function page_container(){

    $this->_page_container ='<div class="position-absolute top-50 start-50 translate-middle W-50 "><div class="container-lg shadow-sm  bg-secondary mt-2 p-2 rounded" >';
    $this->_page_container.='<div class="row"> 
    <span class="m-2 text-center text-light " id="inputGroup-sizing-lg"><h2> Merci d\'entrer l\'identifiant</h2></span>
    <span class="m-2 text-center text-light " id="inputGroup-sizing-lg"><h4> Exemple: ci-xxxxxx-xxxxxx-xxxxxx-xxxxxx-xxxxxx </h4></span><div class=" input-group input-group-lg">';
    $this->_page_container.='<span class="input-group-text" id="inputGroup-sizing-lg">Identifant Pays</span>';
    $this->_page_container.='<input type="text"  maxlength="2" class="form-control text-center x_n" token="" placeholder="PP"   x_n="x0" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">';
    $this->_page_container.='<input type="text" maxlength="6" class="form-control text-center  x_n x1" identifiant="" x_n="x1"  placeholder="XXXXXX" disabled="false" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">';
    $this->_page_container.='<input type="text" maxlength="6"  class="form-control text-center x_n x2" identifiant="" x_n="x2"  placeholder="XXXXXX" disabled="false" aaria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">';
    $this->_page_container.='<input type="text" maxlength="6"  class="form-control text-center  x_n x3" identifiant="" x_n="x3"  placeholder="XXXXXX" disabled="false" aaria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">';
    $this->_page_container.='<input type="text" maxlength="6"  class="form-control text-center  x_n x4" identifiant="" x_n="x4"  placeholder="XXXXXX" disabled="false" aaria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">';
    $this->_page_container.='<input type="text" maxlength="6"  class="form-control text-center  x_n x5" identifiant="" x_n="x5"  placeholder="XXXXXX" disabled="false" aaria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">';
    $this->_page_container.='</div></div> ';
    $this->_page_container.=' <div class="progress mt-1" style="height: 2px;">
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" aria-label="Example 1px high" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>';
  
    $this->_page_container.=' <div class="container resultat alert "> </div> </div></div>';

        
    return $this->_page_container;

  }


  public function generate_url($_url,$_dir,$_conditon,$_other)
  {

        /*
        encodage de l'url avec base64_encode
        */
        $encode_url = base64_encode(base64_encode(json_encode(array("url"=>$_url,"dir"=>$_dir,"condition"=>$_conditon,"token"=>$this->__token,"other"=>$_other)))); 

        return  $encode_url ; 
  }

}



?>