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
            $this->html_body.='<body class="" token=""  >';
            $this->html_body.='<div class="container-lg   mb-5 bg-body-tertiary rounded">';
            $this->html_body.=$this->bar_progress_info();
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
      $progress_bar ='<hr class="border border-primary border-1 ">';
      $progress_bar .="<div class='text text-center text-primary py-2'> <h4> RESUME HAROUNA Harouna </h4></div>";
      $progress_bar .= '<hr class="border border-primary border-1 ">';
      return $progress_bar; 
}

public function letter($_db){
  
     //connexion db 

   //  $dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");

//require_once("private/private_db_root.php");
      $prepare = "SELECT * FROM sept";
      $select_array =array();
      $select_letter =$this->__select($prepare,$select_array,true,$_db);
 // $_array_sept = array($this->progress_url["url_sept_1"],$this->progress_url["url_sept_2"],$this->progress_url["url_sept_3"],$this->progress_url["url_sept_4"],$this->progress_url["url_sept_5"]);
  
  $_array_btn = array('<i class="fa-solid fa-code fa-sm fa-lg"></i>','<i class="fa-solid fa-shield-halved fa-sm fa-lg"></i>','<i class="fa-solid fa-lock-open fa-sm fa-lg"></i>','<i class="fa-solid fa-building fa-sm fa-lg"></i>','<i class="fa-solid fa-file-contract fa-sm fa-lg"></i>');
  
    $_letter = '<div class="container shadow-lg  mb-5   rounded">
    ';
    $_letter .= '<div class="row ">';
    $_letter .= '<div class="col-12 col-sm-12 p-2 col-md-6 col-lg-6  text text-light rounded">';
    $_letter .= '<div class="container">';
    $_letter .= '<div class="row">';
    $_letter .= "<div class='col col-12 col-sm-12 col-md-12 col-lg-12 shadow-sm my-2 p-2 bg-light text text-black rounded' > <h3 class='text text-center'> All sept</h3> </div>";

    foreach($select_letter['fectAll'] as $rs_fe => $_fecthAll){
      $_letter .= "<div class='col col-12 col-sm-12 col-md-12 col-lg-12 shadow-sm my-2 p-2 bg-light text text-black rounded' >";
      $_letter .= " <div class='container'><div class='row'> <div class='col-2 col-sm-2 col-md-2 col-lg-2 p-1'> ".$_array_btn[$rs_fe]."</div>";
      $_letter .= "<div class='col-10 col-sm-10 col-md-10 col-lg-10 p-1'>".$_fecthAll['title_sept']."</div></div> </div></div>";
    }
    $_letter .= '</div></div></div>';
    $_letter .= '<div class="col-12 col-sm-12 col-md-5 col-lg-6 " style="margin:0px; padding:0px;"> 
    <div class="container" style="margin:0px; padding:0px;"> 
    <d  iv class="row m-0" style="margin:0px; padding:0px;"> 
    <div class=" col-12 col-sm-12 col-md-12 col-lg-12 my-2" > ';
    $_letter .=  $this->mail_recrute();
    $_letter .= ' </div></div>';

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
    $_form_recrute .='<div class="container m-0 mb-2" style="margin:0px; padding:0px;">'; 
    $_form_recrute .='<div class="row mx-1">'; 
    $_form_recrute .='<div class="col-12 col-sm-12 col-md-12 col-lg-12">'; 
    $_form_recrute .='<div class="container p-0 m-0">'; 
    $_form_recrute .='<div class="row ">'; 
    $_form_recrute .= '<div class="col-12 col-sm-12 col-md-12 col-lg-12 input-group mb-3 shadow-sm p-2  rounded" style="margin:0px; padding:0px;">
    <div class="input-group">
    <div class="container" style="margin:0px; padding:0px;">
    <div class="row ">
    <div class="col-sm-12 col-12 col-md-12 col-lg-4 my-1">
    <input type="text" aria-label="First name" placeholder="E-mail@exemple.com"  class="form-control mail">
    </div>
    <div class="col-sm-12 col-12 col-md-12 col-lg-4  my-1">
    <input type="text" aria-label="Last name" placeholder="Name or company"  class="form-control compagny">
    </div>
    <div class="col-sm-12 col-12 col-md-12 col-lg-4 my-1">
    <button class="btn btn-primary btn-info-recrute form-control" > Confirm  <i class="fa-solid fa-check"></i></button>
    </div> </div> <div class="alert-company"></div>
    </div>
    </div>

    </div>
   
    </div> 
    </div>  <div class="col-12 col-sm-12 col-md-12 col-lg-12 input-group my-2 shadow-sm ">
    <button class="btn btn-primary btn-sm " > <i class="fa-solid fa-envelope fa-2xl"></i> Receive as a PDF file </button> 
    <input type="text" class="form-control" placeholder="Exemple@gmail.com" aria-label="Example text with button addon" aria-describedby="button-addon1">
    </div> 
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 input-group py-2 ">
     <a class="btn btn-danger btn-sm shadow-sm " href="https://resumehharouna.net/sept_url/pdf_create"> <i class="fa-solid fa-download fa-2xl"></i> Download resume PDF </a> </div>
    </div> 
   </div> </div>';
    $_form_recrute .=$this->chat_action(); 
    $_form_recrute .='</div></div>'; 

//<button class="btn btn-primary btn-info-recrute" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Valider  <i class="fa-solid fa-check"></i></button>


return $_form_recrute; 

}

public function alert_recruteur(){

  $_info_recruteur="<div class=''><h5 class='text text-center text-light'>Information Web browser</h5> </div> ";
  $_info_recruteur.="<div class=''>Navigator : ".$_SERVER['HTTP_USER_AGENT']."</div> <hr>";
  $_info_recruteur.="<div class=''>MyIP : ".$_SERVER['REMOTE_ADDR']."</div>";

 
return $_info_recruteur;
}


public function chat_action(){
 $_chat_action = "<div class='container rounded shadow-sm bg-light border border-danger mt-3' style='max-margin: 200px; '> ";
 $_chat_action .= "Hi, How are you doing today? </br>";
 $_chat_action .= "You have three options to browse through the entirety of my resume";
 $_chat_action .= "<ol class='list-group list-group-numbered'>
 <li class='list-group-item'>web option.</li>
 <li class='list-group-item'>option to send to your e-mail address.</li>
 <li class='list-group-item'>option to download pdf to your machine.</li>
 </ol>";

 $_chat_action .= "online support <br>";
 $_chat_action .= "<div class='chat_creat_script'></div>";

 $_chat_action .= "<div class='connexion' number=''><button class='btn btn-secondary btn-md btn-creat-chat my-2' chat='creat'> <i class='fa-regular fa-comments fa-lg'></i> Request to connect with Harouna</button>";
 $_chat_action .= "</div></div>";


 return $_chat_action; 

}


}







?>