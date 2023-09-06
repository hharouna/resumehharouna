<?php

class url_page{
 
/*
harouna harouna 

7/31/2022

la page_container() dans url_body recois en require_once(lien) 
  
-> le lien et la class new url_page correspondant a la page appeler a l'affichage
  
$_url,$_dir,$_conditon,$_token,$_other;

*/


public $_url,$_dir,$_conditon,$_token,$_other,$_page_container,$list_pays, $pays, $url_host, $coordonne, $breadcrumb;



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
 


      $prepare = "SELECT * FROM earth_donne.earth_liste_pays WHERE earth_donne.earth_liste_pays.id_continent_list=:id_continent_list";
      $ex_array =array(":id_continent_list"=>$this->_conditon['ID_continent']);
      $r_list_continent =$page_root_mysql->__select($prepare,$ex_array,true,$page_db);



      $prepare_list_pays= "SELECT * FROM earth_donne.earth_liste_pays WHERE earth_donne.earth_liste_pays.id_list_pays=:id_list_pays";
      $ex__list_pays =array(":id_list_pays"=>$this->_conditon['id_list_pays']);
      $r_list_pays =$page_root_mysql->__select($prepare_list_pays,$ex__list_pays,false,$page_db);


    //id_coord_pays 	longitude 	latitude 	altitude 	zoom 	url_kml 	id_liste_pays 	date_coord

    $this->list_pays = $r_list_continent;
    $this->pays = $r_list_pays;


    $this->breadcrumb = array(array("ID_continent"=>$this->_conditon['ID_continent'],"url"=>$this->_conditon['name_continent'],"type"=>"Continent"),
    array("id_list_pays"=>$this->_conditon['ID_continent'],"url"=>$r_list_pays['pays'],"type"=>"Pays"));


    $_SESSION["Liste_pays"]= $r_list_continent; 

    $this->coordonne = array("latitude"=>7.90446544999999,"longitude"=>-1.0304069499999997);


  }



  public function page(){

    return $this->page_container();

  }
  public function page_container(){

      $this->_page_container ='<div class="container-md shadow-sm mt-2">';
      //---------------- 
      $this->_page_container .='<div class="container-md border-bottom p-1 rounded m-2">';
      $this->_page_container .='<div class="row" ><div class="col-1 col-sm-3">';
      $this->_page_container .=$this->breadcrumb_menu($this->breadcrumb);
      $this->_page_container .='</div></div>'; 
      //----------------
      $this->_page_container .='<div class="row">';
 
      //---------------- 
      $this->_page_container .='<div style="height: 750px;" class="col-12 col-sm-1 col-md-1 mb-1 mt-1 overflow-auto">';
      $this->_page_container .=$this->page_menu();
      $this->_page_container .='</div>'; 
      //----------------
      $this->_page_container .='<div style="height: 750px;" class="col-3 col-sm-3 col-md-3 mb-3 mt-0 border-start overflow-auto">';
      $this->_page_container .='<div class="container-md p-1 rounded ">';
      $this->_page_container .='<div class="row" >
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12 input-group input-group-sm pb-1 border-bottom ">
      <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa-solid fa-magnifying-glass-location"></i></span>
      <span class="input-group-text" id="inputGroup-sizing-sm">';
      
      $this->_page_container .='<div class="btn btn-default btn-sm shadow-sm btn-warning"><i class="fa-solid fa-circle-minus fa-1x "></i></div> <div class="ps-1">';
      $this->_page_container .= $this->pays['code_iso_l2']." : ";
      $this->_page_container .='</div></span>
      <input type="text" class="form-control" placeholder="Recherche" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>
        ';
      $this->_page_container .= '<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12">'.$this->_conditon['id_list_pays'].'</div>';
      $this->_page_container .='</div></div> '; 
     
      $this->_page_container .='</div>'; 

      //----------------
      $this->_page_container .='<div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xxl-8 border-start pt-3 mb-3">';
      $this->_page_container .=$this->page_contenu();
      $this->_page_container .='</div>';

      //----------------
      $this->_page_container .='</div>';
      $this->_page_container .='</div>';

   return $this->_page_container;

  }

  public function page_menu(){
       


    $m_list_pays = '<ul  class="nav flex-column ">';

    foreach($this->list_pays['fectAll'] as $rs_fe => $_fecthAll){

       

        $m_list_pays .= '<li class="nav-item border-bottom ">';
        $m_list_pays .= '<a class="nav-link p-0 m-1" href="#">  <img src="'.$this->url_host.'/p_creation_pays/Drapeaux/'.$_fecthAll['code_iso_l2'].'.png" alt="" width="60" height="48" title="prendall.net"> </a>';
        $m_list_pays .= '</li>';

    }
    $m_list_pays.=' </ul>'; 


    return  $m_list_pays; 

  }
  public function breadcrumb_menu($url_array){

    
    $_count_ex = count($url_array); 

    $resultat = '<div class="container  text-sx m-1" > <div class="d-flex flex-row " > <i class="fa-solid fa-link fa-1x"></i>'; 
    for($i=0; $_count_ex>$i;$i++){
    
 if($url_array[$i]['type']=="Pays"):

      $resultat.='<a class=" link-primary align-middle m-0 text text-link " href="'.$this->url_host.'/index_web.php?url_page='.$this->generate_url($url_array[$i]['type'].' '.$url_array[$i]['url'],"url_page/url_page_pays.php",array("ID_continent"=>$this->_conditon['ID_continent'],'name_continent'=>$this->_conditon['name_continent'],"id_list_pays"=>$url_array[$i]['id_list_pays']),"").'"> '.$url_array[$i]['url'].'</a>
      <i class="fas fa-angle-right fa-1x ms-1 me-1 mt-1 align-middle"></i>';

       elseif($url_array[$i]['type']=="Continent"):

        $resultat.='<a class=" link-primary align-middle m-0 text text-link " href="'.$this->url_host.'/index_web.php?url_page='.$this->generate_url($url_array[$i]['type'].' '.$url_array[$i]['url'],"url_page/url_page_continent.php",array("ID_continent"=>$this->_conditon['ID_continent'],'name_continent'=>$this->_conditon['name_continent']),"").'"> '.$url_array[$i]['url'].'</a>
        <i class="fas fa-angle-right fa-1x ms-1 me-1 mt-1 align-middle"></i>';

       endif;
    } 
    $resultat.= '</div></div>';
    return $resultat;

}

  public function page_locatlite(){





  }
  
  public function page_contenu(){
  
    $this->_url ='<style> 

    /**
   * @license
   * Copyright 2019 Google LLC. All Rights Reserved.
   * SPDX-License-Identifier: Apache-2.0
   */
  /* Set the size of the div element that contains the map */
  #map {
    height: 750px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
  }
   </style>  
   
   
   <script>

    /*
    // Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: -25.344, lng: 131.031 };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map, 
  });
}

  });*/

function initMap() {

  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 7,
    center: {lat: '.$this->coordonne['latitude'].', lng: '.$this->coordonne['longitude'].'}
  })

 /* var ctaLayer = new google.maps.KmlLayer({
    url: "https://developers.google.com/maps/documentation/javascript/examples/kml/westcampus.kml",
    map: map
  });

 console.log(ctaLayer)
*/
}


window.initMap = initMap;


</script>';
$this->_url.=' <div id="map"></div>';
    
 return $this->_url ;

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