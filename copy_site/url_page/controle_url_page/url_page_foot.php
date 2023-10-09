<?php
require_once("../../private/private_db_root.php"); 
require_once("../../function_php/url_mysql.php"); 
class url_page_foot extends __root_mysql{

    public $_html, $foot_title_cont; 

    public $foot_title, $select_comment;
public function __construct()
{
    
}
public function url_sept_html($_db){

    /*confirmer     */

    $prepare = "SELECT * FROM foot_title ";

    $select_array =array();
    $this->foot_title=$this->__select($prepare,$select_array,true,$_db);  
    $count= count($this->foot_title);
  sleep(2);
    //function sept url_sept_N
    $this->_html = '<div class="container-lg shadow-sm rounded bg-dark text-light mb-3 p-3" > 
    <div class="row row-cols-1 row-cols-md-4 g-4 text-black">';
    /*

    foreach($_db_root_admin['fectAll'] as $rs_fe => $_fecthAll){
    $r_page .= $_fecthAll['root_mail'];
    }
    */
    
    foreach($this->foot_title['fectAll'] as $rs_fe => $_fecthAll){

    $this->_html.='
    <div class="col">
    <div class="card h-100 p-2">
    <div class="text text-primary text-center" ><i class="'.$_fecthAll['c_image'].'"></i> </div>
    <div class="card-body">
    <h4 class="card-title">'.ucwords(strtolower($_fecthAll['foot_title'])).' </h4>';
    $this->_html.= $this->foot_title_contenu($_fecthAll['id_foot_title'],$_db);
   
    $this->_html.='</div>
    </div>
    </div>';
    }
    $this->_html.='</div>';
    $this->_html.=' </div></div>';


    return  $this->_html ;

    }



  public function foot_title_contenu($id_title,$__db){


    $prepare = "SELECT * FROM foot_contenu WHERE id_c_f_page =$id_title ";
    $sth = $__db->query($prepare);
    /*
    $select_array_cont =array(":id_t_cat"=>$id_foot_title);
    $this->foot_title_cont=$this->__select($prepare,$select_array_cont,true,$__db); 
     */
  $_contenu= '<ul class="list-group list-group-flush">';
  foreach( $sth as  $_fecthAll_title){    
  $_contenu.='<li class="list-group-item" contenu_id="'.$_fecthAll_title['id_c_foot_title'].'" " >'.$_fecthAll_title['title_contenu'].'</li>';
  } 
  $_contenu.="</ul>";
  return $_contenu;


 
  }



}



      $url_page_url = new url_page_foot();

      echo json_encode(array("url_foot"=>$url_page_url->url_sept_html($db)));






?> 