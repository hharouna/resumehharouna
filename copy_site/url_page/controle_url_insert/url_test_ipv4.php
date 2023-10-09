
<?php 
extract($_POST);
require_once("../../function_php/private_connect/root_mail_sms.php");
require_once("../../function_php/f_session/f_session.php");
require_once("../../function_php/url_mysql.php");
require_once("../../private/private_db_root.php"); 

class test_ipv4 extends __root_mysql{
        public $select_ipv4,$_test_ipv4;
public function __construct()
{
    
}
public function test_ipv4($val_ipv4, $id_recrute, $_db){

        /* insertion des information company  */
        $select_ipv4_array= array(":id_test_recrute"=>base64_decode($id_recrute),":test_ipv4"=>$val_ipv4); 

        $prepare = "INSERT INTO test_penetration(id_test_recrute,test_ipv4) 
        VALUES (:id_test_recrute,:test_ipv4)";
        $this->select_ipv4= $this->__insert($prepare,$select_ipv4_array,$_db); 


        /*---
        Send E-mail de confirmation 
        
        */
        $_array_donne = array("r_id"=>base64_encode($_SESSION['info_recrute']['id_recrute'])  ,"r_active"=>$_SESSION['info_recrute']["info_active"], "r_email"=>$_SESSION['info_recrute']["info_email"]);
        $info_compagny = $_SESSION['info_recrute']['info_company_recrute'] ;

        require_once("../../function_php/private_connect/root_mail_sms.php");
        $_send_mail = new root_mail_sms();

                $_message ="<h3> Hi, $info_compagny. </h3> </br>

               <p> To receive the report, it is import that I reassure that you are well on the owner of Ipv4 tramsmit,</p>
               <p>thank you for providing me all documents allowing to carry out an analysis on your network.</p>

               <p> Thank you Mr Harouna </p>
                </br> 
                -------------------------------
                <h4> ip :  $val_ipv4 </h4> 

                </br> -------------------------------


                    "; 
       $r_mail= $_send_mail->cssmail($_message,$_SESSION['info_recrute']["info_email"],"hharouna@resumehharouna.net","Session Ethical Hacking, $info_compagny  by Harouna Harouna", "","resumehharouna.net",$_array_donne,"");
    if($r_mail==true):
        return json_encode(array('resultat'=>true,"id"=>$id_recrute,"table_ipv4"=>$this->select_test_ipv4($_db)));
    else:
        return json_encode(array('resultat'=>false,"msg"=>"Error: Msg de confirmation !!!"));
    endif; 

}

public function select_test_ipv4($___db){

    $prepare = "SELECT * FROM test_penetration WHERE id_test_recrute=:id_test_recrute ";

    $select_array =array(":id_test_recrute"=>$_SESSION['info_recrute']['id_recrute']);
    $this->_test_ipv4=$this->__select($prepare,$select_array,true,$___db);  
    $count_ipv4= count($this->_test_ipv4['fectAll']);
        sleep(2);


    if($count_ipv4>1):
            $r_test_ipv4='<table class="table bg-light">
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
                <td><button class="btn btn-danger btn-sm btn-delete-ipv4 form-control" id_test_ipv4="'.base64_encode($_fecthAll['id_test']).'" id_test_recrute="'.base64_encode($_fecthAll['id_test_recrute']).'"><i class="fa-solid fa-trash fa-sm"></i> </button></td>
                </tr>
              ';
      
            }
            $r_test_ipv4.= '</tbody></table>';
    else:

            $r_test_ipv4="<div class='container' style='margin:0px; padding:0px;'>";
            $r_test_ipv4.="<div class='row'>";
            $r_test_ipv4.="<div class='col-12 col-sm-12 col-md-12 col-lg-12 my-2'> ";
            $r_test_ipv4.='<div class="shadow-sm text text-light bg-dark p-2 rounded ">';
            $r_test_ipv4.='<div class=" r_table_ipv4">';
            $r_test_ipv4.='<table class="table bg-light rounded ">
            <thead>
            <tr>
            <th scope="col">ipv4 or website</th>
            <th scope="col">Delete</th>
            </tr> </thead> ';
            $r_test_ipv4.='<tbody >';
            foreach($this->_test_ipv4['fectAll'] as $rs_fe => $_fecthAll){
            $r_test_ipv4.='
                    <tr class="'.$this->base64url_encode($_fecthAll['id_test']).'">
                    <td>'.$_fecthAll['test_ipv4'].'</td>
                    <td><button class="btn btn-danger btn-sm btn-delete-ipv4 form-control" title="Delete" id_test_ipv4="'.base64_encode($_fecthAll['id_test']).'" id_test_recrute="'.base64_encode($_fecthAll['id_test_recrute']).'"><i class="fa-solid fa-trash fa-sm"></i> </button></td>
                    </tr>
                  ';
            }

            $r_test_ipv4.= '</tbody></table> <div>';
            $r_test_ipv4.="</div></div> </div></div> <div class='col-12 col-sm-12 col-md-12 col-lg-12 '>";
            $r_test_ipv4.='<div class="input-group mb-3 align-middle">';
            $r_test_ipv4.='<input type="text" class="form-control test_ipv4" placeholder="ipv4: '.$_SERVER['REMOTE_ADDR'].' or www.exemple.com" aria-describedby="button-addon2">
            <button class="btn btn-success btn-sm  btn-test-ipv4" title="Confirm"  id_ipv4_recrute="'.base64_encode($_SESSION['info_recrute']['id_recrute']).'" type="button" id="button-addon2"> Confirm <i class="fa-solid fa-unlock-keyhole fa-sm"></i></button>
            </div>
            <div class="alert-ipv4"></div>';
    endif;

        

      return array("count_ipv4" =>$count_ipv4, "table_ipv4"=>$r_test_ipv4);
            }
            public function base64url_encode($data) {

                return rtrim(base64_encode($data), '=');
    
                }
    
}

        if (empty($val_ipv4)) :
            echo json_encode(array("resultat"=>false, "msg"=>"Error: champ ipv4 empty !!!"));
            exit; 
        endif; 

        $ip   = gethostbyname($val_ipv4);
        $long = ip2long($ip);
        if ($long == -1 || $long === FALSE) :
            echo json_encode(array("resultat"=>false, "msg"=>"Error Ip , please Try again !!!"));
            exit; 
        endif; 

        $url_session = new f_session();
        $url_session->session("hharouna",true,$_SERVER['SERVER_NAME']);

        $test_ivp4_ = new test_ipv4();
        //val_ipv4:val_ipv4,  id_ipv4_recrute:id_ipv4_recrute
        echo $test_ivp4_->test_ipv4($val_ipv4,$id_ipv4_recrute,$db);

        
?>