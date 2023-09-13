



<?php
require_once('../../function_php/url_mysql.php'); 

class url_sept_page extends __root_mysql{

    public $_html; 

  public $type_cat, $select_comment,$contrat_op;
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
        $this->_html = '<div class="container-lg shadow-sm rounded bg-dark text-light mb-3 p-3" > 
        <div class="row row-cols-1 row-cols-md-3 g-3 text-black">';


        /*

        foreach($_db_root_admin['fectAll'] as $rs_fe => $_fecthAll){
        $r_page .= $_fecthAll['root_mail'];
        }
        */      
        foreach($this->type_cat['fectAll'] as $rs_fe => $_fecthAll){
          $title_sept=$_fecthAll['title_sept']; 
          $this->_html.='
          <div class="col">
          <div class="card h-100 p-2">
          <div class="text text-primary text-center" ><i class="'.$_fecthAll['c_image'].'"></i> </div>
          <div class="card-body">
          <h4 class="card-title">'.$_fecthAll['c-title'].' </h4>';
            
          $this->_html.= $this->type_cat_contenu($_fecthAll['id_cathegorie'],$_db);
         
          $this->_html.='</div>
          </div>
          </div>';
        }

        $this->_html.='</div>';
        $this->_html.=$this->contract_option($_SESSION['info_recrute']['id_recrute'],$_db);


        $this->_html.=$this->commentaire_ckeditor($url__sept,$title_sept,$_db);
        $this->_html.=' </div></div>';


        return  $this->_html ;

        }
     public funcTion contract_option($id_type_cat,$__db){
         
           
        $prepare = "SELECT * FROM contrat_option";

        $select_array =array();
        $this->contrat_op=$this->__select($prepare,$select_array,true,$__db);  
        $count= count($this->contrat_op);
        $form_contract ="<div class='container-md shadow-sm rounded mt-2  p-1 text-black bg-light' >";

        $form_contract .="<div class='row'>";
        $form_contract .="<div class='col-12 col-sm-12 col-md-12 col-lg-12 m-2'> <h5 class='text text-center text-danger '>".ucwords($_SESSION['info_recrute']['info_company_recrute']).",
         Thanks for answer all forms <i class='fa-solid fa-heart fa-lg' style='color: #da0e13;'></i> </h5> </div>";
        $form_contract .="<div class='col-12 col-sm-12 col-md-7 col-lg-7' >";
        foreach($this->contrat_op['fectAll'] as $rs_fe => $_fecthAll){
         
        $form_contract .=' <div class="container shadow-sm my-1 bg-dark text text-light rounded" style="margin:0px; padding:0px; ">';
        $form_contract .=' <div class="row">';
        $form_contract .=' <div class="col-12 text text-center">'.$_fecthAll['name_option'].'</div>';
        $form_contract .=' <div class="col-12 text text-center">';
        $form_contract .=' <div class="container"  style="margin:0px; padding:0px; ">';
        $form_contract .=' <div class="row">';
        $form_contract .=' <div class="col-2 col-sm-2 col-md-2 col-lg-2 ms-1"> '.$_fecthAll['icon_option'].' </div>';
        $form_contract .=' <div class="col-9 col-sm-9 col-md-9 col-lg-9">';
        $form_contract .=' <div class="input-group mb-3">';
        if($_fecthAll['id_contrat_op']!=3):
        $form_contract .='<input type="text" class="form-control form-control-sm val-sept-'.$_fecthAll['id_contrat_op'].'" style="margin:0px; padding:0px" placeholder="" aria-label="form-control-sm " aria-describedby="button-addon2">';
        else:
        $form_contract .='<input class="form-control form-control-sm val-sept-'.$_fecthAll['id_contrat_op'].'" list="datalistOptions" id="exampleDataList" placeholder="Full-Time or Part-time">
            <datalist id="datalistOptions">
            <option value="Full-Time">
            <option value="Part-Time">
            </datalist>';
        endif;
        $form_contract .=' <button class="btn btn-outline-success" val_input="val'.$_fecthAll['id_contrat_op'].'" val_id="'.$_fecthAll['id_contrat_op'].'" type="button" id="button-addon2"><i class="fa-solid fa-check fa-lg"></i> </button>
        </div></div></div>
        </div></div>
        </div></div>';
            }

        $form_contract .='</div> <div class="col-12 col-sm-12 col-md-4 col-lg-4  text text-black"> <div class=" p-2 border border-dark  mx-2 shadow-sm rounded"> comprendre</div> </div> ';
        $form_contract .='</div></div>';

        return $form_contract; 
/*
            <label for="exampleDataList" class="form-label">Datalist example</label>
         
            
*/
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



 
 public function commentaire_ckeditor($url_sept,$_title_sept,$__db){
 
    $next_comment = '<hr > <div class="return_comment">';
    $next_comment .= $this->affiche_comment($url_sept, $__db);
    $next_comment .= '</div>';
    $next_comment .= '<hr><div class="container-lg bg-light mt-3 shadow-sm rounded p-2 ">';
    $next_comment .='<div class="form-floating">
    <span class="text text-dark"> <h4> Would you like to say something about the '.$_title_sept.' </h4></span>
    <textarea class="form-control comment_textarea" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
    </div>
    <hr>
    <div class="container"  style="margin:0px; padding:0px; ">
    <div class="row">
    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
    <button class="btn btn-primary confirme_comment form-control" url="'.$url_sept.'" id_company="'.base64_encode($_SESSION['info_recrute']['id_recrute']).'"> Confirme  comment</button>
    </div> </div> </div>
    <div class="alert-comment"></div>
    ';
    $next_comment .='</div> <hr>';

    return $next_comment;
 }
public function affiche_comment($_url_sept,$___db){

      $prepare = "SELECT * FROM sept_commentaire WHERE id_r_comment=:id_r_comment AND id_sept_comment=:id_sept_comment";

      $select_array =array(":id_r_comment"=>base64_encode($_SESSION['info_recrute']['id_recrute']), ":id_sept_comment"=>$_url_sept);
      $this->select_comment=$this->__select($prepare,$select_array,true,$___db);  
      $_rst = $this->select_comment;
      if(isset($_rst)):
      $r_page ="<div class='container' >"; 
      $r_page .="<div class='row p-4 '>"; 
      $r_page .="<div class='col-12 bg-success text text-light rounded shadow-sm p-2 mt-2 mb-2 '> <i class='fa-solid fa-heart fa-lg'style='color: #da0e13;'></i> Thanks for your participating ".ucwords($_SESSION['info_recrute']['info_company_recrute'])."</div>"; 
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