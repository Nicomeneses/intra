<style type="text/css">
  .tabs{
    background-color: #eee;
    margin-bottom: 20px;
  }
  .tabs .tab a {
      text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
      color: rgba(0, 0, 0, 0.5);
      text-align: center;

  }
  .tabs .tab a:hover{
   color: rgba(0, 0, 0, 0.5)!important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  }
  .tabs .tab {
      height: 68px!important;
  }
  .tabs .tab{
      line-height: 68px!important;
  }
  .tabs, .toast {
      position: relative;
      height: 68px!important;
  }
</style>

<script type="text/javascript">
  $(function(){
  $(".loader").hide();
  var url="<?php echo base_url()?>";
  $.post(url+"getSolicitud"+"?"+$.now(), function( data ) {
   $("#solicitud").html(data);
  });

  var url2 = window.location.href;  
  part=url2.split("/");
  cont=(part.length)-1;
  if(part[cont]=="vacaciones#solicitudes_jefe"){
     $.post(url+"getSolicitudesJefe"+"?"+$.now(), function( data ) {
     $("#solicitudes_jefe").html(data);
    });
  }

  $(document).on('click', '.solicitud', function(event) {
    event.preventDefault();
     $.post(url+"getSolicitud"+"?"+$.now(), function( data ) {
     $("#solicitud").html(data);
    });
  });

  $(document).on('click', '.solicitudes_jefe', function(event) {
     event.preventDefault();
     $.post(url+"getSolicitudesJefe"+"?"+$.now(), function( data ) {
     $("#solicitudes_jefe").html(data);
  });
  }); 

  $(document).on('click', '.reporte_individual', function(event) {
     event.preventDefault();
     $.post(url+"reporteIndividual"+"?"+$.now(), function( data ) {
     $("#reporte_individual").html(data);
  });
  });

  $(document).on('click', '.reporte_usuarios', function(event) {
     event.preventDefault();
     $.post(url+"reporteUsuarios"+"?"+$.now(), function( data ) {
     $("#reporte_usuarios").html(data);
  });
  });

  $(document).on('change', '.estado_peticion', function(event) {
     event.preventDefault();
     if($(this).val()==1){
      return false;
     }
     estado=$(this).val();
     enviada=$(this).attr("data-env");
     id=$(this).attr("data-id");
     if(enviada=="si") {
      if (confirm("Esta información ya fue enviada, desea reenviar?")) {
        $.ajax({
          url: 'actualizarEstadoSolicitud'+"?"+$.now(),  
          type: 'POST',
          data: {"estado":estado,"id":id},
          cache: false,
          dataType: "json",
          beforeSend :function(data){
               $(".loader").fadeIn("fast");
          },
          success:function(data){
            if(data.res=="ok"){
              $.post("getListadoSolicitudesJefe"+"?"+$.now(),function(data) {
                 $(".table").html(data);
              });
                Materialize.toast(data.msg, 4000,'rounded');
            }else
            if(data.res=="error"){
               Materialize.toast(data.msg, 4000,'rounded');
            }
            $(".loader").fadeOut("fast");
          },
          error:function(data){
               Materialize.toast("Error de conexión, intente nuevamente.", 4000,'rounded');
              $(".loader").fadeOut("fast");
          }
      });
      }
      }else{
            $.ajax({
          url: 'actualizarEstadoSolicitud'+"?"+$.now(),  
          type: 'POST',
          data: {"estado":estado,"id":id},
          cache: false,
          dataType: "json",
           beforeSend :function(data){
               $(".loader").fadeIn("fast");
          },
          success:function(data){
            if(data.res=="ok"){
              $.post("getListadoSolicitudesJefe"+"?"+$.now(),function(data) {
                 $(".table").html(data);
              });
                Materialize.toast(data.msg, 4000,'rounded');
            }else
            if(data.res=="error"){
               Materialize.toast(data.msg, 4000,'rounded');
            }
              $(".loader").fadeOut("fast");
          },
          error:function(data){
               Materialize.toast("Error de conexión, intente nuevamente.", 4000,'rounded');
            $(".loader").fadeOut("fast");
          }
      });
      }
   });

   $('.tooltipped').tooltip({delay: 50});

});
</script>
<section>
<div class="container">
<div class="section">
<div class="row">
<div class="col s12 m12 l12"> 
<div class="changepass z-depth-2">

   <div class="row">
   <div class="changepass_form">
     
    <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3 solicitud"><a href="#solicitud">Solicitar vacaciones</a></li>
        <li class="tab col s3 reporte_individual"><a href="#reporte_individual">Reporte de vacaciones</a></li>
        <?php 
        if ($this->session->userdata('tipo')!=1) {
          ?>
        <li class="tab col s3 solicitudes_jefe"><a href="#solicitudes_jefe">Listado solicitudes</a></li>
          <?php
        }
        ?>
        <?php 
        if ($this->session->userdata('tipo')!=1) {
          ?>
        <li class="tab col s3 reporte_usuarios"><a href="#reporte_usuarios">Reporte de usuarios</a></li>
          <?php
        }
        ?>
      </ul>
    </div>
    <div class="row">
      <div class="loader">
      <div class="col l10 offset-l1">
        <div class="progress">
         <div class="indeterminate"></div>
        </div>
      </div>
      </div>
    </div>
    <div id="solicitud" class="col s12"></div>
    <div id="reporte_individual" class="col s12"></div>
    <div id="solicitudes_jefe" class="col s12"></div>
    <div id="reporte_usuarios" class="col s12"></div>
    </div><br>

   </div>
   </div>
</div> 
</div>
</div><!-- FIN ROW -->
</div><!-- FIN DIV SECTION -->
</div><!-- FIN CONTAINER -->
</section><br><br>
