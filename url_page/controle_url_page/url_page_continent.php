<?php

class url_page{
 
/*
harouna harouna 

7/31/2022

la page_container() dans url_body recois en require_once(lien) 
  
-> le lien et la class new url_page correspondant a la page appeler a l'affichage
  
$_url,$_dir,$_conditon,$_token,$_other;

*/


public $_url,$_dir,$_conditon,$_token,$_other,$_page_container,$list_pays, $url_host, $coordonne;



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
        $r_list_continet =$page_root_mysql->__select($prepare,$ex_array,true,$page_db);

        //id_coord_pays 	longitude 	latitude 	altitude 	zoom 	url_kml 	id_liste_pays 	date_coord

        $this->list_pays = $r_list_continet;
        $_SESSION["Liste_pays"]= $r_list_continet; 
        
       $this->coordonne = array("latitude"=>7.90446544999999,"longitude"=>-1.0304069499999997);


  }



  public function page(){

    return $this->page_container();

  }
  public function page_container(){

      $this->_page_container ='<div class="container-md shadow-sm mt-2">';
      $this->_page_container .='<div class="row">';
 
      //---------------- 
      $this->_page_container .='<div style="height: 750px;" class="col-12 col-sm-4 col-md-4 mb-3 mt-3 overflow-auto">';
      $this->_page_container .=$this->page_menu();
      $this->_page_container .='</div>'; 

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
    // $r_page.= $this->generate_url("Liste pays ".$_SESSION['continent']['fectAll'][$i]['name_continant'],"url_page/url_page_continent.php",array("ID_continent"=>$_SESSION['continent']['fectAll'][$i]['ID_continent']),"").'">';

    foreach($this->list_pays['fectAll'] as $rs_fe => $_fecthAll){

    $m_list_pays .= '<li class="nav-item border-bottom mb-1">';
    $m_list_pays .= '<a class="nav-link" href="'.$this->url_host.'/index_web.php?url_page='.$this->generate_url("Pays  ".$_fecthAll['pays'],"url_page/url_page_pays.php",array("ID_continent"=>$this->_conditon['ID_continent'],'name_continent'=>$this->_conditon['name_continent'],"id_list_pays"=>$_fecthAll['id_list_pays']),"").'"> 
    <img src="'.$this->url_host.'/p_creation_pays/Drapeaux/'.$_fecthAll['code_iso_l2'].'.png" alt="" width="60" height="48" title="prendall.net"> '.$_fecthAll['pays'].'</a>';
    $m_list_pays .= '</li>';

    }
    $m_list_pays.=' </ul>'; 


    return  $m_list_pays; 

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