<?php 
//require_once("function_php/url_mysql.php");

class url_foot{

public $foot;
public $type_cat, $_html_type_cat,$progress_url, $progress_sept_nav;
public $_sept_html, $sept_detail, $url_sept; 
public function __construct($__id_recrute,$__link_url,$__db,$_sql)
{
$this->foot ='<div class=" fixed-bottom container-fluid shadow-sm mt-2 p-2 bg-dark text text-light" ><div class="container-fluid cookies-foot">
<div class="container-fluid">  
</div> </div>';
$this->foot .="<div class='container-fluid' > 
<div class='row' >

<div class='col-12 col-sm-12 col-md-6 col-lg-6 mb-1'>";
$this->foot.=$this->sept_progress_nav($_SESSION['info_recrute']['id_recrute'],$__link_url,$__db,$_sql);
$this->foot.="</div>";
$this->foot.="<div class='col-12 col-sm-12 col-md-4 col-lg-4'>";
$this->foot.="<h6 class='text text-secondary'> <i class='fa-solid fa-copyright'></i> Copyright 2018-".date("Y")." HAROUNA HAROUNA  </h6> </div>
</div> ";
$this->foot .='<div class=" foot_cont  opacity-75 overflow-auto " style="display: none; widht: 100px;"> 
</div> </div></div></div> </div>';



}

public function sept_progress_nav($_id_recrute,$_link_url,$_db,$__sql){
   

  $prepare = "SELECT * FROM info_recrute, url_sept WHERE info_recrute.id_recrute=:id_recrute  AND info_recrute.id_recrute=url_sept.url_id_info_recrute ";    
  $select_array =array(":id_recrute"=>$_id_recrute);
  $this->progress_url=$__sql->__select($prepare,$select_array,false,$_db);  

  $prepare_sept = "SELECT * FROM sept";    
  $select_array =array();
  $this->progress_sept_nav=$__sql->__select($prepare_sept,$select_array,true,$_db);  
  
  $_array_sept = array($this->progress_url["url_sept_1"],$this->progress_url["url_sept_2"],$this->progress_url["url_sept_3"],$this->progress_url["url_sept_4"],$this->progress_url["url_sept_5"]);
  $_count_sept=count($_array_sept);

   $_array_btn = array('<i class="fa-solid fa-code fa-sm"></i>','<i class="fa-solid fa-shield-halved fa-sm"></i>','<i class="fa-solid fa-lock-open fa-sm"></i>','<i class="fa-solid fa-building fa-sm"></i>','<i class="fa-solid fa-file-contract fa-sm"></i>');
  //$array_sept=array();
  foreach( $this->progress_sept_nav['fectAll'] as $rs_fe => $_fecthAll){
    $array_url_sept[]= array("id"=>$_fecthAll['id_sept'],"url_sept"=>$_fecthAll['url_sept'],"url_link"=>$_fecthAll['url_link'],"title_sept"=>$_fecthAll['title_sept']);
  }

     $_count_url_sept = count($array_url_sept);
     $_affiche_progress ='<div class="container-fluid" style="margin-left:0px; padding-left:0px;  ">';
     $_affiche_progress .='<div class="row">';
     $_affiche_progress .="<div class='btn-group rounded'>
<a class=' btn  btn-primary  foot' truefalse='false'> <i class='fa-sharp fa-solid fa-circle-up'></i> </a>
";
      for($i=0;$i<=$_count_sept-1;$i++){ 
        if($_link_url==$array_url_sept[$i]['url_link']):
        $active= "active";
        $btn_active='secondary';
        else:
        $active= "";
        $btn_active='primary';
        endif; 
        if($_array_sept[$i]==1): 
        $_affiche_progress .= '
        <a class="btn btn-'.$btn_active.' 
        '.$active.'" href="https://'.$_SERVER['HTTP_HOST'].'/sept_url/'.$array_url_sept[$i]['url_link'].'/'.base64_encode($_id_recrute).'">  
        '.$_array_btn[$i].' </a> ';
        else:
        $_affiche_progress .='<a class="btn btn-primary" href="#"> '.$_array_btn[$i].' </a> ';
        endif; 
      }
      $_affiche_progress .='
      <a class="btn btn-primary" href="https://'.$_SERVER['HTTP_HOST'].'/sept_url/sign_out"> <i class="fa-solid fa-right-from-bracket fa-sm">  </i> </a>  </div> ';
      
      $_affiche_progress .=' </div> </div>';

return $_affiche_progress ;


}

}










?>