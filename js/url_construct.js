$(document).ready(function() {
    /*
    
    thanks Harouna HAROUNA
    
    */

      var btn_function = {
      URL_FOOT : function foot(foot_this,foot_token){
      $.ajax({ 
      beforeSend: function(){
      foot_this.html(url_animation.url_spinner("light",true))
      },
      url: "confirme/url_page_foot",
      type: 'POST', 
      dataType:"json", 
      data: {token:foot_token},  
      success: function(resultat) {
      foot_this.html(resultat["url_foot"])
      }
      })
      }
     
      }
 

      var url_animation = {
      url_spinner : function spinner(color,size,truefalse) {

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
      "max-height": "400px"
      })

      }
      }

      $(document).on("click","a.foot", function(){

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
        $(b_this).html('Confirm <i class="fa-solid fa-check"></i>')
        $("div.alert-company").addClass("alert alert-warning p-2 mt-2 form-control").html(resultat["contenu"])
        }
        else if(resultat['resultat']==true && resultat['r']['r_active']==1){
        window.location.replace(resultat['r']['link']);
        }else{
        $("#staticBackdrop").modal("show")
        $(".modal-content").html(resultat["form_tccin"])
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
      $(b_this).html('Confirm code <i class="fa-solid fa-check"></i>')
      $("div.alert-confirme-code").addClass("alert alert-warning p-1 mt-2").html(resultat["msg"])
      }else{
      window.location.replace(resultat['link']);
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
      $(".alert-reload-code").html("Reload code success").addClass("shadow-sm alert alert-success form-control p-1 text text-center").attr('role','alert')
      $(b_this).html('Relaod code <i class="fa-solid fa-rotate-right"></i>').addClass("alert-primary")
      }else{
      $(".alert-reload-code").html("trying again !!!").addClass("alert alert-danger form-control p-1 text text-center")
      $(b_this).html('Relaod code <i class="fa-solid fa-rotate-right"></i>').addClass("alert-danger").removeClass("btn-primary").attr('role','alert')
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
      $(b_this).html('Confirm comment <i class="fa-solid fa-rotate-right></i>').addClass("btn-danger")
      }else{
      $("div.return_comment").html(resultat['r']).addClass("alert alert-success mt-3 p-2 text text-black")
      $(b_this).html('confirm comment <i class="fa-solid fa-rotate-right></i>').addClass("btn btn-primary ").removeClass("btn-danger")
      $("div.alert-comment").html("resultat['contenu']").removeClass("alert-danger rounded shadow-sm mt-2 p-2 text text-black form-controle")
      }
      }

    })
    },  
   contract_option : function contract_op(b_this,type_mode,id_c_op,val_cont_op,id_recrute, btn_input_op){
      $.ajax({ 
      beforeSend: function(){
      $(b_this).html(url_animation.url_spinner("light","sm",true))
      $(btn_input_op).fadeIn('slow',500)
      },
      url: "confirme/url_contract_option",
      type: 'POST', 
      dataType:"json", 
      data: {type_mode:type_mode,val_cont_op:val_cont_op,id_c_op:id_c_op ,id_recrute:id_recrute},  
      success: function(resultat) {

      if(resultat['resultat']==true){

      $(btn_input_op).attr("disabled","disabled").fadeIn("slow",500).addClass('bg-secondary')
      $(b_this).html('<i class="fa-regular fa-pen-to-square"></i>').removeClass("btn-outline-success btn-contract-option").addClass("btn-outline-primary btn-contract-mod").attr('id_c_op_recrute',resultat['id_c_op_recrute'])

      }else{

      }
      }
      })
      },
      contract_option_update : function contract_op_update(b_this,type_mode,id_c_op,val_cont_op,id_recrute, btn_input_op, id_c_op_recrute){
        $.ajax({ 
          beforeSend: function(){
          $(b_this).html(url_animation.url_spinner("light","sm",true))
          $(btn_input_op).fadeIn('slow',500)
          },
          url: "confirme/url_contract_update",
          type: 'POST', 
          dataType:"json", 
          data: {type_mode:type_mode,val_cont_op:val_cont_op,id_c_op:id_c_op ,id_recrute:id_recrute, id_c_op_recrute:id_c_op_recrute},  
          success: function(resultat) {
        if(resultat['resultat']==true){

        $(btn_input_op).attr("disabled","disabled").fadeIn("slow",500).addClass('bg-secondary text-light').removeClass('border border-danger border-2 text-black  ')     
        $(b_this).html('<i class="fa-regular fa-pen-to-square"></i>').removeClass("btn-outline-success btn-contract-option btn-contract-mod-val border-danger").addClass("btn-outline-primary btn-contract-mod")

        }else{

        }
        }
        })
        }, 
        test_ipv4 : function test_ip(b_this, val_ipv4,  id_ipv4_recrute){
          $.ajax({ 
            beforeSend: function(){
            $(b_this).html(url_animation.url_spinner("light","sm",true))
            $("input.test_ipv4").fadeIn('slow',500).addClass("bg-secondary")
            },
            url: "confirme/url_test_ipv4",
            type: 'POST', 
            dataType:"json", 
            data: { val_ipv4:val_ipv4,  id_ipv4_recrute:id_ipv4_recrute},  
            success: function(resultat) {
          if(resultat['resultat']==true){
              if(resultat['table_ipv4']['count_ipv4']>1){
              $('div.r_table_ipv4').html(resultat['table_ipv4']['table_ipv4']).fadeIn("slow",500)
              } else{
              $('div.all_table_ipv4').html(resultat['table_ipv4']['table_ipv4']).fadeIn("slow",500)
              }
              $("div.alert-ipv4").html("").removeClass('alert alert-danger shadow-sm').removeAttr('role').hide()
              $("input.test_ipv4").attr('value','').removeClass("bg-secondary")
              $(b_this).html( 'Confirm <i class="fa-solid fa-unlock-keyhole fa-sm"></i>').removeClass(" btn-danger").addClass('btn-success')

          }else{

              $("div.alert-ipv4").html(resultat['msg']).addClass('alert alert-danger shadow-sm').attr('role', 'alert').show(); 
              $("input.test_ipv4").removeClass("bg-secondary")
              $(b_this).html( 'Confirm <i class="fa-solid fa-unlock-keyhole fa-sm"></i>').removeClass("btn-success").addClass('btn-danger')

          }
          }
          })
          }, 
          delete_test_ipv4 : function delete_ipv4(b_this, idligne_ipv4, id_ipv4_recrute){
            $.ajax({ 
              beforeSend: function(){
               
              $(b_this).html(url_animation.url_spinner("light","sm",true))
              },
              url: "confirme/url_delete_ipv4",
              type: 'POST', 
              dataType:"json", 
              data: { id_ligne_ipv4:idligne_ipv4, id_ipv4_recrute:id_ipv4_recrute},  
              success: function(resultat) {

                if(resultat['resultat']==true){
                  $("."+resultat['id']).remove();
                   $(b_this).remove()
                   $('input.test_ipv4').val("")
                }
               

              }
            })
            },
            assistance : function f_assistance(b_this){

              $.ajax({ 
                beforeSend: function(){
                 
                $(b_this).html(url_animation.url_spinner("light","sm",true))
                },
                url: "assistance/hharouna",
                type: 'POST', 
                dataType:"json", 
                data: {},  
                success: function(resultat) {
  
              
                 
  
                }
              })

            }, 
             assistance_creat : function f_assistance(b_this,chat_creat){

              $.ajax({ 
                beforeSend: function(){
                 
                $(b_this).html(url_animation.url_spinner("light","sm",true))
                },
                url: "chat/creat",
                type: 'POST', 
                dataType:"json", 
                data: {chat:chat_creat},  
                success: function(resultat) {
                if(resultat['resultat']==true){
                  $(".chat_creat_script").html(resultat['update']).hide()
                $(b_this).html(  url_animation.url_spinner("light","sm",true)+'<span role="status">Loading...</span>')
               .removeClass("btn-creat-chat")     
                }
              }
              })

            }
  


}



