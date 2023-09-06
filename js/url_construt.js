
(function() {
  // log all calls to setArray
  var proxied = jQuery.fn.setArray;

  var f_menu= {
     menu : function golbal_menu(){





     },
     menu_a: function a_link(){


      
     }




  }








  
  jQuery.fn.setArray = function() {
    console.log( this, arguments );
    return proxied.apply( this, arguments );





  };
})();