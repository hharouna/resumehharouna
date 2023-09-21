
<?php 
extract($_POST);
require_once("../../function_php/private_connect/root_mail_sms.php");
require_once("../../function_php/f_session/f_session.php");
require_once("../../function_php/url_mysql.php");
require_once("../../private/private_db_root.php"); 

class test_ipv4 extends __root_mysql{
    public $select_ipv4;
public function __construct()
{
    
}
public function test_ipv4($val_ipv4, $id_recrute, $_db){

            /* insertion des information company  */
            $select_ipv4_array= array(":id_test_recrute"=>base64_decode($id_recrute),":test_ipv4"=>$val_ipv4); 

            $prepare = "INSERT INTO test_penetration(id_test_recrute,test_ipv4) 
            VALUES (:id_test_recrute,:test_ipv4)";
            $this->select_ipv4= $this->__insert($prepare,$select_ipv4_array,$_db); 
            return json_encode(array('resultat'=>$this->select_ipv4,"id"=>$id_recrute,"con"=>$val_ipv4));


}


}

        $test_ivp4_ = new test_ipv4();
        //val_ipv4:val_ipv4,  id_ipv4_recrute:id_ipv4_recrute
        echo $test_ivp4_->test_ipv4($val_ipv4,$id_ipv4_recrute,$db);
?>