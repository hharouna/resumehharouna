<?php 
class url_foot{

public $foot;

public function __construct()
{
    $this->foot ='<div class=" fixed-bottom container-fluid shadow-sm mt-2 p-2 bg-dark text text-light" ><div class="container-fluid cookies-foot">
    <div class="container-md  ">  
        </div> </div>';
$this->foot .="<div class='container' > <div class='row p-1' >
<button class=' col-1  btn foot btn-primary  rounded' truefalse='false'> <i class='fa-sharp fa-solid fa-circle-up'></i> </button>
            
              
                <div class='col text-center'> <h6> <i class='fa-solid fa-copyright'></i> Copyright 2018-".date("Y")." HAROUNA HAROUNA  </h6> </div>
                  </div> </div> ";
$this->foot .='<div class=" foot_cont  opacity-75 " style="display: none; widht: 400px;">
    
  </div>
  </div>
 ';
 

}

}










?>