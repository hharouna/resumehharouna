
<?php
  //  $dbh = new PDO('mysql:host=localhost;dbname=resumehharouna', "root", "0000001LE@");
    //$dbh = new PDO('mysql:host=localhost;dbname=c1prendall', "root", "eydf-MxkhI@CDC!J");

try{
	//$db = new PDO("mysql:host=78.138.45.54;dbname=c1prendall", "c1prendall", "111111lenoir");
	//$db = new PDO("mysql:host=localhost;dbname=phpmyadmin", "root", "eydf-MxkhI@CDC!J");
	//$db_admin = new PDO(HOST::$HOST_ADMIN, HOST::$USER, HOST::$PFFO.v1mUr1LQE3cHASS);
   // $db-> setAttribute(PDO::ATTR_ERRMODE, 'ATTR_EXCEPTION');
	//$db-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8'");
   }
catch(PDOException $Exception){
//$e-> getMessage("Probléme de connexion !!!");
$Exception->getMessage( ).$Exception->getCode( ) ;
	};

class test{


    public $affiche , $__db ,$array_select, $array_requete, $result_mysql;

    public function __select($_prepare,$array_execute, $_truefalse,$_db)
    {
   // function selection dans la basse de donnee
      $sqlselect= $_db->prepare($_prepare);
      $sqlselect->execute($array_execute);
      $count =$sqlselect->rowCount(); 
     /*
     explication:
      condition true :
        perment d'utiliser l option 
      
        foreach($_db_root_admin['fectAll'] as $rs_fe => $_fecthAll){
            $r_page .= $_fecthAll['root_mail'];
          }
        de la function fetchALL
      condition false :
          perment d'utiliser seulement la function fetch   
  
  */   

    if($_truefalse==true):

        $r_fetechAll= $sqlselect->fetchAll(PDO::FETCH_ASSOC); 

        if(empty($r_fetechAll)):
            return false;
        else:
          $return = array('fectAll'=>$r_fetechAll,'compte'=>$count);
          return $return; 
        endif;

    elseif($_truefalse==false):
          
        $r_fetech= $sqlselect->fetch(); 
          if(empty($r_fetech)):
            return false;
        else:
          return $r_fetech;
        endif; 
    endif; 
    

    }



public function contenu($__db){

    $this->array_select ="SELECT * FROM info_recrute";
    $this->array_requete=array();
    
    $this->result_mysql= $this->__select($this->array_select,$this->array_requete,false,$__db);
    
    return $this->result_mysql["info_email"]."/----// ".$this->result_mysql["info_company_recrute"]."/----// ".$this->result_mysql["date_recrute"]; 
    

}


}

$test = new test();


echo $test->contenu($dbh);

echo "erro";
?>
