<?php 
class url_foot{

public $foot;

public function __construct($token,$HTTP_HOST,$_root_mysql,$_db,$url_page_encoder)
{
    $this->foot ='<div class=" fixed-bottom opacity-75  container-fluid shadow-sm mt-2 bg-dark" ><div class="container-fluid cookies-foot bg-dark">
    <div class="container-md  "> 
    
    </div> </div>
    
';
$this->foot .="<div class='container' > <div class='row p-1' >
<button class=' col-1  btn foot btn-primary m-1 rounded' truefalse='false'> <i class='fa-sharp fa-solid fa-circle-up'></i> </button>
                <div class='col text-center'> <h6> <i class='fa-solid fa-copyright'></i> Copyright 2023-".date("Y")." Prendall </h6> </div>
                  </div> </div> ";
$this->foot .='<div class=" foot_cont " style="display: none; widht: 400px;">
    
  </div>
  </div>
 ';
 

}

}










?>