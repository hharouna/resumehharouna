<?php
require_once('../../function_php/url_mysql.php'); 
class url_sept_function extends __root_mysql{

public $_sept_html, $sept_detail, $url_sept; 
public $type_cat, $_html_type_cat,$progress_url, $progress_sept;
public function __construct($_sept_url_N)
{
   // return $this->sept_controle($_sept_url_N); 
}
public function sept_progress($_id_recrute,$_link_url,$_db){
   
    //$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
    //$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");
/**/
    $prepare = "SELECT * FROM info_recrute, url_sept WHERE info_recrute.id_recrute=:id_recrute  AND info_recrute.id_recrute=url_sept.url_id_info_recrute ";    $select_array =array(":id_recrute"=>$_id_recrute);
    $this->progress_url=$this->__select($prepare,$select_array,false,$_db);  


    $prepare_sept = "SELECT * FROM sept";    
    $select_array =array();
    $this->progress_sept=$this->__select($prepare_sept,$select_array,true,$_db);  
    
    $_array_sept = array($this->progress_url["url_sept_1"],$this->progress_url["url_sept_2"],$this->progress_url["url_sept_3"],$this->progress_url["url_sept_4"],$this->progress_url["url_sept_5"]);
    $_count_sept=count($_array_sept);

      
    //$array_sept=array();
    foreach( $this->progress_sept['fectAll'] as $rs_fe => $_fecthAll){
      $array_url_sept[]= array("id"=>$_fecthAll['id_sept'],"url_sept"=>$_fecthAll['url_sept'],"url_link"=>$_fecthAll['url_link'],"title_sept"=>$_fecthAll['title_sept']);
    }

       $_count_url_sept = count($array_url_sept);
       $_affiche_progress ='<nav class="navbar  fixed-top navbar-expand-lg navbar-dark bg-dark shadow-sm ">
       <div class="container-lg text text-light ">
       <a class="navbar-brand" href="#">Resume HAROUNA</a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
       <i class="fa-solid fa-list-ul fa-sm" style="color: #ffffff;"></i>
       </button>
       <div class="collapse navbar-collapse" id="navbarNav">

       <ul class="navbar-nav">';
        for($i=0;$i<=$_count_sept-1;$i++){ 
          if($_link_url==$array_url_sept[$i]['url_link']):
          $active= "active";
          else:
          $active= "";
          endif; 
          if($_array_sept[$i]==1): 
          $_affiche_progress .= '<li class="nav-item text text-light">
          <a class="nav-link '.$active.'" href="http://'.$_SERVER['HTTP_HOST'].'/sept_url/'.$array_url_sept[$i]['url_link'].'/'.base64_encode($_id_recrute).'">  
          '.$array_url_sept[$i]['title_sept'].' </a> 
          </li> ';
          else:
          $_affiche_progress .=  '<li class="nav-item">
          <a class="nav-link" href="#"> '.$array_url_sept[$i]['title_sept'].' </a></li> ';
          endif; 
        }
        $_affiche_progress .=  '<li class="nav-item">
        <a class="nav-link" href="http://'.$_SERVER['HTTP_HOST'].'/sept_url/sign_out"> <i class="fa-solid fa-right-from-bracket fa-xl">  </i> Sign out </a></li> ';
        
        $_affiche_progress .='</ul> </div> </nav>';

  return $_affiche_progress ;


}

public function style_background($_url_sept){
  $style = '<style> 
    body {
     
    background-repeat: no-repeat;
    background-size: 100%;
    background-image: url("/url_page/image/image_background/'.$_url_sept.'.jpg");
    background-color: #cccccc;
    }

    .padded-multiline { 
      background: url("/url_page/image/image_contenu/'.$_url_sept.'.jpg");
      background-size: 100%;
      background-repeat: no-repeat;
      max-width: 100%;
      max-height: 100%;
      min-height: 400px;
     
    }
    .padded-multiline span { 
      background-color: black;
      color: #fff; 
      display: inline;
      padding: 0.5rem;
      
      /* Needs prefixing */
      -webkit-box-decoration-break: clone;
      box-decoration-break: clone;
    }

  </style>';
 // 'style="background-image: url("url_page/image/image_background/url_sept_default.jpg"); " ';
return $style; 

}
public function html_sept($_url_sept,$_db){
    $this->_sept_html='';
    $this->_sept_html.='<div class="container-lg shadow-sm rounded bg-dark text-light mb-3 p-3">';
    $this->_sept_html.='<div class="container-lg shadow-sm rounded bg-light text-black text mb-3 p-3"> <h4>'.ucwords($_SESSION['info_recrute'][4]).', Welcome for consulting my resume.</h4> </div>';  
    $this->_sept_html.='<div class=""> '.$this->sept_controle($_url_sept,$_db). '</div>'; 
    $this->_sept_html.='</div>';  
    return $this->_sept_html;
}

public function sept_controle($__url_sept,$__db){

  /*confirmer    
//$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");
 */


$prepare = "SELECT * FROM sept, sept_detail WHERE sept.url_link=:url_link AND sept.id_sept=sept_detail.id_sept_d";

    $select_array =array(":url_link"=>$__url_sept);
    $this->sept_detail=$this->__select($prepare,$select_array,false,$__db);  
    $this->url_sept= $this->sept_detail;
            $sept_contenu= '<div class="text-link"> <h5>'.$this->url_sept['url_sept'].' : '.$this->url_sept['title_sept'].' </h5>  <i class="fa-brands fa-github fa-lg"></i> link : <a class=" text text-break" href="https://github.com/hharouna/resumehharouna.git" >   https://github.com/hharouna/resumehharouna.git </a></div></br></hr>'; 
            $sept_contenu.= "<div class='container   p-2'>
            <div class='row bg-light  rounded shadow-sm '>"; 
            $sept_contenu.= "<div class=' rounded col-12  col-sm-6 col-md-8 col-lg-7  text-black  p-2 padded-multiline'>"; 
            $sept_contenu.= $this->url_sept['Contenu_sept']; 
            $sept_contenu.= '</div>'; 
            $sept_contenu.= ' <div class="col-11 col-sm-5  col-md-3 col-lg-4 text-black p-2 mx-1 rounded  ">'; 
            $sept_contenu.= $this->competence($__url_sept,$this->url_sept['title_sept'],$__db); 
            $sept_contenu.= '</div>'; 
            $sept_contenu.= "</div></div>"; 
            $sept_contenu.= ""; 
         return $sept_contenu;


}
public function competence($url__sept, $url_sept_contenu,$___db){

$prepare = "SELECT * FROM sept, type_cathegorie WHERE sept.url_link=:url_link AND sept.id_sept=type_cathegorie.id_sept_cathegorie";

    $select_array =array(":url_link"=>$url__sept);
    $this->type_cat=$this->__select($prepare,$select_array,true,$___db);  

      //function sept url_sept_N
      $this->_html_type_cat = '<div class="container-lg shadow-sm rounded bg-dark text-light mb-3 p-3" > 
      <div class="row row-cols-1 row-cols-md-3 g-3 text-black">';


      /*
      
          foreach($_db_root_admin['fectAll'] as $rs_fe => $_fecthAll){
            $r_page .= $_fecthAll['root_mail'];
          }
      */
      
      
      $this->_html_type_cat="<div class='container' > ";
      $this->_html_type_cat.="<div ='text-dark m-2'> <h4>".$url_sept_contenu."</h4> </div>";
      $this->_html_type_cat.="<div class='row' > ";
      
      foreach($this->type_cat['fectAll'] as $rs_fe => $_fecthAll){
      $this->_html_type_cat.='
      <div class="col-5 m-1 shadow-sm rounded border border-dark">
      <h6 class="card-title">'.$_fecthAll['c-title'].'</h6>
      </div>
      ';
      }
      $this->_html_type_cat.='</div></div>';
      return $this->_html_type_cat;
}


}











?> 