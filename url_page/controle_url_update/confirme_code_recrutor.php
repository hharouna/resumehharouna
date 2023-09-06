<?php 
require_once("../../function_php/url_mysql.php");
class confirme_code_recrutor extends __root_mysql{

public $tccin,$id_recrutre,$update_codetccin, $select_info_recrutre,$update_recrutre, $select_code_t_cc_in,$insert_url_sept ;
public function __construct($form__id)
{
    $this->id_recrutre=base64_decode($form__id);
    
}

public function confirme_code($form__id,$f__t,$f__cc,$f__in){

//require_once("../../private/private_resume.php"); 
$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
//$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");

 /* update active info_recrutre  
 info_recrute.info_active as recrute_active, code_t_cc_in.c_t as f_t, code_t_cc_in.c_cc as f_cc, code_t_cc_in.c_in as f_in*/
$prepare = "SELECT info_recrute.id_recrute as id_recru, info_recrute.info_active as recrute_active, code_t_cc_in.c_t as f_t, code_t_cc_in.c_cc as f_cc, code_t_cc_in.c_in as f_in
FROM info_recrute, code_t_cc_in WHERE info_recrute.id_recrute=:id_recrute
AND code_t_cc_in.id_recrutre_tccin=:id_recrute";

    $select_array =array(":id_recrute"=>$form__id);
    $this->select_info_recrutre=$this->__select($prepare,$select_array,false,$dbh);  
    $_rst = $this->select_info_recrutre;
    /* 
echo json_encode(array("Error"=>0, "id_recru"=>$_rst['id_recru'],"id_form"=>$form__id, "rst"=>$_rst,"f_t"=>$f__t, "f_cc"=>$f__cc,"f_in"=>$f__in));
exit; */
if($_rst["recrute_active"]==0 && $_rst["f_t"]==$f__t && $_rst["f_cc"]==$f__cc && $_rst["f_in"]==$f__in):
            /*recuperation des informations recruteur*/
            $prepare = "UPDATE info_recrute SET info_active=:info_active WHERE id_recrute=:id_recrute ";
            $select_array =array(":id_recrute"=>$form__id, ":info_active"=>1);
            $this->update_recrutre=$this->__update($prepare,$select_array,$dbh);  

          
        if($this->update_recrutre==true):

            /*  update modification code t cc in  */

            // $_rst_tccin = $this->select_code_t_cc_in;
            //  return $this->update_codetccin; 
  
            /*recuperation des informations recruteur */
            $prepare_tccin = "UPDATE code_t_cc_in SET active=:active WHERE id_recrutre_tccin=:id_recrutre_tccin";
            $update_array_tccin=array(":id_recrutre_tccin"=> $form__id , ":active"=>1);
            $this->update_codetccin =$this->__update($prepare_tccin,$update_array_tccin,$dbh);  

            $prepare_url_sept ="INSERT INTO url_sept(url_id_info_recrute,url_sept_1) VALUES (:url_id_info_recrute,:url_sept_1)";
            $array_url_sept =array(':url_id_info_recrute'=>$form__id,':url_sept_1'=>1);
            $this->insert_url_sept = $this->__insert($prepare_url_sept,$array_url_sept,$dbh); 

            //---------------- /--------- --------- // ----- /// -----------------------
/**/
            $prepare_codetccin = "SELECT * FROM code_t_cc_in WHERE f_in=:f_in";
            $select_array_tccin =array(":f_in="=>$f__in);
            $select_code_t_cc_in=$this->__select($prepare_codetccin,$select_array_tccin,false,$dbh);  

            echo json_encode(array("Error"=>1, "code"=>$_rst, "id"=>$form__id , 
            "truemode"=>$this->update_recrutre, "id_tccin"=>$select_code_t_cc_in, 
            "update_tccin"=>$this->update_codetccin, "link"=>"/sept_url/url_sept_1/$f__in")); 

            exit; 

        endif; 

    else:
        
        return array("Error"=>1, "link"=>"/sept_url/url_sept_1/$f__in");

 endif; 

        }
   
}

        extract($_POST);

        $_array_preg = array($f_t, $f_cc,$f_in);
        $_count_preg = count($_array_empty);

        for($i = 0; $i<=$_count_preg-1; $i++){
        $_array_preg[$i]= preg_replace('#[^a-zA-Z0-9=!.@_-*]#i','', $_array_preg[$i]);
        }

        $_array_empty = array($f_t, $f_cc,$f_in);
        $value = array("T","CC","IN");
        $_count_array = count($_array_empty);

        for($i = 0; $i<=$_count_array-1; $i++){
        if(empty($_array_empty[$i])):
        echo json_encode(array("msg"=>"empty : $value[$i]","Error"=>0));
        exit;
        endif;
        }

$decode_id_form_id =base64_decode($form_id);

$_code_confirme = new confirme_code_recrutor($decode_id_form_id); 
//156872 	637093 	NjE= {"Error":0,"commande":{"recrute_active":"1","0":"1","f_t":"148135","1":"148135","f_cc":"498794","2":"498794","f_in":"NTg=","3":"NTg="
echo json_encode($_code_confirme->confirme_code($decode_id_form_id,$f_t,$f_cc,$f_in));





















?>