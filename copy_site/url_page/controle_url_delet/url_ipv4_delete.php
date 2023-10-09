
<?php 
extract($_POST);
require_once("../../function_php/private_connect/root_mail_sms.php");
require_once("../../function_php/f_session/f_session.php");
require_once("../../function_php/url_mysql.php");
require_once("../../private/private_db_root.php"); 

class test_ipv4 extends __root_mysql{
            public $delete_ipv4,$_test_ipv4;
    public function __construct()
    {
        
    }
    public function delete_test_ipv4($_id_line_ipv4, $id_recrute, $_db){

        /* insertion des information company  */
        $id_test = base64_decode($_id_line_ipv4);
        $delete_ipv4_array= array(":id_test"=> $id_test ); 
        $prepare = "DELETE FROM test_penetration 
        WHERE test_penetration.id_test=:id_test  ";
        $this->delete_ipv4= $this->__delete($prepare,$delete_ipv4_array,$_db); 
        sleep(2);
        return json_encode(array('resultat'=>true,"id"=>rtrim($_id_line_ipv4,"=")));

        }



    public function base64url_encode($data) {

    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');

    }



    public function base64url_decode($data) {

    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));

    }

}
        

        $url_session = new f_session();
        $url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);
       
        $test_ivp4_ = new test_ipv4();
        //val_ipv4:val_ipv4,  id_ipv4_recrute:id_ipv4_recrute
        echo $test_ivp4_->delete_test_ipv4($id_ligne_ipv4,$id_ipv4_recrute,$db);

        
?>