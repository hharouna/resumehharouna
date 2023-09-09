



<?php
require_once('../../function_php/url_mysql.php'); 

class url_sept_page extends __root_mysql{

    public $_html; 

  public $type_cat, $select_comment;
    public function __construct()
    {
        
    }
    
    public function url_sept_html($url__sept){

        /*confirmer     */
    
    require_once("../../private/private_db_root.php"); 


        $prepare = "SELECT * FROM sept, type_cathegorie WHERE sept.url_link=:url_link AND sept.id_sept=type_cathegorie.id_sept_cathegorie";

        $select_array =array(":url_link"=>$url__sept);
        $this->type_cat=$this->__select($prepare,$select_array,true,$db);  
        $count= count($this->type_cat);

        //function sept url_sept_N
        $this->_html = '<div class="container-lg shadow-sm rounded bg-dark text-light mb-3 p-3" > 
        <div class="row row-cols-1 row-cols-md-3 g-3 text-black">';


        /*

          foreach($_db_root_admin['fectAll'] as $rs_fe => $_fecthAll){
            $r_page .= $_fecthAll['root_mail'];
          }
        */
        foreach($this->type_cat['fectAll'] as $rs_fe => $_fecthAll){

        $this->_html.='
        <div class="col ">
        <div class="card h-100 p-2">
        <i class="'.$_fecthAll['c_image'].'"></i>
        <div class="card-body">
        <h3 class="card-title">'.$_fecthAll['c-title'].'</h3>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        </div>
        </div>';
        }
        $this->_html.='</div>';
        
            
        $this->_html.=$this->commentaire_ckeditor($url__sept).$this->next_sept($url__sept);
        $this->_html.=' </div></div>';


        return  $this->_html ;

        }



      public function type_cat_contenu($id_type_cat,$db){


        $prepare = "SELECT * FROM type_cathegorie WHERE type_cathegorie.id_cathegorie=:id_cathegorie";

        $select_array =array(":id_cathegorie"=>$id_type_cat);
        $this->type_cat=$this->__select($prepare,$select_array,true,$db);  
        $count= count($this->type_cat);

      }
    




public function next_sept($url_sept){
  $next_sept = '<div class="container-lg shadow-sm p-2">';
  $next_sept .='<button class="btn btn-success" > Next sept : '.$url_sept.' </button>';
  $next_sept .='</div>';
 
  return $next_sept; 
  
 }
 
 public function commentaire_ckeditor($url_sept){
 
    $next_comment = '<hr > <div class="return_comment">';
    $next_comment .= $this->affiche_comment($url_sept);
    $next_comment .= '</div>';
    $next_comment .= '<hr><div class="container-lg bg-light mt-3 shadow-sm rounded p-2 ">';
    $next_comment .='<div class="form-floating">
    <span class="text text-dark"> <h4>Would you like me to improve my skills </h4></span>
    <textarea class="form-control comment_textarea" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
    </div>
    <hr>
    <button class="btn btn-primary confirme_comment" url="'.$url_sept.'" id_company="'.base64_encode($_SESSION['info_recrute']['id_recrute']).'"> Confirme  comment</button>
    <div class="alert-comment"></div>

    ';
    $next_comment .='</div> <hr>';

    return $next_comment;
 }
public function affiche_comment($_url_sept){



require_once("../../private/private_db_root.php"); 
   

$prepare = "SELECT * FROM sept_commentaire WHERE id_r_comment=:id_r_comment AND id_sept_comment=:id_sept_comment";

    $select_array =array(":id_r_comment"=>base64_encode($_SESSION['info_recrute']['id_recrute']), ":id_sept_comment"=>$_url_sept);
    $this->select_comment=$this->__select($prepare,$select_array,true,$db);  
    $_rst = $this->select_comment;
    if(isset($_rst)):
    $r_page ="<div class='container '>"; 
    $r_page .="<div class='row p-4 '>"; 
    $r_page .="<div class='col-12 bg-success text text-light rounded shadow-sm p-2 mt-2 mb-2 '> <i class='fa-solid fa-heart fa-lg'style='color: #da0e13;'></i> Thanks for your participating ".$_SESSION['info_recrute']['info_company_recrute']."</div>"; 
    foreach($_rst['fectAll'] as $rs_fe => $_fecthAll){
        $r_page .= "<div class='form-control shadow-sm bg-light mt-2 pt-2 pb-2 rounded ' comment_id='".$_fecthAll["id_comment"]."' >"; 
        $r_page .= $_fecthAll["sept_comment"];
        $r_page .= " <br><span class='text text-secondary  text-sm'>  date : ".$_fecthAll['date_commentaire']." </span>";
        $r_page .= "</div>";
      }
      $r_page .="</div> </div>"; 

     return  $r_page; 
    endif;
}

}
?>