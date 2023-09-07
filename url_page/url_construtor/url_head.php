<?php 

class url_head{

 // url_head regroupe l'ensembles des js, css,scss, meta, cross, du head 
  


 //public $dir_js, $lien_meta_array,
 public $css, $js,$meta, $lien_meta_array;
 public $_url_head, $decode_url, $url_title; 


  public function __construct($HTTP_HOST)
  {
  
/*
  if(isset($URL)):
      $this->decode_url= $this->decode_generate_url($HEAD_TITLE);
  else:
      $this->decode_url= $this->decode_generate_url($HEAD_TITLE);
  endif; 
*/
    //$this->url_title= $this->decode_url['url'];
      $this->css = $this->_url_css($HTTP_HOST);
      $this->js = $this->_url_js($HTTP_HOST);
      $this->meta= $this->_url_meta_secure($HTTP_HOST);

      $this->_url_head="<head>";
      $this->_url_head.=$this->js;
      $this->_url_head.=$this->css;
      $this->_url_head.=$this->meta;
      $this->_url_head.="<title>Resume Harouna HAROUNA</title>"  ;
      $this->_url_head.="</head>" ;  

  }

  public function isSecure()
  {
     /*
      verification de ssl 
        HTTPS : ACTIVE OU PAS 
    */ 
          if (
          ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
          || ( ! empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
          || ( ! empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
          || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
          || (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT'] == 443)
          || (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https')
          ) {
          return true;
          } else {
          return false; 
         
      }  
  } 


  public function _url_js($URL_HOST){
  
    $_JS='<script src="'.($this->isSecure() ? 'https' : 'http')."://".$URL_HOST.'/js/jquery.js"></script>
        <script src="'.($this->isSecure() ? 'https' : 'http')."://".$URL_HOST.'/js/url_construct.js"></script>
        <script src="'.($this->isSecure() ? 'https' : 'http')."://".$URL_HOST.'/css/css/dist/js/bootstrap.js"></script>
       <script src="'.($this->isSecure() ? 'https' : 'http')."://".$URL_HOST.'/css/font/js/all.js"></script>'; 
  /*   */
    return $_JS;
    //return L'ensembles _head
    /**/ 
  }
 
  public function _url_css($URL_HOST)
  {
    $_CSS ='<link rel="stylesheet" href="'.($this->isSecure() ? 'https' : 'http')."://".$URL_HOST.'/css/css/dist/css/bootstrap.css">';
    $_CSS .='<link rel="stylesheet" href="'.($this->isSecure() ? 'https' : 'http')."://".$URL_HOST.'/css/font/css/all.css">';
    $_CSS .='<link class="rounded bg-dark" rel="icon" type="image/png" id="favicon"  href="'.($this->isSecure() ? 'https' : 'http')."://".$URL_HOST.'/url_page/image/myself.png"/>';
    $_CSS .='<link rel="apple-touch-icon" href="img/myself">';
    return $_CSS;

  }
  public function _url_meta_secure($URL_HOST){



    /*
    "<meta http-equiv='Content-Security-Policy' content='script-src self 192.168.0.145:300 192.168.0.145:301 unsafe-inline  ;' /> " ;
        
    */  
            $this->lien_meta_array = array(array("url_script-src"=>"maps.googleapis.com"),
            array("url_script-src"=>"developers.google.com")); 
            $compte = count($this->lien_meta_array); 


            $_meta =' <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="keywords" content="HTML, CSS, XML, XHTML, JavaScript">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> ';
            
            $_meta .='<meta http-equiv="Content-Security-Policy" ';
            $_meta .='content="script-src ';
            $_meta .=" 'self' ";
            for($i=0;$i<$compte;$i++){
                 $_meta .=$this->lien_meta_array[$i]['url_script-src']." ";
            }
            $_meta .=" 'unsafe-inline'";
            $_meta .=' ;">';
    
            return $_meta;      

    }

    public function decode_generate_url($url_page_encode)
  {

    /*
    encodage de l'url avec base64_encode
    array("url"=>$_url,
    "dir"=>$_dir,
    "conditon"=>json_encode($_conditon),
    "token"=>$this->__token,
    "other"=>$_other
      */
    //return  $decode_url["url"]."/ -------- \/".$decode_url["dir"]."/ -------- \/".$decode_url["condition"]["ID_continent"] ."/ -------- \/".$decode_url["token"] ."/ -------- \/".$decode_url["other"]  ; 

  
    $decode_url =  json_decode(base64_decode(base64_decode($url_page_encode)),true); 
    $decode_id  = json_decode($decode_url["condition"],true);

    
    return  $decode_url; 


  }
}


