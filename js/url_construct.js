$(document).ready(function() {
    // Handler for .ready() called.


 var btn_function = {
        ID_PAYS : function IDENTIFIANT_PAYS(){
         //    var form_participation = $( "form#form_participation" ).serialize()   ;
        },
        URL_PAYS : function pays(x_n, identifiant,value, input_this){
            
          
             $.ajax({ 
               beforeSend: function(){
           if(x_n=="x0"){
                $(".resultat").html(url_animation.url_spinner("light",true))
            }
             },
                url: "../url/url_construct/url_controle/url_controle_installation.php",
                type: 'POST', 
                dataType:"json", 
                data: {url_identifiant:identifiant, url_x_n:x_n, input_val:value},  
                success: function(resultat) {
               if(resultat['resultat']==false && resultat['x_n']=="x0"){
                $("input.x1").attr("disabled","disabled")

                  }else if(resultat['resultat']==true &&resultat['x_n']=="x0"){

                 $(".resultat").html("<class='container'><class='row'><class='col'>"+resultat['img']+'</div><div class="col4"></div></div></div>')
                 $("input.x1").removeAttr("disabled")
                 input_this.attr("disabled",true)
                 $("input.x_n").attr("identifiant",resultat['id_pays'])

                }
                else if(resultat['resultat']==true && resultat['x_n']!="x0"){
                 $("input."+resultat['x_n']).removeAttr("disabled")
                 input_this.attr("disabled",true)
                 $("div.progress-bar").css({
                   "width":+resultat['progress_bar']+"%"
                 })
                 $(".resultat").appendTo(resultat['x_n'])
                 if(resultat['progress_bar']=="100"){
                 $("#staticBackdrop").modal("show")
                 $(".modal-body").html('<form><div class="mb-3"><label for="recipient-name" class="col-form-label">Recipient:</label>'+
                   '<input type="text" class="form-control" id="recipient-name"></div>'+
                 '<div class="mb-3"><label for="message-text" class="col-form-label">Message:</label>'+
                   '<textarea class="form-control" id="message-text"></textarea>'+
                 '</div>     </form>      </div> <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'+
               '<button type="button" class="btn btn-primary">Send message</button>  </div> </div></div>'
       )
                    }

                }
            }
        
            })
        }, 
        URL_CONTROLE_XN: function x_n(x_n, identifiant,value){
            $.ajax({ 
                beforeSend: function(){
            
                 $(".resultat").html(url_animation.url_spinner("light",true))
              },
                 url: "../url/url_construct/url_controle/url_controle_installation.php",
                 type: 'POST', 
                 dataType:"json", 
                 data: {url_identifiant:identifiant, $url_x_n:x_n, input_val:value},  
                 success: function(resultat) {
                if(resultat['resultat']==false || resultat['resultat']=='' ){
                
                }else if(resultat['resultat']==true){
                 
                
                 

                 }
             }
         
             })
        },
        URL_FOOT : function foot(foot_this,foot_token){

          $.ajax({ 
            beforeSend: function(){
        
              foot_this.html(url_animation.url_spinner("light",true))
          },
             url: "../url/url_construct/url_page/url_page_foot.php",
             type: 'POST', 
             dataType:"json", 
             data: {token:foot_token},  
             success: function(resultat) {
           foot_this.html(resultat["url_foot"])
         }
     
         })
     
        },
        URL_COOKIES:function cooikes(){
          $.ajax({ 
            beforeSend: function(){
              $("#staticBackdrop").modal("show")
              $(".modal-body").html(url_animation.url_spinner("dark",true))
          },
             url: "../url/url_construct/url_page/url_page_cookies_session.php",
             type: 'POST', 
             dataType:"json", 
             data: {data:"controle"},  
             success: function(resultat) {
          
              $("#staticBackdrop").modal("show")
              $(".modal-body").html(resultat["url_cookies"]).css({
                  "height" : "500px",
                  
                })
         }
     
         })
         
        }
        ,
         URL_COOKIES_ACTIVES:function cookies_actives(url_cookies_actives,id_cookies,id_hua,checked_this,this_token){

          $.ajax({ 
            beforeSend: function(){
              //$("#staticBackdrop").modal("show").addClass(" bg-light ")
              //$(".modal-body").html(url_animation.url_spinner("dark",true))
          },
             url: "../url/url_construct/url_controle/url_controle_cookies.php",
             type: 'POST', 
             dataType:"json", 
             data: {data:"cookies",url_cookies_actives:url_cookies_actives,id_cookies:id_cookies,id_hua :id_hua, token:this_token},  
             success: function(resultat) {

              if(resultat["url_actives"]==true && url_cookies_actives==1 ){
              checked_this.removeAttr("checked").attr("url_cookies_actives","0")
              }
              else if(resultat["url_actives"]==true && url_cookies_actives==0){
                checked_this.attr("checked","checked").attr("url_cookies_actives","1")

              }
              else if(resultat["url_actives"]==true && url_cookies_actives==2){
              checked_this.attr("checked","checked").attr("url_cookies_actives","1")
              }
              }
     
         })
         }

    

    }

var url_animation = {
    url_spinner : function spinner(color,size, truefalse) {

    var spinner = '<div class="spinner-grow text-'+color+' spinner-grow-'+size+'" role="status"><span class="visually-hidden">Loading...</span></div>'
    return spinner; 
        
    },
    url_beforesend : function url_animation(truefalse){

        if(truefalse==true){

            var sipnner ='<div class="spinner-grow" role="status">'+
            +'<span class="visually-hidden">Loading...</span>'+
            '</div>'

        }
        else if(truefalse==false)
        {

        }

    },
   url_animation_foot: function animation_foot(f_this,this_btn, truefalse, token){
    btn_function.URL_FOOT(f_this,token); 
    if(truefalse=="true"){
      this_btn.attr("truefalse","false").removeClass("btn-secondary").addClass("btn-primary")
      this_btn.html('<i class="fa-sharp fa-solid fa-circle-up"></i> ')
    }else if(truefalse=="false"){
      this_btn.attr("truefalse","true").removeClass("btn-primary").addClass("btn-secondary")     
      this_btn.html('<i class="fa-sharp fa-solid fa-circle-down"></i> ')
    }
    f_this.addClass("bg-secondary shadow-sm m-1 p-1 rounded text-light")
    f_this.css({
              "min-height": "300px"
            })

   }
}






        $(document).on("click","a.link-cookies",function(){
       

          btn_function.URL_COOKIES()

        })


        $(document).on("keyup","input.x_n",function(){
        var input_x_n= $(this).attr("x_n")
        var input_identifiant =$(this).attr("identifiant")
        var input_val = $(this).val()

            if(input_x_n==''){
            $(".resultat").html("")
            }else{

            btn_function.URL_PAYS(input_x_n,input_identifiant,input_val, $(this))
           
          }


        })

        $(document).on("click","button.foot", function(){

          var this_btn =$(this)
          var t_f=$(this).attr("truefalse")
          var token = $("input.token").val()
          /* */
          var t = $(".foot_cont").toggle("slow",function(){
            console.log($(this))
            url_animation.url_animation_foot($(this),this_btn,t_f,token)            
          })

         

        })
     
    /*     */

 $(document).on("click","input.form-check-input", function(){
  
          
            var this_btn =$(this)
            var _url_cookies_actives=$(this).attr("url_cookies_actives")
            var _url_cookies=$(this).attr("url_cookies")
            var _url_id_hua=$(this).attr("id_hua")
            var token = $("input.token").val()
            /* */

            btn_function.URL_COOKIES_ACTIVES(_url_cookies_actives,_url_cookies,_url_id_hua, this_btn,token)     

            })
         

var fun_resume = {
     info_recrutor : function recrutor(compagny,email,b_this){
      $.ajax({ 
        beforeSend: function(){
          //$("#staticBackdrop").modal("show")
          $(b_this).html(url_animation.url_spinner("light","sm",true))
      },
         url: "url_page/controle_url_insert/url_c_insert_recrutor.php",
         type: 'POST', 
         dataType:"json", 
         data: {compagny: compagny ,  email: email},  
         success: function(resultat) {
         if(resultat['Error']==0){
          $(b_this).html('Valider  <i class="fa-solid fa-check"></i>')
          $("div.alert-company").addClass("alert alert-warning p-2 mt-2 form-control").html(resultat["contenu"])
         }else{
       $("#staticBackdrop").modal("show")
       $(".modal-content").html(url_animation.url_spinner("dark","",true)).addClass("m-3 p-3")
       $(".modal-content").html(resultat["form_tccin"]).addClass("m-3 p-3")
       $("input.compagny").attr("disabled", "disabled")
       $("input.mail").attr("disabled", "disabled")
       }
     }
 
     })
    },
     confirme_code : function c_code(form_id,id_tccin,f_t,f_cc,f_in,b_this){
      $.ajax({ 
        beforeSend: function(){
          $(b_this).html(url_animation.url_spinner("light","sm",true))
          $("input.t").attr("disabled", "disabled")
          $("input.cc").attr("disabled", "disabled")
          $("input.in").attr("disabled", "disabled")
      },
         url: "url_page/controle_url_update/confirme_code_recrutor.php",
         type: 'POST', 
         dataType:"json", 
         data: {form_id: form_id, id_tccin: id_tccin, f_t:f_t, f_cc:f_cc, f_in:f_in},  
         success: function(resultat) {
         if(resultat["Error"]==0){
          $("input.t").removeAttr("disabled")
          $("input.cc").removeAttr("disabled")
          $("input.in").removeAttr("disabled")
          $(b_this).html('Confirme code <i class="fa-solid fa-check"></i>')
          $("div.alert-confirme-code").addClass("alert alert-warning p-1 mt-2").html(resultat["msg"])
         }else{
          window.location.replace("https://resumehharouna.net"+resultat['link']);
         }
         
     }
 
     })
    }
     ,
     info_recrutor_confirme_code : function recrutor_insert(compagny,email,b_this){
      $.ajax({ 
        beforeSend: function(){
          //$("#staticBackdrop").modal("show")
          $(b_this).html(url_animation.url_spinner("light",true))
          $("#staticBackdrop").modal("show")
          $(".modal-content").html(url_animation.url_spinner("dark",true)).addClass("m-3 p-3")
      },
         url: "url_page/controle_url_insert/url_c_insert_recrutor.php",
         type: 'POST', 
         dataType:"json", 
         data: {compagny: compagny ,  email: email},  
         success: function(resultat) {
          
          $("#staticBackdrop").modal("show")
          $(".modal-content").html(resultat["form_tccin"]).addClass("m-3 p-3")
          if(resultat["r"]["r_active"]==0){
          $(".modal-content").html(resultat["form_tccin"]).addClass("m-3 p-3")

          $("input.compagny").attr("id_tccin", resultat["r"]["r_tccin"] )
          $("input.mail").attr("id_tccin", resultat["r"]["r_tccin"]) 
          } else{
          $(".modal-content").html(resultat["form_tccin"]).addClass("m-3 p-3")
          }
          $("input.compagny").attr("disabled", "disabled")
          $("input.mail").attr("disabled", "disabled") 
        }
 
     })


    }, 
    reload_code : function relode(form_id_, b_this){
      $.ajax({ 
        beforeSend: function(){
          //$("#staticBackdrop").modal("show")
          $(b_this).html(url_animation.url_spinner("light","sm",true))
      },
         url: "url_page/controle_url_page/url_controle_mail.php",
         type: 'POST', 
         dataType:"json", 
         data: {form_id:form_id_},  
         success: function(resultat) {
          if(resultat["resultat"]==true){
            $(".alert-reload-code").html("reload code success").addClass("alert-access form-controle")
             $(b_this).html('Relaod code <i class="fa-solid fa-rotate-right></i>').addClass("alert-primary")
            }else{
            $(".alert-reload-code").html("reload code success").addClass("alert-danger")
            $(b_this).html('Relaod code <i class="fa-solid fa-rotate-right></i>').addClass("alert-danger").removeClass("btn-primary")
            }
        }
 
     })


    },
    confirme_comment: function c_comment(b_this,comment__val,id__recrute,_url ){
      $.ajax({ 
        beforeSend: function(){
          //$("#staticBackdrop").modal("show")
          $(b_this).html(url_animation.url_spinner("light","sm",true))
      },
         url: "confirme/url_confirme_code",
         type: 'POST', 
         dataType:"json", 
         data: {comment_val:comment__val,id_recrute:id__recrute,url:_url},  
         success: function(resultat) {
          if(resultat["Error"]==0){
            $("div.alert-comment").html(resultat['contenu']).addClass("alert-danger rounded shadow-sm mt-2 p-2 text text-black form-controle")
             $(b_this).html('Confirme comment <i class="fa-solid fa-rotate-right></i>').addClass("btn-danger")
            }else{
            $("div.return_comment").html(resultat['r']).addClass("alert alert-success mt-3 p-2 text text-black")
            $(b_this).html('confirme comment <i class="fa-solid fa-rotate-right></i>').addClass("btn btn-primary ").removeClass("btn-danger")
            $("div.alert-comment").html("resultat['contenu']").removeClass("alert-danger rounded shadow-sm mt-2 p-2 text text-black form-controle")
            
          }
        }
 
     })


    }
    



}



/* liste des btn resume harouna */
$(document).on("click",".btn-info-recrute", function(){

  var this_btn =$(this)
  var f_compagny = $("input.compagny").val()
  var f_mail = $("input.mail").val()
    fun_resume.info_recrutor(f_compagny,f_mail,this_btn); 

  })

  $(document).on("click","button.confirme-code", function(){

    var this_btn =$(this)
    var f_id_tccin= $(this).attr("id_tccin")
    var f_form= $(this).attr("form_id")
    var f_t = $("input.t").val()
    var f_cc= $("input.cc").val()
    var f_in = $("input.in").val()
      fun_resume.confirme_code(f_form,f_id_tccin ,f_t,f_cc,f_in,this_btn); 
    })


      $(document).on("click","button.btn-info-r-close", function(){

      $("button.btn-info-recrute").html(' Valider  <i class="fa-solid fa-check"></i>')
      $("input.compagny").removeAttr("disabled")
      $("input.mail").removeAttr("disabled")
      })

      $(document).on("click","button.reload-code", function(){

      var btn_this = $(this)
      var btn_form_id= $(this).attr("form_id")
      $("button.btn-info-recrute").html(' Valider  <i class="fa-solid fa-check"></i>')
      fun_resume.reload_code(btn_form_id,btn_this)
      })


      $(document).on("click","button.confirme_comment", function(){

      var btn_this = $(this)
      var comment_val= $("textarea.comment_textarea").val()
      var id_recrute= $(this).attr('id_company')
      var url= $(this).attr('url')

      fun_resume.confirme_comment(btn_this,comment_val,id_recrute,url)
      })


     /* 
      $(document).on("click","button.btn-info-r-close", function(){

        var btn_this = $(this)
        $("button.btn-info-recrute").html(' Valider  <i class="fa-solid fa-check"></i>')
        $("input.compagny").removeAttr("disabled")
        $("input.mail").removeAttr("disabled")
        })
 
        window.location.replace(
          "https://developer.mozilla.org/en-US/docs/Web/API/Location.reload",
        );
*/

})

