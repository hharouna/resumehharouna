



<?php
require_once('../../function_php/url_mysql.php'); 

class url_sept_page extends __root_mysql{

    public $_html, $type_cat_cont, $_test_ipv4; 

  public $type_cat, $select_comment, $_option_hacking;
    public function __construct()
    {
        
    }
    
    public function url_sept_html($url__sept,$_db){

        /*confirmer     */


        $prepare = "SELECT * FROM sept, type_cathegorie WHERE sept.url_link=:url_link AND sept.id_sept=type_cathegorie.id_sept_cathegorie";

        $select_array =array(":url_link"=>$url__sept);
        $this->type_cat=$this->__select($prepare,$select_array,true,$_db);  
        $count= count($this->type_cat);

        //function sept url_sept_N
        $this->_html ='<div class="container-lg h-100 text rounded text-light bg-danger shadow-sm my-2 p-2">';
        $this->_html.=$this->option_hacking($_db);
        $this->_html.='</div>';
        $this->_html.= '<div class="container-lg shadow-sm rounded bg-dark text-light mb-3 p-3" > 
        <div class="row row-cols-1 row-cols-md-4 g-4 text-black">';
 

        /*

        foreach($_db_root_admin['fectAll'] as $rs_fe => $_fecthAll){
        $r_page .= $_fecthAll['root_mail'];
        }
        */
        
        foreach($this->type_cat['fectAll'] as $rs_fe => $_fecthAll){

        $this->_html.='
        <div class="col">
        <div class="card h-100 p-2">
        <div class="text text-primary text-center" ><i class="'.$_fecthAll['c_image'].'"></i> </div>
        <div class="card-body">
        <h4 class="card-title">'.ucwords(strtolower($_fecthAll['c-title'])).' </h4>';
        $this->_html.= $this->type_cat_contenu($_fecthAll['id_cathegorie'],$_db);
       
        $this->_html.='</div>
        </div>
        </div>';
        }
       
        $this->_html.='</div>';


        $this->_html.=$this->commentaire_ckeditor($url__sept,$_fecthAll['title_sept'],$_db);
        $this->_html.=' </div></div>';


        return  $this->_html ;

        }



      public function type_cat_contenu($id_type_cat,$__db){


        $prepare = "SELECT * FROM contenu_type_cathegorie WHERE id_t_cat =$id_type_cat ";
        $sth = $__db->query($prepare);

        /*
        $select_array_cont =array(":id_t_cat"=>$id_type_cat);
        $this->type_cat_cont=$this->__select($prepare,$select_array_cont,true,$__db); 
         */

        $_contenu= '<ul class="list-group list-group-flush">';
        foreach( $sth as  $_fecthAll_cat){    
        $_contenu.='<li class="list-group-item" contenu_id="'.$_fecthAll_cat['id_c_type_cat'].'"  cathegorie_id="'.$_fecthAll_cat['id_t_cat'].'" >'.$_fecthAll_cat['contenu_type'].'</li>';
        } 
        $_contenu.="</ul>";
        return $_contenu;

      }
    
