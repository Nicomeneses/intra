$(function(){
$.getJSON("users", function (json) {
      $("#selectusuarios").select2({
         placeholder: 'Ingrese su busqueda...',
         data: json
      });
  });

$("#selectusuarios").change(function(event) {
  var rut=$(this).val();
   $.ajax({
          url: "getUserData",  
          type: 'POST',
          data: {"rut":rut},
          cache: false,
          success: function (data) {
            var json = JSON.parse(data);
            if(json.res == "ok"){      
              for(datos in json.users) {
                fono_celular=json.users[datos].fono_celular;
                fono_casa=json.users[datos].fono_domicilio;
                fono_empresa=json.users[datos].celular_empresa;
                $(".res_telefonos1").html(fono_celular);
                if(fono_casa!="" && fono_casa!="no hay datos" && fono_casa!="no"){
                  $(".res_telefonos2").html("/"+fono_casa);$(".res_telefonos2").show();
                }else{
                  $(".res_telefonos2").html("");$(".res_telefonos2").hide();
                }

                if(fono_empresa!="" && fono_empresa!="no hay datos"  && fono_empresa!="no"){
                  $(".res_telefonos3").html("/"+fono_empresa);$(".res_telefonos3").show();
                }else{
                  $(".res_telefonos3").html("");$(".res_telefonos3").hide();
                }

                $(".res_correo").html(json.users[datos].correo);
                $(".res_area").html(json.users[datos].area);
                $(".res_ciudad").html(json.users[datos].sucursal);
                $(".res-buscador").show();


              }
             }else{
              alert("error");
             }
          }
        });
});


var sess=$(".izq_secc").attr("dat-us");
var rut_user=$(".izq_secc").attr("dat-rut");
/***********COMENTARIOS NOTICIAS***********/

$(document).on('submit', '.enviar_comentario_not', function(event) {
var form=$(this);
var formData = new FormData( this ); 
var comentario=$(this).find('.noticia_comentario').val();
var id_not=$(".id_not").val();
var cont= form.parent("div");

$(".validation_coment").hide();  
if (comentario!=""){

$(".validation_coment").show();  
  $.ajax({
    url: $(".enviar_comentario_not").attr('action')+"?"+$.now(),  
    type: 'POST',
    data: formData,
    cache: false,
    processData: false,
    dataType: "json",
    contentType : false,
    beforeSend: function(){
    $(".loader_comentarios").show();
    $(".comentarios_cumple").html('<center><div style="margin-top:20px;" class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div> </div></div></div></center>');
    },
    success: function (data) { 
    if(data.res=="ok"){
    $(".validation_coment_not").fadeIn(500);  
    $(".validation_coment_not").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text teal lighten-2'><center>Comentario ingresado con &eacute;xito.</center></div>");
    verComentarios_not(id_not,cont);
    /* setTimeout(function(){
       verComentarios_not(id_not,cont);
        //$(".validation_coment").fadeOut(500);    
    } ,1000); */
    }else{
      alert("Problemas enviando el comentario, intente nuevamente.")
    }
    },
    error:function(data){
      alert("Problemas enviando el comentario, intente nuevamente.");
      $(".loader_comentarios").hide();
      }
  });
}else{  
$(".validation_coment").show();  
$(".validation_coment").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text red darken-3'><center><blockquote style='padding:0!important;margin:0!important'>Debe ingresar un comentario...</blockquote></center></div>");
}
return false;   
});

$(document).on('click', '.btn_comentar_not', function(event) {
  var btn=$(this);
  var cont= btn.prev();
  cont.hide();
  var id=$(this).attr("data-id");
  var input='<form method="POST" class="enviar_comentario_not" action="enviar_comentario_not">'
        +'<input type="hidden" class="id_not" name="id_not" value="'+id+'">'
        +'<div class="row" style="margin-bottom: 0px;!important">'
        +'<div class="input-field col s12 l8">'
          +'<i class="material-icons prefix">comment</i>'
          +'<input class="validate" required name="noticia_comentario" id="noticia_comentario" class="noticia_comentario" type="text" >'
          +'<label class="" for="">Ingresa tu comentario</label>'
        +'</div>'
        +'<div class="input-field col s12 l4">'
        +'<center><button class="btn waves-effect waves-light" type="submit" style="margin-top:10px;">Publicar'
        +'<i class="material-icons right">send</i> </button></center>'
        +'</div>'
        +'<div class="input-field col s12 12">'
        +'<div class="validation_coment_not"></div>'
        +'</div></div></form>';

  cont.html(input);  
  cont.fadeIn(1000);
});

$(document).on('click', '.ver_comentarios_not', function(event) {
  var btn=$(this);
  var cont= btn.prev().prev();
  var id=$(this).attr("data-id");
  verComentarios_not(id,cont);
});

$(document).on('click', '.del_coment_not', function(event) {
  event.preventDefault();
  if (confirm("¿Está seguro que desea eliminar este comentario?")) {
  var id=$(this).attr("data-id");
  var eliminar=$(this);
     $.post("eliminar_comentario_not?"+$.now(), { id: id } ,function(data) {
      eliminar.parent("div").parent("div").addClass('eliminado');
    });
  $(this).fadeOut(500);
  }
});

function verComentarios_not(id,cont){
 $(".validation_coment").hide();
 cont.html("");
 cont.hide();
 var id=id;
 var url="getComentarios_not";
 var html=""; 
 
 $.ajax({
  type : "POST",
  cache:false,
  url : url+"?"+$.now(),
  data : {"id":id},
  beforeSend: function(){
    cont.html('<center><div class="preloader-wrapper big active" style="margin-bottom:10px"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></center><div class="divider" style="display:none;margin-bottom:15px;"></div>');
    cont.fadeIn(500);
  },
  success : function(data){
   cont.hide();
   //alert(data);return false;
   var json = JSON.parse(data);
   if(json.res == "ok"){              
     for(datos in json.comentarios) {
         //json.comentarios[datos].comentario
          html +='<div class="row"><div class="col l12"><div class="comentario_not">'
         + '<div class="col s2 l1 coment_img"><img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/' + json.comentarios[datos].imagen + '" style="width:35px;height:35px;border-radius: 150px;"></div>'
         + '<div class="col s10 l2 coment_nombre">'+json.comentarios[datos].pn+" "+json.comentarios[datos].app+'</div>'
         + '<div class="col s12 l5 coment_comentario">'+json.comentarios[datos].comentario+'</div>'
        
         if(sess==3){
           html +='<div class="col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s2 l1 coment_eliminar"><a href="!#" class="del_coment_not" data-id="'+json.comentarios[datos].id+'"><img src="./assets/imagenes/eliminar.png" width="20px"></a></div>';
         }else{
           if(json.comentarios[datos].rut_usuario==rut_user){
             html +='<div class="col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s2 l1 coment_eliminar"><a href="!#" title="Eliminar Comentario" class="del_coment_not" data-id="'+json.comentarios[datos].id+'"><img src="./assets/imagenes/eliminar.png" width="20px"></a></div>';
           }else{
             html +='<div class="col s12 l4 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div>';
           }
         }
  

           html +='</div></div></div>';
          /*if(count<i){
          html +='<div class="divider" style="margin-top:5px;margin-bottom:5px;"></div>';
           }*/
     }
     html +='<div class="divider" style="margin-bottom:15px;"></div>';
     cont.html(html);
     cont.fadeIn(1000);
   }else{
     cont.fadeIn(1000);
     cont.html("<center><p class='no_comentario'>No se han encontrado comentarios.</p></center>");
   }
  },
  error : function(){
    alert("Error cargando datos, intente nuevamente.");
  }
 });
}

/***********COMENTARIOS CUMPLEAÑOS***********/

$(document).on('click', '.modal_cumple', function(event) {
  event.preventDefault();
   $(".comentarios_cumple").html("");
   $(".validation_coment").html("");
   var rut_cumple=$(this).attr("data-rut");

   setTimeout(function(){
       verComentarios_cumple(rut_cumple);
        $(".validation_coment").hide();    
    } ,500); 
});


$(document).on('click', '.btn_comentar_cumple', function(event) {
  $(".validation_coment").hide();
  $(".comentarios_cumple").hide();
  var cont=$(".comentarios_cumple");
  var rut_cumple=$(this).attr("data-rut");
  var input='<form method="POST" class="enviar_comentario_cumple" action="enviar_comentario_cumple"><div class="cont_textarea">'
   + '<input type="hidden" class="btn_comentar_rut_cumple" name="rut_cumple" value="'+rut_cumple+'">'
   + '<div class="row" style="padding:3px!important;margin:3px!important;">'
   + '<div class="input-field col s12 l8">'
   + ' <i class="material-icons prefix">mode_edit</i><textarea id="textarea1" name="comentario" class="comentario materialize-textarea" length="120"></textarea><label for="icon_prefix2">Escribe tu comentario...</label>'
   + '</div>'
   + '<div class="input-field col s12 l4">'
   + '<center><button type="submit" class="waves-effect waves-teal btn btn_publicar" style="margin-top:50px;">Publicar</button></center>'
   + '</div>'
   + '</div>'
   + '</div></form>';
  $(".comentarios_cumple").html(input);  
  $(".comentarios_cumple").fadeIn(1000);
});


$(document).on('submit', '.enviar_comentario_cumple', function(event) {
  var form=$(this);
  var formData = new FormData( this ); 
  var val=$(this).find('textarea.comentario').val();
  var rut=$(".btn_comentar_rut_cumple").val();
  $(".validation_coment").hide();  
  if (val!=""){

  $(".validation_coment").show();  
    $.ajax({
      url: $(".enviar_comentario_cumple").attr('action')+"?"+$.now(),  
      type: 'POST',
      data: formData,
      cache: false,
      processData: false,
      dataType: "json",
      contentType : false,
      beforeSend: function(){
      $(".loader_comentarios").show();
      $(".comentarios_cumple").html('<center><div style="margin-top:20px;" class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div> </div></div></div></center>');
      },
      success: function (data) { 
        $(".validation_coment").show();  
        $(".validation_coment").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text teal lighten-2'><center>Comentario ingresado con &eacute;xito.</center></div>");

        if(data.res=="ok"){
         setTimeout(function(){
           verComentarios_cumple(rut);
            $(".validation_coment").hide();    
        } ,1500); 
      }else{
        alert("Problemas enviando el comentario, intente nuevamente.")
      }
      },
      error:function(data){
        alert("Problemas enviando el comentario, intente nuevamente.");
        $(".loader_comentarios").hide();
        }
    });
  }else{  
  $(".validation_coment").show();  
  $(".validation_coment").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text red darken-3'><center><blockquote style='padding:0!important;margin:0!important'>Debe ingresar un comentario...</blockquote></center></div>");
  }
  return false;   
});

$(document).on('click', '.btn_coment_cumple', function(event) {
verComentarios_cumple($(this).attr("data-rut"));
});

$(document).on('click', '.del_coment_cumpl', function(event) {
  event.preventDefault();
  if (confirm("¿Está seguro que desea eliminar este comentario?")) {
  var id=$(this).attr("data-id");
  var eliminar=$(this);
     $.post("eliminar_comentario_cumple?"+$.now(), { id: id } ,function(data) {
      eliminar.parent("div").parent("div").addClass('eliminado');
    });
  $(this).fadeOut(500);
  }
});

function verComentarios_cumple(rut){
 $(".validation_coment").hide();
 $(".comentarios_cumple").html("");
 $(".comentarios_cumple").hide();
 var rut=rut;
 var url="getComentarios_cumple";
 var html=""; 

 $.ajax({
  type : "POST",
  cache:false,
  url : url+"?"+$.now(),
  data : {"rut":rut},
  beforeSend: function(){
    $(".loader_comentarios").show();
    $(".comentarios_cumple").html('<center><div class="preloader-wrapper big active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></center>');
    $(".comentarios_cumple").fadeIn(800);
  },
  success : function(data){
   $(".comentarios_cumple").hide();
   //alert(data);return false;
 var json = JSON.parse(data);
   if(json.res == "ok"){              
     for(datos in json.comentarios) {
      //json.comentarios[datos].comentario

          html +='<div class="row"><div class="col l12"><div class="comentario_cumple">'
         + '<div class="col s2 l1 coment_img"><img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/' + json.comentarios[datos].imagen + '" style="width:55px;height:55px;border-radius: 150px;"></div>'
         + '<div class="col s10 l2 coment_nombre">'+json.comentarios[datos].pn+" "+json.comentarios[datos].app+'</div>'
         + '<div class="col s12 l5 coment_comentario">'+json.comentarios[datos].comentario+'</div>'
        
          if(sess==3){
           html +='<div class="col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s12 l1 coment_eliminar"><a href="!#" class="del_coment_cumpl" data-id="'+json.comentarios[datos].id+'"><img src="./assets/imagenes/eliminar.png" width="20px"></a></div>';
          }else{
           if(json.comentarios[datos].rut_comenta==rut_user){
             html +='<div class="col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s2 l1 coment_eliminar"><a href="!#" title="Eliminar Comentario" class="del_coment_cumpl" data-id="'+json.comentarios[datos].id+'"><img src="./assets/imagenes/eliminar.png" style="margin-top:10px;"  width="20px"></a></div>';
           }else{
             html +='<div class="col s12 l4 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div>';
           }
         }
     }

     $(".comentarios_cumple").html(html);
     $(".comentarios_cumple").fadeIn(1000);
     $(".loader_comentarios").hide();
   }else{
     $(".loader_comentarios").hide();
     $(".comentarios_cumple").fadeIn(1000);
     $(".comentarios_cumple").html("<center>No se han encontrado comentarios.</center>");
   }
  },
  error : function(){
    alert("Error cargando datos, intente nuevamente.");
  }
 });
}


/***********COMENTARIOS ULTIMOS INGRESOS***********/


$(document).on('click', '.modal_ing', function(event) {
  event.preventDefault();
   $(".comentarios_ing").html("");
   $(".validation_coment").html("");
   var rut_ing=$(this).attr("data-rut");

   setTimeout(function(){
       verComentarios_ing(rut_ing);
        $(".validation_coment").hide();    
    } ,500); 
  
});


$(document).on('click', '.btn_comentar_ing', function(event) {
  $(".validation_coment").hide();
  $(".comentarios_ing").hide();
  var cont=$(".comentarios_ing");
  var rut_ing=$(this).attr("data-rut");
  var input='<form method="POST" class="enviar_comentario_ing" action="enviar_comentario_ing"><div class="cont_textarea">'
   + '<input type="hidden" class="btn_comentar_rut" name="rut_ing" value="'+rut_ing+'">'
   + '<div class="row" style="padding:3px!important;margin:3px!important;">'
   + '<div class="input-field col s12 l8">'
   + ' <i class="material-icons prefix">mode_edit</i><textarea id="textarea1" name="comentario" class="comentario materialize-textarea" length="120"></textarea><label for="icon_prefix2">Escribe tu comentario...</label>'
   + '</div>'
   + '<div class="input-field col s12 s4">'
   + '<center><button type="submit" class="waves-effect waves-teal btn btn_publicar" style="margin-top:50px;">Publicar</button></center>'
   + '</div>'
   + '</div>'
   + '</div></form>';
  $(".comentarios_ing").html(input);  
  $(".comentarios_ing").fadeIn(1000);
});


$(document).on('submit', '.enviar_comentario_ing', function(event) {
  var form=$(this);
  var formData = new FormData( this ); 
  var val=$(this).find('textarea.comentario').val();
  var rut=$(".btn_comentar_rut").val();
  $(".validation_coment").hide();  
  if (val!=""){

  $(".validation_coment").show();  
    $.ajax({
      url: $(".enviar_comentario_ing").attr('action')+"?"+$.now(),  
      type: 'POST',
      data: formData,
      cache: false,
      processData: false,
      dataType: "json",
      contentType : false,
      beforeSend: function(){
      $(".loader_comentarios").show();
      $(".comentarios_ing").html('<center><div style="margin-top:20px;" class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div> </div></div></div></center>');
      },
      success: function (data) { 
        $(".validation_coment").show();  
        $(".validation_coment").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text teal lighten-2'><center>Comentario ingresado con &eacute;xito.</center></div>");

        if(data.res=="ok"){
         setTimeout(function(){
           verComentarios_ing(rut);
            $(".validation_coment").hide();    
        } ,1500); 
      }else{
        alert("Problemas enviando el comentario, intente nuevamente.")
      }
      },
      error:function(data){
        alert("Problemas enviando el comentario, intente nuevamente.");
        $(".loader_comentarios").hide();
        }
    });
  }else{  
  $(".validation_coment").show();  
  $(".validation_coment").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text red darken-3'><center><blockquote style='padding:0!important;margin:0!important'>Debe ingresar un comentario...</blockquote></center></div>");
  }
  return false;   
});

$(document).on('click', '.btn_coment_ing', function(event) {
verComentarios_ing($(this).attr("data-rut"));
});

$(document).on('click', '.del_coment_ing', function(event) {
  event.preventDefault();
  if (confirm("¿Está seguro que desea eliminar este comentario?")) {
  var id=$(this).attr("data-id");
  var eliminar=$(this);
     $.post("eliminar_comentario_ing?"+$.now(), { id: id } ,function(data) {
      eliminar.parent("div").parent("div").addClass('eliminado');
    });
  $(this).fadeOut(500);
  }
});

function verComentarios_ing(rut){
 $(".validation_coment").hide();
 $(".comentarios_ing").html("");
 $(".comentarios_ing").hide("");
 var rut=rut;
 var url="getComentarios_ing";
 var html=""; 
 $.ajax({
  type : "POST",
  cache:false,
  url : url+"?"+$.now(),
  data : {"rut":rut},
  beforeSend: function(){
    $(".loader_comentarios").show();
    $(".comentarios_ing").html('<center><div class="preloader-wrapper big active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></center>');
    $(".comentarios_ing").fadeIn(800);

  },
  success : function(data){
   var json = JSON.parse(data);
   if(json.res == "ok"){              
     for(datos in json.comentarios) {
   
        $(".comentarios_ing").html(html);

          html +='<div class="row"><div class="col l12"><div class="comentario_ing">'
         + '<div class="col s2 l1 coment_img"><img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/' + json.comentarios[datos].imagen + '" style="width:55px;height:55px;border-radius: 150px;"></div>'
         + '<div class="col s10 l2 coment_nombre">'+json.comentarios[datos].pn+" "+json.comentarios[datos].app+'</div>'
         + '<div class="col s12 l5 coment_comentario">'+json.comentarios[datos].comentario+'</div>'
        
         if(sess==3){
           html +='<div class="col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s2 l1 coment_eliminar"><a href="!#" class="del_coment_cumpl" data-id="'+json.comentarios[datos].id+'"><img src="./assets/imagenes/eliminar.png" width="20px"></a></div>';
          }else{
           if(json.comentarios[datos].rut_comenta==rut_user){
             html +='<div class="col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s2 l1 coment_eliminar"><a href="!#" title="Eliminar Comentario" class="del_coment_ing" data-id="'+json.comentarios[datos].id+'"><img src="./assets/imagenes/eliminar.png" style="margin-top:10px;"  width="20px"></a></div>';
           }else{
             html +='<div class="col s12 l4 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div>';
           }
         }

           html +='</div></div></div>';
     }
     $(".comentarios_ing").html(html);
     $(".comentarios_ing").fadeIn(1000);
     $(".loader_comentarios").hide();
   }else{
     $(".loader_comentarios").hide();
     $(".comentarios_ing").html("<center>No se han encontrado comentarios.</center>");
   }
  },
  error : function(){
    alert("Error cargando datos, intente nuevamente.");
  }
 });
}

/***********COMENTARIOS NACIMIENTOS***********/

$(document).on('click', '.modal_nac', function(event) {
  event.preventDefault();
   $(".comentarios_nac").html("");
   $(".validation_coment").html("");

   var id=$(this).attr("data-id");
   setTimeout(function(){
       verComentarios(id);
        $(".validation_coment").hide();    
    } ,500); 
});

$(document).on('click', '.btn_comentar', function(event) {
  $(".validation_coment").hide();
  $(".comentarios_nac").hide();

  var cont=$(".comentarios_nac");
  var id=$(".comentarios_nac").attr("data-id");
  var user=$(".comentarios_nac").attr("data-user");
  var input='<form method="POST" class="enviar_comentario" action="enviar_comentario"><div class="cont_textarea">'
   + '<input type="hidden" name="id_nacimiento" value="'+id+'"><input type="hidden" name="usuario" value="'+user+'">'
   + '<div class="row" style="padding:3px!important;margin:3px!important;">'
   + '<div class="input-field col s12 l8">'
   + ' <i class="material-icons prefix">mode_edit</i><textarea id="textarea1" name="comentario" class="comentario materialize-textarea" length="120"></textarea><label for="icon_prefix2">Escribe tu comentario...</label>'
   + '</div>'
   + '<div class="input-field col s12 l4">'
   + '<center><button type="submit" class="waves-effect waves-teal btn btn_publicar" style="margin-top:50px;">Publicar</button></center>'
   + '</div>'
   + '</div>'
   + '</div></form>';
   $(".comentarios_nac").html(input); 
   $(".comentarios_nac").fadeIn(1000); 
});

$(document).on('submit', '.enviar_comentario', function(event) {
  var form=$(this);
  var formData = new FormData( this ); 
  var val=$(this).find('textarea.comentario').val();
  $(".validation_coment").hide();  
  if (val!=""){

  $(".validation_coment").show();  
    $.ajax({
      url: $(".enviar_comentario").attr('action')+"?"+$.now(),  
      type: 'POST',
      data: formData,
      cache: false,
      processData: false,
      dataType: "json",
      contentType : false,
      beforeSend: function(){
      $(".loader_comentarios").show();
      $(".comentarios_nac").html('<center><div style="margin-top:20px;" class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div> </div></div></div></center>');
      },
      success: function (data) { 
        $(".validation_coment").show();  
        $(".validation_coment").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text teal lighten-2'><center>Comentario ingresado con &eacute;xito.</center></div>");

        if(data.res=="ok"){
         setTimeout(function(){
           verComentarios($(".comentarios_nac").attr("data-id"));
            $(".validation_coment").hide();    
        } ,1500); 
     

      }else{
        alert("Problemas enviando el comentario, intente nuevamente.")
      }
      },
      error:function(data){
        alert("Problemas enviando el comentario, intente nuevamente.");
        $(".loader_comentarios").hide();
        }
    });
  }else{  
  $(".validation_coment").show();  
  $(".validation_coment").html("<div style='font-size:12px;padding:10px!important;' class='card-panel white-text red darken-3'><center><blockquote style='padding:0!important;margin:0!important'>Debe ingresar un comentario...</blockquote></center></div>");
  }
  return false;   
});

$(document).on('click', '.btn_coment', function(event) {
verComentarios($(this).attr("data-id"));
});

$(document).on('click', '.del_coment_nac', function(event) {
  event.preventDefault();
  if (confirm("¿Está seguro que desea eliminar este comentario?")) {
  var id=$(this).attr("data-id");
  var eliminar=$(this);
     $.post("eliminar_comentario_nac?"+$.now(), { id: id } ,function(data) {
      eliminar.parent("div").parent("div").addClass('eliminado');
    });
  $(this).fadeOut(500);
  }
});

function verComentarios(id){
 $(".validation_coment").hide();
 $(".comentarios_nac").html("");
 $(".comentarios_nac").hide();
 var id=id;
 var url="getComentarios";
 var html=""; 

 $.ajax({
  type : "POST",
  cache:false,
  url : url+"?"+$.now(),
  data : {"id":id},
  beforeSend: function(){
    $(".loader_comentarios").show();
    $(".comentarios_nac").html('<center><div class="preloader-wrapper big active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div> </div></div></div></center>');
    $(".comentarios_nac").fadeIn(800);
  },
  success : function(data){
   $(".comentarios_nac").hide();
   var json = JSON.parse(data);
   if(json.res == "ok"){              
     for(datos in json.comentarios) {

          html +='<div class="row"><div class="col l12"><div class="comentario_ing">'
         + '<div class="col s2 l1 coment_img"><img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/' + json.comentarios[datos].imagen + '" style="width:55px;height:55px;border-radius: 150px;"></div>'
         + '<div class="col s10 l2 coment_nombre">'+json.comentarios[datos].pn+" "+json.comentarios[datos].app+'</div>'
         + '<div class="col s12 l5 coment_comentario">'+json.comentarios[datos].comentario+'</div>'

         if(sess==3){
           html +='<div class="col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s2 l1 coment_eliminar"><a href="!#" class="del_coment_nac" data-id="'+json.comentarios[datos].idnac_com+'"><img src="./assets/imagenes/eliminar.png" width="20px"></a></div>';
          }else{
           if(json.comentarios[datos].rut_usuario==rut_user){
             html +='<div class="col col s10 l3 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div><div class="col s2 l1 coment_eliminar"><a href="!#" title="Eliminar Comentario" class="del_coment_nac" data-id="'+json.comentarios[datos].idnac_com+'"><img src="./assets/imagenes/eliminar.png" style="margin-top:10px;"  width="20px"></a></div>';
           }else{
             html +='<div class="col s12 l4 coment_fecha">'+fecha_to_string(json.comentarios[datos].fecha)+'</div>';
           }
         }

         html +='</div></div></div>';
          /*if(count<i){
          html +='<div class="divider" style="margin-top:5px;margin-bottom:5px;"></div>';
           }*/
     }
     $(".comentarios_nac").html(html);
     $(".comentarios_nac").fadeIn(1000);
     $(".loader_comentarios").hide();
   }else{
     $(".loader_comentarios").hide();
     $(".comentarios_nac").fadeIn(1000);
     $(".comentarios_nac").html("<center>No se han encontrado comentarios.</center>");
   }
  },
  error : function(){
    alert("Error cargando datos, intente nuevamente.");
  }
 });
}

/***********OTROS ***********/


function fecha_to_string(fecha2){
  fecha=fecha2.split(' ');
  fecha22=fecha[0];  
  hora=fecha[1];  
  fecha3=fecha22.split('-');
  anio=fecha3[0];mes=fecha3[1];dia=fecha3[2];
  return dia + " de " + mes_to_string(parseInt(mes)) + " del " + anio + " a las " + hora;
}

function mes_to_string(mess){
    switch (mess) {
    case 1:mess="Enero";break;
    case 2:mess="Febrero";break;
    case 3:mess="Marzo";break;
    case 4:mess="Abril";break;
    case 5:mess="Mayo";break;
    case 6:mess="Junio";break;
    case 7:mess="Julio";break;
    case 8:mess="Agosto";break;
    case 9:mess="Septiembre";break;
    case 10:mess="Octubre";break;
    case 11:mess="Noviembre";break;
    case 12:mess="Diciembre";break;
  }
  return mess;
}

$(".home").animate({"opacity": 1}, 1500);

$(window).scroll(function(){
   if ($(this).scrollTop() > 600) {
        $('.scrollup').fadeIn();
   } else {
        $('.scrollup').fadeOut();
   }
});

$('.scrollup').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 1000);
    return false;
});
  
});

