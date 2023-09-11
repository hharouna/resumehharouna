<?php

require_once("function_php/url_mysql.php");

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


            $this->html_body=$this->modal();
            $this->html_body.=$this->style_background();
            $this->html_body.='<body class="" token=""  >';
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

    $modal ='<div class="modal fade" id="staticBackdrop" 
    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      

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
    $information .=  "location   : ".$select_info["info_adresse"]."</br>"; 
    $information .=  "Pays       : ".$select_info["info_pays"]."</br>"; 
    $information .=  "Color      : ".$select_info["info_Rase"]."</br>"; 
    $information .=  "Creat date : ".$select_info["date_info"]."</br>"; 

    return $information; 

}

public function mail_recrute(){

    $_form_recrute ='<div class="container" style="margin:0px; padding:0px;"> '; 
    $_form_recrute .='<div class="container m-0 mb-2" style="margin:0px; padding:0px;">'; 
    $_form_recrute .='<div class="row">'; 
    $_form_recrute .='<div class="col-12 col-sm-12 col-md-6 col-lg-6">'; 
    $_form_recrute .='<div class="container p-0 m-0">'; 
    $_form_recrute .='<div class="row">'; 
    $_form_recrute .= '<div class="col-12 col-sm-12 col-md-6 col-lg-6 input-group mb-3 shadow-sm p-2 mb-5  rounded">
    <div class="input-group">
    <div class="container" style="margin:0px; padding:0px;">
    <div class="row">
    <div class="col-sm-6 pt-2 m-0">
    <input type="text" aria-label="First name" placeholder="Company@resumehharouna.net"  class="form-control mail">
    </div>
    <div class="col-sm-6 pt-2 m-0">
    <input type="text" aria-label="Last name" placeholder="Company"  class="form-control compagny">
    </div>
    <div class="col-sm-12 pt-2">
    <button class="btn btn-primary btn-info-recrute form-control" > Confirme  <i class="fa-solid fa-check"></i></button>
    </div> </div> <div class="alert-company"></div></div>

    </div>
    </div></div> </div> </div>';
    $_form_recrute .='<div class="col-12 col-sm-12 col-md-6 col-lg-6">';
    $_form_recrute .='<div class="border-start shadow-sm mb-2 bg-dark p-2 text-light rounded">'.$this->alert_recruteur().'</div> '; 
    $_form_recrute .='</div></div></div>'; 

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