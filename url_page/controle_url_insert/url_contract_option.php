<?php 

/*
HAROUNA HAROUNA
function insert contrat_option_recrute 
9/13/2023


*/ 

 require_once("../../function_php/url_mysql.php");
 require_once("../../private/private_db_root.php"); 
 require_once("../../function_php/f_session/f_session.php");
class url_contract_option extends __root_mysql{
 
    public $contract_op_insert;  
    public function __construct()
    {
        
    }
    public function contract_option($_db,$_id_c_op,$_id_recrute,$_val_cont_op){

        $prepare = "INSERT INTO contrat_option_recrute(id_c_op,id_recrute_c_op,contenu_c_op) VALUES (:id_c_op,:id_recrute_c_op,:contenu_c_op)";
        $array = array(':id_c_op'=>base64_decode($_id_c_op),':id_recrute_c_op'=>$_SESSION['info_recrute']['id_recrute'],':contenu_c_op'=>$_val_cont_op); 
    
        $this->contract_op_insert =$this->__insert($prepare,$array,$_db);
        sleep(2);
        if($this->contract_op_insert==true):
        $form_contract =array("id_c_op_recrute"=>base64_encode($this->contract_op_insert),"btn_update"=>"btn_update","resultat"=>true,"insert_id"=>$this->contract_op_insert);
        else:
        $form_contract =array("Error"=>false,'msg'=>"Do again please something worn !!!");
        endif;
        return json_encode($form_contract); 

    }
  
}


        extract($_POST); 

        $url_session = new f_session();
        $url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);
        $url_contract_option = new url_contract_option();

  $array_val = array($id_c_op,$id_recrute,$val_cont_op);
  $array_label = array("id_c_op","id_recrute","champe is empty !!!"); 
  $count_array_val= count($array_val);
   for($i;$i<=$count_array_val;$i++){
    if(isset($array_val[$i]) && $id_recrute=$_SESSION['info_recrute']['id_recrute']):
        $array_val[$i]= preg_replace('#[^a-zA-Z0-9=@._-]#i','', $array_val[$i]);
    else if(empty($array_val[$i]) && $id_recrute=$_SESSION['info_recrute']['id_recrute']):
                if($i==2):
                    return json_encode(array("Error"=>false,'msg'=>"Requiere : "));
                    exit; 
                else:
                    $url_session->f_deconnect("hharouna",true,$_SERVER['SERVER_NAME']);
                    header("location: https://".$_SERVER['HTTP_HOST']); 
                    exit; 
                endif;
    else:
                $url_session->f_deconnect("hharouna",true,$_SERVER['SERVER_NAME']);
                header("location: https://".$_SERVER['HTTP_HOST']); 
    endif; 

   }

        echo $url_contract_option->contract_option($db,$id_c_op,$id_recrute,$val_cont_op);

















?>