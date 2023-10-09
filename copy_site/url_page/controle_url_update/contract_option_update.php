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
 
    public $contract_op_update;  
    public function __construct()
    {
        
    }
    public function contract_option($_db,$_id_c_op,$_id_recrute,$_val_cont_op,$_id_c_op_recrute){
        $decode64 =base64_decode($_id_c_op_recrute);
        $prepare_update = "UPDATE contrat_option_recrute SET contenu_c_op=:contenu_c_op WHERE id_c_op_recrute=:id_c_op_recrute ";
        $array_update = array(':id_c_op_recrute'=>$decode64,':contenu_c_op'=>$_val_cont_op); 
    
        $this->contract_op_update =$this->__update($prepare_update,$array_update,$_db);
        sleep(2);
        if($this->contract_op_update==true):
        $form_contract =array("id_c_op_recrute"=>base64_encode($decode64),"btn_update"=>"btn_update","resultat"=>true,"update"=>$this->contract_op_update);
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


         //$val_cont_op= preg_replace('#[^a-zA-Z0-9=@._-]#i','', $val_cont_op);

                $array_val = array($id_c_op,$id_recrute,$val_cont_op, $id_c_op_recrute);
                $array_label = array("id_c_op","id_recrute","champe is empty !!!"); 
                $count_array_val= count($array_val);
                $base_64_id_recrute = base64_decode($id_recrute) ; 
                for($i = 0; $i<=$_count_preg-1; $i++){
                $array_val[$i]= preg_replace('#[^a-zA-Z0-9=@._-]#i','', $array_val[$i]);

                }
            
                if(empty($val_cont_op)):
                echo json_encode(array("contenu"=>"Require : $value[$i]","Error"=>0));
                exit;
                endif;

                echo $url_contract_option->contract_option($db,$id_c_op,$id_recrute,$val_cont_op, $id_c_op_recrute);
                exit; 




?>