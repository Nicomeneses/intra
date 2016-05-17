<style type="text/css">
	.card-panel{
	  padding:0px!important;
	}
	.changepass_form{
		padding: 0!important;
	}
	blockquote{
		padding: 10px;
	}
</style>
<script type="text/javascript">
$(function(){
  $('.datepicker,.datepicker2').pickadate({     
    firstDay: true,
    format: 'yyyy-mm-dd' ,
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
/*  $("#fecha_inicio").val("2016-03-27");
  $("#fecha_termino").val("2016-04-04");*/


  $('#formsolicitudvacaciones').submit(function(){
    var fecha_inicio=$("#fecha_inicio").val();
    var fecha_termino=$("#fecha_termino").val();
    var dia = 24*60*60*1000; // horas*minutos*segundos*milisegundos
    var hoy = new Date();
    var fecha_inicio_d = new Date(fecha_inicio);
    var diferencia = Math.round(Math.abs((hoy.getTime() - fecha_inicio_d.getTime())/(dia)));
    
    if(diferencia>120){
    $(".result").html("<div class='card-panel white-text red darken-3'><center><blockquote>El tope es 4 meses a contar de hoy.</blockquote></center></div>");
    return false
    }
    if(fecha_inicio>fecha_termino){
     $(".result").html("<div class='card-panel white-text red darken-3'><center><blockquote>La fecha de término debe ser mayor que la de inicio...</blockquote></center></div>");
     return false;  
    }

    var formElement = document.querySelector("#formsolicitudvacaciones");
    var formData = new FormData(formElement);
      $.ajax({
          url: $('.formsolicitudvacaciones').attr('action')+"?"+$.now(),  
          type: 'POST',
          data: formData,
          cache: false,
          processData: false,
          dataType: "json",
          contentType : false,
          beforeSend :function(data){
               $(".btn_liqu_cont").html('<center><div class="preloader-wrapper active">'
                   + '<div class="spinner-layer spinner-green-only">'
                   + '<div class="circle-clipper left">'
                   + '<div class="circle"></div>'
                   + '</div><div class="gap-patch">'
                   + '<div class="circle"></div>'
                   + '</div><div class="circle-clipper right">'
                   + '<div class="circle"></div></div></div></div></center>'); 
            },
          success: function (data) {
          if(data.res == "ok"){
          $(".result").html("<div class='card-panel white-text teal lighten-2'><center><blockquote>"+data.msg+"</blockquote></center></div>");  
        $(".btn_liqu_cont").html('<button style="margin-top:5px;" class="btn_liqu btn waves-effect waves-light" type="submit">'
           +'Enviar'
         + '<i class="material-icons left">send</i>'
         + '</button>');
          }else
          if(data.res == "error"){
          $(".result").html("<div class='card-panel white-text red darken-3'><center><blockquote>"+data.msg+"</blockquote></center></div>");  
        $(".btn_liqu_cont").html('<button style="margin-top:5px;" class="btn_liqu btn waves-effect waves-light" type="submit">'
              +'Enviar'
          +'<i class="material-icons left">send</i>'
          +'</button>'); 
          }
          }
      });
    return false;     
  });

})
</script>
<div class="row">
<div class="col s12 m12 l12"> 
<!-- <div class="row">
    <div class="col s12">
      <div class="changepass_title">
         <h3>Solicitud de Vacaciones</h3>
      </div>
    </div>
</div> -->
<div class="result"></div>
<?php
if($solicitud!=FALSE){
	foreach($solicitud as $key){
		///////////// SI HAY UNA ULTIMA SOLICITUD EN ESPERA
		if($key["estado"]==1){
		  	?>
	    <div style="padding:5px!important;" class='col l8 offset-l2 card-panel white-text teal lighten-2'><center>
		Solicitud <?php echo revierte_fecha($key["fecha_inicio"])." al ".
		revierte_fecha($key["fecha_termino"])?> En proceso.</h6>
		</center></div>
			<?php
		}

		///////////// SI HAY UNA ULTIMA SOLICITUD APROBADA
		elseif($key["estado"]==2){
			?>
		<div style="padding:5px!important;" class='col l8 offset-l2 card-panel white-text teal lighten-2'><center>
		Solicitud <?php echo revierte_fecha($key["fecha_inicio"])." al ".
		revierte_fecha($key["fecha_inicio"])?> Aprobada.</h6>
		</center></div>
		
			<div class="row">
			<?php echo form_open(base_url()."solicitudVacaciones",array("id"=>"formsolicitudvacaciones","class"=>"formsolicitudvacaciones"));?>
				<div class="row">
			 	<div class="input-field col l8 offset-l2">
			       
			        <div class="input-field col l4">	
			        <label class="active" for="fecha_inicio">Fecha Inicio</label> 
			          <input id="fecha_inicio" name="fecha_inicio" type="text" class="datepicker">
			        </div>

			        <div class="input-field col l4">	
			        <label class="active" for="fecha_termino">Fecha T&eacute;rmino</label>
			          <input id="fecha_termino" name="fecha_termino" type="text" class="datepicker">
			        </div>

				 	<div class="input-field col s12 l4 btn_liqu_cont">
				  	 <button style="margin-top:5px;" class="btn_liqu btn waves-effect waves-light" type="submit"> Enviar
					 <i class="material-icons left">send</i>
					 </button>
				    </div>

				</div>
			</div>
			 <?php echo form_close();?>
			</div>

			<?php
		}

		///////////// SI HAY UNA ULTIMA SOLICITUD RECHAZADA
		elseif($key["estado"]==3){
			?>
			<div style="padding:5px!important;" class='col l8 offset-l2 card-panel white-text teal lighten-2'><center>
		Solicitud <?php echo revierte_fecha($key["fecha_inicio"])." al ".
		revierte_fecha($key["fecha_inicio"])?> rechazada.</h6>
		</center></div>

			<div class="row">
			<?php echo form_open(base_url()."solicitudVacaciones",array("id"=>"formsolicitudvacaciones","class"=>"formsolicitudvacaciones"));?>
				<div class="row">
			 	<div class="input-field col l8 offset-l2">
			       
			        <div class="input-field col l4">	
			        <label class="active" for="fecha_inicio">Fecha Inicio</label> 
			          <input id="fecha_inicio" name="fecha_inicio" type="text" class="datepicker">
			        </div>

			        <div class="input-field col l4">	
			        <label class="active" for="fecha_termino">Fecha T&eacute;rmino</label>
			          <input id="fecha_termino" name="fecha_termino" type="text" class="datepicker">
			        </div>

				 	<div class="input-field col s12 l4 btn_liqu_cont">
				  	 <button style="margin-top:5px;" class="btn_liqu btn waves-effect waves-light" type="submit"> Enviar
					 <i class="material-icons left">send</i>
					 </button>
				    </div>

				</div>
			</div>
			 <?php echo form_close();?>
			</div>

			<?php
		}
	}
}else{
?>
	<div class="row">
	<?php echo form_open(base_url()."solicitudVacaciones",array("id"=>"formsolicitudvacaciones","class"=>"formsolicitudvacaciones"));?>
		<div class="row">
	 	<div class="input-field col l8 offset-l2">
	       
	        <div class="input-field col l4">	
	        <label class="active" for="fecha_inicio">Fecha Inicio</label> 
	          <input id="fecha_inicio" name="fecha_inicio" type="text" class="datepicker">
	        </div>

	        <div class="input-field col l4">	
	        <label class="active" for="fecha_termino">Fecha T&eacute;rmino</label>
	          <input id="fecha_termino" name="fecha_termino" type="text" class="datepicker">
	        </div>

		 	<div class="input-field col s12 l4 btn_liqu_cont">
		  	 <button style="margin-top:5px;" class="btn_liqu btn waves-effect waves-light" type="submit"> Enviar
			 <i class="material-icons left">send</i>
			 </button>
		    </div>

		</div>
	</div>
	 <?php echo form_close();?>
	</div>

<?php
}
?>


</div>
</div><!-- FIN ROW -->

