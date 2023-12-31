<?php
/*
/HAROUNA HAROUNA 
8/25/2023

*/

extract($_POST);
require_once("../../function_php/private_connect/root_mail_sms.php");
require_once("../../function_php/url_mysql.php");
require_once("../../function_php/f_session/f_session.php");

class url_confirme_comment extends __root_mysql{

    public $_mail_recrutor,$_id_recrute,$_sept_url,$_comment, $_user, $array_c, $_ip, $array_comment, $resultat_c, $select_comment; 

    public function __construct($comment,$id_recrute, $sept_url)
    {
       
        $this->_id_recrute = $id_recrute;
        $this->_sept_url= $sept_url;
        $this->_comment = $comment;
        $this->_user= $_SERVER['HTTP_USER_AGENT'];
        $this->_ip = $_SERVER['REMOTE_ADDR'];


    }

 public function step_controle($comment,$id_recrute, $sept_url){

    require_once("../../private/private_db_root.php"); 
 
  
$rs_id_comment =$this->confirme_comment($comment,$id_recrute, $sept_url,$db); 

$prepare = "SELECT * FROM sept_commentaire WHERE id_r_comment=:id_r_comment AND id_sept_comment=:id_sept_comment";

    $select_array =array(":id_r_comment"=>$id_recrute, ":id_sept_comment"=>$sept_url);
    $this->select_comment=$this->__select($prepare,$select_array,true,$db);  
    $_rst = $this->select_comment;
    $r_page ="<div class='container'>"; 
    $r_page .="<div class='row p-4 '>"; 
    $r_page .="<div class='col-12 bg-dark text text-light rounded shadow-sm p-2 mt-2 mb-2 '> <i class='fa-solid fa-heart fa-lg'style='color: #da0e13;'></i> Thanks for your participating ".$_SESSION['info_recrute']['info_company_recrute']."</div>"; 
    foreach($_rst['fectAll'] as $rs_fe => $_fecthAll){
        $r_page .= "<div class='form-control shadow-sm bg-light mt-2 pt-2 pb-2 rounded' comment_id='".$_fecthAll["id_comment"]."' >"; 
        $r_page .= $_fecthAll["sept_comment"];
        $r_page .= " <br><span class='text text-secondary  text-sm'>  date : ".$_fecthAll['date_commentaire']." </span>";
        $r_page .= "</div>";
      }
      $r_page .="</div> </div>"; 

     return  $r_page; 


 }


 public function confirme_comment($_comment,$_id_recrute, $_sept_url,$_db){

      /* insertion des information company  */
      $this->array_comment = array(":id_r_comment"=>$_id_recrute,
      ":id_sept_comment"=>$_sept_url,":sept_comment"=>$_comment); 
       
      $prepare = "INSERT INTO sept_commentaire(id_r_comment,id_sept_comment,sept_comment) 
      VALUES (:id_r_comment,:id_sept_comment,:sept_comment)";
      $this->resultat_c= $this->__insert($prepare,$this->array_comment,$_db); 

      /* insertion des information company  */
    sleep(2);  
    $_array_donne = array("r_id"=>base64_encode($_SESSION['info_recrute']['id_recrute'])  ,"r_active"=>$_SESSION['info_recrute']["info_active"], "r_email"=>$_SESSION['info_recrute']["info_email"]);
    $info_compagny = $_SESSION['info_recrute']['info_company_recrute'] ;

        require_once("../../function_php/private_connect/root_mail_sms.php");
        $_send_mail = new root_mail_sms();
        $session_tilte = $_SESSION['title_sept'];
        $_message ="<h3> Hi, $info_compagny. </h3> </br>

        <p> I have received your comment regarding the $session_tilte </p>

        <p> Thank you Mr Harouna </p>

        "; 
        $r_mail= $_send_mail->cssmail($_message,$_SESSION['info_recrute']["info_email"],"hharouna@resumehharouna.net","Session Ethical Hacking, $info_compagny  by Harouna Harouna", "","resumehharouna.net",$_array_donne,"");
        if($r_mail==true):
        return $this->resultat_c; 
        else:
        return json_encode(array('resultat'=>false,"msg"=>"Error: Msg de comment !!!"));
        endif; 


 }


 
}

/*
"

	
comment_val	""
id_recrute	"Mzk="
url	"url_sept_1"
"
*/
$_array_preg = array($comment_val, $id_recrute, $url_sept_1);
$_count_preg = count($_array_empty);

for($i = 0; $i<=$_count_preg-1; $i++){
          $_array_preg[$i]= preg_replace('#[^a-zA-z0-9=@._-]#i','', $_array_preg[$i]);
}

    $_array_empty = array($comment_val);
    $value = array("Comment!!!");
    $_count_array = count($_array_empty);

for($i = 0; $i<=$_count_array-1; $i++){
        if(empty($_array_empty[$i])):
            echo json_encode(array("contenu"=>"Require : $value[$i]","Error"=>0));
            exit;
            endif;
}

    $session = new f_session();
    $session->session("hharouna",true,$_SERVER['SERVER_NAME']);
    $url_confirme_comment = new url_confirme_comment($id_recrute,$url,$comment_val);

    // resultat des donnees    
    $_resultat = array('resultat'=> true, "r"=>$url_confirme_comment->step_controle($comment_val,$id_recrute,$url)); 


    if(isset($comment_val)&& isset($id_recrute)&& isset($url)):
    echo json_encode($_resultat); 
    else:
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
    endif; 

?>