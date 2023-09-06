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

$dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");
//$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");
   
$rs_id_comment =$this->confirme_comment($comment,$id_recrute, $sept_url,$dbh); 

$prepare = "SELECT * FROM sept_commentaire WHERE id_r_comment=:id_r_comment";

    $select_array =array(":id_r_comment"=>$id_recrute);
    $this->select_comment=$this->__select($prepare,$select_array,true,$dbh);  
    $_rst = $this->select_comment;
    $r_page ="<div class='container '>"; 
    $r_page .="<div class='row p-4 '>"; 
    $r_page .="<div class='col-12 bg-dark text text-light rounded shadow-sm p-2 mt-2 mb-2 '> <i class='fa-solid fa-heart fa-lg'style='color: #da0e13;'></i> Thanks for your participating ".$_SESSION['info_recrute']['info_company_recrute']."</div>"; 
    foreach($_rst['fectAll'] as $rs_fe => $_fecthAll){
        $r_page .= "<div class='form-control shadow-sm bg-light mt-2 pt-2 pb-2 rounded ' comment_id='".$_fecthAll["id_comment"]."' >"; 
        $r_page .= $_fecthAll["sept_comment"];
        $r_page .= " <br><span class='text text-secondary  text-sm'>  date : ".$_fecthAll['date_commentaire']." </span>";
        $r_page .= "</div>";
      }
      $r_page .="</div> </div>"; 

     return  $r_page; 


 }


 public function confirme_comment($_comment,$_id_recrute, $_sept_url,$db){

      /* insertion des information company  */
      $this->array_comment = array(":id_r_comment"=>$_id_recrute,
      ":id_sept_comment"=>$_sept_url,":sept_comment"=>$_comment); 
       
      $prepare = "INSERT INTO sept_commentaire(id_r_comment,id_sept_comment,sept_comment) 
      VALUES (:id_r_comment,:id_sept_comment,:sept_comment)";
      $this->resultat_c= $this->__insert($prepare,$this->array_comment,$db); 

      /* insertion des information company  */
    sleep(2);  

    return $this->resultat_c; 

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
    $session->session("hharouna",false,$_SERVER['SERVER_NAME']);
    $url_confirme_comment = new url_confirme_comment($id_recrute,$url,$comment_val);

    // resultat des donnees    
    $_resultat = array('resultat'=> true, "r"=>$url_confirme_comment->step_controle($comment_val,$id_recrute,$url)); 


    if(isset($comment_val)&& isset($id_recrute)&& isset($url)):
    echo json_encode($_resultat); 
    else:
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
    endif; 

?>