    public function option_hacking($__db){
      $prepare = "SELECT * FROM option_hacking";
      $select_array =array();
      $this->_option_hacking=$this->__select($prepare,$select_array,false,$__db);
      $_option_hacking = "<div class='container'>"; 
      $_option_hacking .= "<div class='row'>"; 
      $_option_hacking .= "<div class='col-12 col-sm-12 col-md-6 col-lg-6'> <h4>"; 
      $_option_hacking .= $_SESSION['info_recrute']['info_company_recrute'].", Would you like me to run a penetration test with a report.
      please send me the ipv4 address or the website." ;
      $_option_hacking .= "</h4></div>";

      $_option_hacking .= "<div class='col-12 col-sm-12 col-md-6 col-lg-6 align-middle py-2 all_table_ipv4'>";
      $_option_hacking .= $this->test_ipva4($__db);
      $_option_hacking .= "</div></div></div></div>";
      return  $_option_hacking ;
      
    }
    public function test_ipva4($___db){

      $prepare = "SELECT * FROM test_penetration WHERE id_test_recrute=:id_test_recrute ";

      $select_array =array(":id_test_recrute"=>$_SESSION['info_recrute']['id_recrute']);
      $this->_test_ipv4=$this->__select($prepare,$select_array,true,$___db);  
      
       
      $r_test_ipv4="<div class='container' style='margin:0px; padding:0px;'>";
      $r_test_ipv4.="<div class='row'>";
      $r_test_ipv4.="<div class='col-12 col-sm-12 col-md-12 col-lg-12 my-2'> ";
      $r_test_ipv4.='<div class="shadow-sm text text-light bg-dark p-2 rounded ">';
      $r_test_ipv4.='<div class=" r_table_ipv4">';
      $r_test_ipv4.='<table class="table bg-light">
      <thead>
      <tr>
      <th scope="col">ipv4 or website</th>
      <th scope="col">Delete</th>
      </tr> </thead>';
      $r_test_ipv4.='<tbody >';

      foreach($this->_test_ipv4['fectAll'] as $rs_fe => $_fecthAll){
      $r_test_ipv4.='
      <tr class="'.$this->base64url_encode($_fecthAll['id_test']).'">
      <td>'.$_fecthAll['test_ipv4'].'</td>
      <td><button class="btn btn-danger btn-sm btn-delete-ipv4 form-control" title="Delete"  id_test_ipv4="'.base64_encode($_fecthAll['id_test']).'" id_test_recrute="'.base64_encode($_fecthAll['id_test_recrute']).'" ><i class="fa-solid fa-trash fa-sm"></i> </button></td>
      </tr>
      ';
        }

      $r_test_ipv4.= '</tbody></table> </div>';
      $r_test_ipv4.="</div></div> <div class='col-12 col-sm-12 col-md-12 col-lg-12 '>";
      $r_test_ipv4.='<div class="input-group mb-3 align-middle">';
      $r_test_ipv4.='<input type="text" class="form-control test_ipv4" placeholder="ipv4: '.$_SERVER['REMOTE_ADDR'].' or www.exemple.com" aria-describedby="button-addon2">
      <button class="btn btn-success btn-sm  btn-test-ipv4" title="Confirm" id_ipv4_recrute="'.base64_encode($_SESSION['info_recrute']['id_recrute']).'" type="button" id="button-addon2"> Confirm <i class="fa-solid fa-unlock-keyhole fa-sm"></i></button>
      </div> <div class="alert-ipv4"> </div> </div></div>';


      return $r_test_ipv4;
    }
    

      public function base64url_encode($data) {

      return rtrim(base64_encode($data),'=');

      }



    public function commentaire_ckeditor($url_sept,$_title_sept,$__db){
        $_SESSION['title_sept']= $_title_sept;
        $next_comment = '<hr > <div class="return_comment">';
        $next_comment .= $this->affiche_comment($url_sept, $__db);
        $next_comment .= '</div>';
        $next_comment .= '<hr><div class="container-lg bg-light mt-3 shadow-sm rounded p-2 ">';
        $next_comment .='<div class="form-floating">
        <span class="text text-dark"> <h4>Would you like to say something about the '.$_title_sept.' </h4></span>
        <textarea class="form-control comment_textarea" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
        </div>
        <hr>
        <div class="container"  style="margin:0px; padding:0px; ">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
        <button class="btn btn-primary confirme_comment form-control form-control" url="'.$url_sept.'" id_company="'.base64_encode($_SESSION['info_recrute']['id_recrute']).'"> Confirm  comment</button>
        </div> </div> </div>
        <div class="alert-comment"></div>';
        $next_comment .='</div> <hr>';

        return $next_comment;
    }
public function affiche_comment($_url_sept,$___db){

      $prepare = "SELECT * FROM sept_commentaire WHERE id_r_comment=:id_r_comment AND id_sept_comment=:id_sept_comment";

      $select_array =array(":id_r_comment"=>base64_encode($_SESSION['info_recrute']['id_recrute']), ":id_sept_comment"=>$_url_sept);
      $this->select_comment=$this->__select($prepare,$select_array,true,$___db);  
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