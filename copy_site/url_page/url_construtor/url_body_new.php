<?php

require_once("function_php/url_mysql.php");
require_once("function");
class url_body extends __root_mysql{


public $html_body, $cont_start,  $cont_end, $nav_start, $nav_end;
public $cont_contenu, $search, $require_url , $_connexion; 
public $url_mysql; 

public function __construct($_db)
{
    /*
    html_body constuire l'ensemble de la page 
    */ 
    //require_once("private/private_db_root.php");
/*
    <div class="modal fade show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content"><div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Confirme E-mail</h1>
    <button type="button" class="btn-close btn-info-r-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <div class="input-group">
    <span class="input-group-text">Code :</span>
    <input type="text" aria-label="First name" placeholder="T: " class="form-control t">
    <input type="text" aria-label="Last name" placeholder="CC:" class="form-control cc ">
    <input type="text" aria-label="Last name" placeholder="In: " class="form-control in">
    </div>
    <div class="alert-confirme-code"> </div>
    </div>
    
    <div class="modal-footer">
    <div class="btn-group shadow-sm" role="group" aria-label="Basic mixed styles example">
    <button type="button" class="btn btn-success confirme-code btn-sm " id_tccin="OTA=" form_id="MTA5">Confirme code <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg><!-- <i class="fa-solid fa-check"></i> Font Awesome fontawesome.com --></button>
    <button type="button" class="btn btn-primary reload-code btn-sm " id_tccin="OTA=" form_id="MTA5"> Relaod code <svg class="svg-inline--fa fa-rotate-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="rotate-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M468.9 32.11c13.87 0 27.18 10.77 27.18 27.04v145.9c0 10.59-8.584 19.17-19.17 19.17h-145.7c-16.28 0-27.06-13.32-27.06-27.2c0-6.634 2.461-13.4 7.96-18.9l45.12-45.14c-28.22-23.14-63.85-36.64-101.3-36.64c-88.09 0-159.8 71.69-159.8 159.8S167.8 415.9 255.9 415.9c73.14 0 89.44-38.31 115.1-38.31c18.48 0 31.97 15.04 31.97 31.96c0 35.04-81.59 70.41-147 70.41c-123.4 0-223.9-100.5-223.9-223.9S132.6 32.44 256 32.44c54.6 0 106.2 20.39 146.4 55.26l47.6-47.63C455.5 34.57 462.3 32.11 468.9 32.11z"></path></svg><!-- <i class="fa-solid fa-rotate-right"></i> Font Awesome fontawesome.com --></button>
    </div>
    
    </div>
    <div class="alert-reload-code " role="">  </div>
    </div>
    </div>
  </div>*/
            $this->html_body=$this->modal();
            $this->html_body.=$this->style_background();
            $this->html_body.='<body class="modal-open" token=""  style="overflow: hidden; padding-right: 17px;">';
            $this->html_body.='<div class="container-lg   mb-5 bg-body-tertiary rounded">';
            $this->html_body.=$this->bar_progress_info();
            $this->html_body.=$this->mail_recrute();
            $this->html_body.=$this->body($_db);
            $this->html_body.=$this->letter($_db);
            $this->html_body.='</div>';
            $this->html_body.='</body>';
 
}

public function body(){

}
public function style_background(){
          $style = '<style> 
            body {
              background-width:100px;
              background-height:100px;
            background-repeat: no-repeat;
            background-size: 100%;
            background-image: url("/url_page/image/image_background/url_sept_default.jpg");
            background-color: #cccccc;
            }
          </style>';
         // 'style="background-image: url("url_page/image/image_background/url_sept_default.jpg"); " ';
        return $style; 

}
public function modal(){

    $modal ='<div class="modal fade show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-2">'.
      $this->mail_recrute().'
      </div>
    </div>
  </div>'; 
  return $modal; 


}
public function bar_progress_info(){
$progress_bar ="<div class='text text-center text-primary py-2'> <h4> RESUME HAROUNA Harouna </h4></div>";
$progress_bar .= '<div class="progress mb-5 mt-5" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 1px; width: 100%;">
<div class="progress-bar" style="width: 100%"></div>
</div>
';
 return $progress_bar; 
}

public function letter($_db){
  
     //connexion db 

   //  $dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");

//require_once("private/private_db_root.php");
      $prepare = "SELECT * FROM info_letter";
      $select_array =array();
      $select_letter =$this->__select($prepare,$select_array,false,$_db);
  
    $_letter = '<div class="container shadow-lg  mb-5  bg-body-tertiary rounded">
    ';
    $_letter .= '<div class="row ">';
    $_letter .= '<div class="col-12 col-sm-12 p-2 col-md-6 col-lg-6 bg-dark text text-light rounded">';
    $_letter .= '<div class="text text-light"><h6> Date Publication : '.$select_letter['date_letter'].'</h6></div>';
    $_letter .= $select_letter['name_letter'];
    $_letter .= '</div>';
    $_letter .= '<div class="col-12 col-sm-12 col-md-5 col-lg-6 " style="margin:0px; padding:0px;"> 
    <div class="container" style="margin:0px; padding:0px;"> 
    <div class="row m-0" style="margin:0px; padding:0px;"> 
    <div class=" col-12 col-sm-12 col-md-5 col-lg-5 my-2" > 
    <img src="img/myself" class="rounded mx-auto d-block  " alt="..."
     style="width:100%;height:100%;"> </div>';
    
     $_letter .= '<div class="col-12 col-sm-12 col-md-6 col-lg-6 my-2"> '.$this->information_($_db).'</div> </div>';
     $_letter .= '</div> ';
     $_letter .= '</div></div> </div>';
   

 return $_letter; 


}
public function information_($__db){
   // connexion db
   //require_once("private/private_db_root.php");

   //$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");

    $prepare = "SELECT * FROM info_harouna";
    $select_array =array();
    $select_info =$this->__select($prepare,$select_array,false,$__db);

    $information =  "<h4>".$select_info["info_name"]; 
    $information .=  " ".$select_info["info_frist_name"]."</h4> </br>"; 
    $information .=  "Birth      : ".$select_info["info_date_brith"]."</br>"; 
    $information .=  "E-mail     : <a href='mailto:'".$select_info["info_mail"]."'?subject=Recreteur:'>".$select_info["info_mail"]."</a></br>"; 
    $information .=  "E-mail     : <a href='mailto:'hharouna86usa@gmail.com'?subject=Recreteur:'>hharouna86usa@gmail.com</a></br>"; 
    $information .=  "location   : ".$select_info["info_adresse"]."</br>"; 
    $information .=  "Country    : ".$select_info["info_pays"]."</br>"; 
    $information .=  "Color      : ".$select_info["info_Rase"]."</br>"; 
    $information .=  "Creat date : ".$select_info["date_info"]."</br>"; 

    return $information; 

}

public function mail_recrute(){

    $_form_recrute ='<div class="container" style="margin:0px; padding:0px;"> '; 
    $_form_recrute .='<div class="row">'; 
    $_form_recrute .='<div class="col-12 col-sm-12 col-md-12 col-lg-12">'; 
    $_form_recrute .='<div class="container p-0 my-2">'; 
    $_form_recrute .='<div class="row"> 
   
    <div class="col-12 col-sm-12 col-md-8 col-lg-8 pt-2 m-0">
    <input type="text" aria-label="First name" placeholder="E-mail@exemple.com"  class="form-control mail">
    </div>
   
    <div class=" col-12 col-sm-12 col-md-4 col-lg-4 pt-2">
    <button class="btn btn-primary btn-info-recrute-new form-control" > Confirm  <i class="fa-solid fa-check"></i></button>
    </div> </div> <div class="alert-company"></div></div>


    </div></div> ';
    $_form_recrute .='</div>'; 

//<button class="btn btn-primary btn-info-recrute" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Valider  <i class="fa-solid fa-check"></i></button>


return $_form_recrute; 

}

public function alert_recruteur(){

  $_info_recruteur="<div class=''><h5 class='text text-center text-light'>Information Web browser</h5> </div> ";
  $_info_recruteur.="<div class=''>Navigator : ".$_SERVER['HTTP_USER_AGENT']."</div> <hr>";
  $_info_recruteur.="<div class=''>MyIP : ".$_SERVER['REMOTE_ADDR']."</div>";

 
return $_info_recruteur;
}


}







?>