/* liste des btn resumehharouna */
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
         $(document).on("click","button.btn-test-ipv4", function(){

          var btn_this = $(this)
          var val_test_ipv4= $("input.test_ipv4").val()
          var id_ipv4_recrute= $(this).attr('id_ipv4_recrute')
          fun_resume.test_ipv4(btn_this,val_test_ipv4,id_ipv4_recrute)
    
          })
         $(document).on("click","button.btn-delete-ipv4", function(){
         var truefalse=prompt("Confirm : Y OR n")
         if(truefalse=="Y" || truefalse=="y" ){
            var btn_this = $(this)
            var id_ligne_ipv4=$(this).attr('id_test_ipv4')
            var id_ipv4_recrute= $(this).attr('id_test_recrute')
            fun_resume.delete_test_ipv4(btn_this,id_ligne_ipv4,id_ipv4_recrute)
            }
            })

      $(document).on("click","button.btn-contract-mod", function(){

        var val_input=$(this).attr('val_input')
        var input_op= $("input#valcontratop"+val_input)
        input_op.removeAttr('disabled').addClass('border border-danger border-2 text-black ').removeClass('bg-secondary text-light');
        $(this).html('<i class="fa-solid fa-check fa-lg"></i>')
        .removeClass('btn-contract-mod ')
        .addClass('btn-contract-mod-val btn-outline-success border border-danger ');

      })

      $(document).on("click","button.btn-contract-option", function(){
        var btn_this = $(this)
        var val_input=$(this).attr('val_input')
        var id_recrute=$(this).attr('id_recrute')
        var id_contract_option=$(this).attr('val_id')
        var val_op_contract= $("input#valcontratop"+val_input).val()
        var input_op= $("input#valcontratop"+val_input)
        var t_mode =""
        var url= $(this).attr('url')
        fun_resume.contract_option(btn_this,t_mode,id_contract_option,val_op_contract,id_recrute,input_op);
      })
  

      $(document).on("click","button.btn-contract-mod-val", function(){
        var btn_this = $(this)
       
        //var  val_id_c_op=$(this).attr('val_id_c_op') 
        var val_input=$(this).attr('val_input') 
        var val_id_c_op_recrute=$(this).attr('id_c_op_recrute') 
        var id_recrute=$(this).attr('id_recrute')
        var id_contract_option=$(this).attr('val_id')
        var val_op_contract= $("input#valcontratop"+val_input).val()
        var input_op= $("input#valcontratop"+val_input)
        var t_mode =""
        var url= $(this).attr('url')
        fun_resume.contract_option_update(btn_this,t_mode,id_contract_option,val_op_contract,id_recrute,input_op,val_id_c_op_recrute);
      })
      
      $(document).on("mousemove","body", function(){


        var event_this = $(this)
     //fun_resume.assistance(event_this)

           } );


           
      $(document).on("click","button.btn-creat-chat", function(){
      var btn_this= $(this)
      var chat = $(this).attr('chat')
      fun_resume.assistance_creat(btn_this,chat)
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

