<?php
require_once('../../function_php/url_mysql.php'); 
class url_sept_function extends __root_mysql{

public $_sept_html, $sept_detail, $url_sept; 
public $type_cat, $_html_type_cat;
public function __construct($_sept_url_N)
{
   // return $this->sept_controle($_sept_url_N); 
}
public function sept_progress(){
    $progress ='<nav class="navbar fixed-top navbar-light shadow-sm bg-dark">
    <div class="container-fluid">
   
    <div class="container-lg">
    <div class="row p-2">
   
    <div class="col text-center p-2 m-2 border border-dark bg-light shadow-sm rounded">
    Sept  <i class="fa-solid fa-1"></i>
    <div class="progress" style="height: 1px; width:100%;">
    <div class="progress-bar" role="progressbar" aria-label="Example 1px high" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
    </div>
    <div class="col text-center text-secondary  p-2 m-2 border border-light bg-light shadow-sm rounded">
    Sept  <i class="fa-solid fa-2"></i>
    <div class="progress" style="height: 1px; width:100%;">
    <div class="progress-bar" role="progressbar" aria-label="Example 1px high" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
    </div>
    <div class="col text-center text-secondary  p-2 m-2 border border-dark bg-light shadow-sm rounded">
    Sept  <i class="fa-solid fa-3"></i>
    <div class="progress" style="height: 1px; width:100%;">
    <div class="progress-bar" role="progressbar" aria-label="Example 1px high" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
    </div>
    <div class="col text-center text-secondary  p-2 m-2 border border-dark bg-light shadow-sm rounded">
    Sept  <i class="fa-solid fa-4 "></i>
    <div class="progress" style="height: 1px; width:100%;">
    <div class="progress-bar" role="progressbar" aria-label="Example 1px high" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
    </div>
    <div class="col text-center text-secondary  p-2 m-2 border border-dark bg-light shadow-sm rounded">
     Sept <i class="fa-solid fa-5"></i>
     <div class="progress" style="height: 1px; width:100%;">
     <div class="progress-bar" role="progressbar" aria-label="Example 1px high" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
   </div>
    </div>
    </div>
  </div> </div>

  <div class="progress" style="height: 2px; width:100%;">
  <div class="progress-bar" role="progressbar" aria-label="Example 1px high" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>

  </nav>' 
  ;
  return $progress; 
    
}

public function html_sept($_url_sept){
    $this->_sept_html='';
    $this->_sept_html.='<div class="container-lg shadow-sm rounded bg-dark text-light mb-3 p-3">';
    $this->_sept_html.='<div class="container-lg shadow-sm rounded bg-light text-black text mb-3 p-3"> <h4>'.ucwords($_SESSION['info_recrute'][4]).', Welcome for consulting my resume.</h4> </div>';  
    $this->_sept_html.='<div class=""> '.$this->sept_controle($_url_sept). '</div>'; 
    $this->_sept_html.='</div>';  
    return $this->_sept_html;
}

public function sept_controle($__url_sept){

  /*confirmer     */
//$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");


$prepare = "SELECT * FROM sept, sept_detail WHERE sept.url_link=:url_link AND sept.id_sept=sept_detail.id_sept_d";

    $select_array =array(":url_link"=>$__url_sept);
    $this->sept_detail=$this->__select($prepare,$select_array,false,$dbh);  
    $this->url_sept= $this->sept_detail;
            $sept_contenu= '<div class="text-link"> <h5>'.$this->url_sept['url_sept'].' : '.$this->url_sept['title_sept'].' </h5>  <i class="fa-brands fa-github fa-lg"></i> link : <a class="" href="https://github.com/hharouna/resumehharouna.git" >   https://github.com/hharouna/resumehharouna.git </a></div></br></hr>'; 
            $sept_contenu.= "<div class='container bg-light rounded shadow-sm  p-2 '>
            <div class='row'>"; 
            $sept_contenu.= "<div class='col-12  col-sm-6 col-md-8 col-lg-8 text-black p-2'>"; 
            $sept_contenu.= $this->url_sept['Contenu_sept']; 
            $sept_contenu.= '</div>'; 
            $sept_contenu.= '<div class="col-12 col-sm-6  col-md-4 col-lg-4 text-black p-2 ">'; 
            $sept_contenu.= $this->competence($__url_sept,$this->url_sept['title_sept'],$dbh); 
            $sept_contenu.= '</div>'; 
            $sept_contenu.= "</div></div>"; 
            $sept_contenu.= ""; 
         return $sept_contenu;


}
public function competence($url__sept, $url_sept_contenu,$db){

$prepare = "SELECT * FROM sept, type_cathegorie WHERE sept.url_link=:url_link AND sept.id_sept=type_cathegorie.id_sept_cathegorie";

    $select_array =array(":url_link"=>$url__sept);
    $this->type_cat=$this->__select($prepare,$select_array,true,$db);  
   
    
    
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