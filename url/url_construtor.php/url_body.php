<?php


class url_body {


public $html_body, $cont_start,  $cont_end, $nav_start, $nav_end;
public $cont_contenu, $search, $require_url , $_connexion; 
public $url_mysql; 

public function __construct($token,$HTTP_HOST,$_root_mysql,$_db,$url_page_encoder)
{
    /*
    html_body constuire l'ensemble de la page 
    */ 

        $this->url_mysql = $_root_mysql;

        $this->html_body='<body class="" token="'.$token.'">';
        $this->html_body.=$this->body();
        $this->html_body.=$this->menu($HTTP_HOST,$_root_mysql,$_db); 
        $this->html_body.=$this->page_search();
        $this->html_body.=$this->container($token,$HTTP_HOST,$url_page_encoder,$_db,$_root_mysql);
        $this->html_body.=$this->page_container_extension($HTTP_HOST);
        $this->html_body.=$this->page_butdown($HTTP_HOST); 
        $this->html_body.='</body>';

}


public function body(){

   
  

}

public function container($token_body, $HOST,$url_encoder,$_db_, $_root_mysql_){


    $this->cont_start='<div class="container-fluid  " token="'.$token_body.'">';
    $this->cont_start.=$this->page_container($HOST,$url_encoder,$_db_, $_root_mysql_);
    $this->cont_end ='</div>';   
    $this->cont_contenu =$this->cont_start;
    $this->cont_contenu .=$this->cont_end;

    return  $this->cont_start.$this->cont_end; 

}

public function menu($HOST,$__root_mysql_,$__db_){

    require_once("menu/menu_principale.php");
    $list_menu= new liste_menu($__db_,$__root_mysql_,$token,$HOST);
        $this->nav_start= '<nav class="navbar navbar-expand-lg bg-default shadow-sm ">
        <div class="container-fluid">
        <a class="navbar-brand" href="'.$HOST.'">
        <img src="'.$HOST.'/logo_prendall/p.png" alt="" width="45" height="36" title="prendall.net">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="'.$HOST.'"><i class="fa-solid fa-house-chimney-crack  "></i></a>
        </li> 
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="'.$HOST.'"><i class="fa-brands fa-golang"></i></a>
        </li>';

        $this->nav_start.= $list_menu->c_menu;
        $this->nav_start.= $list_menu->c_docs;
        $this->nav_start.= $list_menu->c_connexion;
        


        $this->nav_start.='</ul></div></div></nav>';

  return $this->nav_start;
}
public function page_search(){

    require_once("url_search/url_search.php");
    $u_search = new url_search();
    
    return $u_search->search_all();
}




public function page_container($HOST,$u_encoder,$___db,$__root_mysql){
        

    /*
    
la function decode_generate_url decode l'ensemble des url 
reception et controle 
construction de la page

    */
       
        if(isset($u_encoder)):

            $para_url = $this->decode_generate_url($u_encoder); 
            if($this->controle_dir($para_url["dir"])==true):
                require_once($para_url["dir"]);
                $session_page = new url_page($HOST,$para_url,$___db,$__root_mysql);
                $resultat = $session_page->page();
            else:
                require_once("url_page/url_page_404.php");
                $session_page = new url_page("Error 404");
                $resultat = $session_page->page();

            endif;     
            
        elseif(empty($u_encoder)):
            
                require_once("url_page/url_page_default.php");
                $session_page = new url_page($HOST);
                $resultat = $session_page->page();

        else :
            
                require_once("url_page/url_page_404.php");
                $session_page = new url_page("Error 404");
                $resultat = $session_page->page();

         endif;
       
        return '<div class="container-fluid">'.$resultat.'</div>';

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
    
    //return  $decode_url["url"]."/ -------- \/".$decode_url["dir"]."/ -------- \/".$decode_url["condition"]["ID_continent"] ."/ -------- \/".$decode_url["token"] ."/ -------- \/".$decode_url["other"]  ; 

    */
    $decode_url =  json_decode(base64_decode(base64_decode($url_page_encode)),true); 
    $decode_id  = json_decode($decode_url["condition"],true);

    
    return  $decode_url; 

        }

public function controle_dir($dir){
 /*cette function verifira l'existance du dossier et la page */

return true; 
}
public function page_slider(){
    /*unique que sur la page accueil */

}
public function page_container_extension($HOST){

}

public function page_butdown($HOST){


}


}







?>