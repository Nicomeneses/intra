<style type="text/css">
  table tfoot  input{
     height: 1.5rem!important;
  }
  input[type=search] {
    height: 1.5rem!important;
  }
  table thead th{
    font-size:12px;
  } 
  table tbody td{
    font-size:11px;
  } 
    thead, tfoot {
      display: table-header-group;
  }
  .select-dropdown{
      display:none!important;
  }
</style>
<script type="text/javascript">
	$(function(){

	$('.rut').Rut({
	  on_error: function(){ alert('Rut incorrecto'); },
	  format_on: 'keyup'
	});

	  $('#tb_usuarios tfoot th').each( function () {
    var title = $('#tb_usuarios thead th').eq( $(this).index() ).text();
        if(title!="Personal a cargo"){
          if(title!="Archivo PDF recepcionado"){
          $(this).html('<center><input type="text" class="" style="width:120px;font-size:11px;" /><center>' );
          }else{
            $(this).html("<center><b></b></center>");
          }
        }else{
          $(this).html("<center><b></b></center>");
        }
    });
  
     
    var table = $('#tb_usuarios').DataTable({
       dom:
        "<'ui two column grid'<'left aligned column'l><'right aligned column'f>>" +
        "<'ui grid'<'column'tr>>" +
        "<'ui two column grid'<'left aligned column'i><'right aligned column'p>>",
	  "order": [[ 1, "desc" ]],
      "iDisplayLength":5, 
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
      "bPaginate": true,
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "pagingType": "simple" ,
      "bAutoWidth": true ,
      "oLanguage": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ ",
        "sInfoEmpty":      "Sin registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Busqueda",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
     });
   
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        });
    });

	$('#formnuevo').submit(function(){

	var formElement = document.querySelector("#formnuevo");
	var formData = new FormData(formElement);
	    $.ajax({
	        url: $('.formnuevo').attr('action')+"?"+$.now(),  
	        type: 'POST',
	        data: formData,
	        cache: false,
	        processData: false,
	        dataType: "json",
	  		contentType : false,

	        success: function (data) {
	        
				if(data.st == 0){
			     $('#validation-error').html(data.msg);
			     $('#validation-error').fadeIn();
			     $("#titulo").focus();
			    }
			    else
			    if(data.st == 1){
			     $('#validation-error').html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
			     $('#validation-error').fadeIn();		
			     $(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="nacimientos"} ,1000);   
			    }
	        }
	       
	  	  });

	      return false;     
	});

	$(document).on('submit', '.formmodificar', function(event) {
	var form=$(this);
	var formData = new FormData( this );
	    $.ajax({
	        url: $(".formmodificar").attr('action')+"?"+$.now(),  
	        type: 'POST',
	        data: formData,
	        cache: false,
	        processData: false,
	        dataType: "json",
	  		contentType : false,
	        success: function (data) { 
	        	
	       		if(data.st == 0){
				   	form.parent("div").find(".validation-error-mod").html(data.msg);
		        	form.parent("div").find(".validation-error-mod").fadeIn();
			     $(".titulo").focus();
			    }
				if(data.st == 2){
				form.parent("div").find(".validation-error-mod").html(data.msg);
	        	form.parent("div").find(".validation-error-mod").fadeIn();
			    $(".titulo").focus();
			    }
			    else
			    if(data.st == 1){
			     form.parent("div").find(".validation-error-mod").html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
	        	 form.parent("div").find(".validation-error-mod").fadeIn();	
	         	 form.parent("div").find(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="nacimientos"} ,1000);   
			    } 
	        }
	       
	    });
	      return false;   
	 });    

	$('.formeliminar').submit(function(){
	 $.post($(this).attr('action')+"?"+$.now(), $(this).serialize(), function(data) {

	    if(data.st == 1){
	     $(this).children('.validation-error-del').html(data.msg);
	     $(this).children('.validation-error-del').fadeIn();

	   }else
	    if(data.st == 0){
			Materialize.toast(data.msg, 1000,'',function(){
				window.location="nacimientos";
			});
	    }   

	  }, 'json');

	  return false;  

	  });

	});
</script>

<section class="main" id="main" style="margin-top:5px;">
<div class="container">
<?php
//echo $error;
$mensaje = $this->session->flashdata('mensaje');
    if ($mensaje):echo $mensaje; endif;
?>	

<!-- Modal Ingreso -->
<div id="modal1" class="modal modal-fixed-footer">

	<div class="modal-content">
	  <h4>Nuevo Nacimiento</h4>
	  <div class="col l6">
	  	<div id="validation-error"></div>
	  </div>
	  <div class="progress2"></div>
        <?php echo form_open_multipart('admin_webkm/nuevonacimiento', array('id'=>'formnuevo','class'=>'formnuevo')); ?>

		  <div class="row">
		        <div class="input-field col s12 m12 l4">
		          <input id="rut" class="rut" type="text" class="validate" name="rut">
		          <label for="rut">Rut</label>
		        </div>
		   	    <div class="input-field col s12 m12 l4">
		          <input id="esposa" type="text" class="validate" name="esposa">
		          <label for="esposa">Pareja(Dejar vacio si no la hay)</label>
		        </div>
		        <div class="input-field col s12 m12 l4">
		          <input id="hijo" type="text" class="validate" name="hijo">
		          <label for="hijo">Hijo</label>
		        </div>
		
		  
		        <div class="input-field col s12">
		          <div class="input-field col s4">
					    <select name="anio" id="anio" class="browser-default">
						  <option value="<?php echo date("y")?>"><?php echo date("Y")?></option>
					    </select>
					  
				  </div>
				  <div class="input-field col s4">
					    <select name="mes" id="mes" class="browser-default">
					      <?php
					     	for($i=1;$i<=12;$i++){
					     		?>
								 <option value="<?php echo $i;?>"><?php echo $i;?></option>
					     		<?php
					     	}
					     ?>
					    </select>
				
				  </div>
				  <div class="input-field col s4">
					      <select name="dia" id="dia" class="browser-default" required>
					     <?php
					     	for($i=1;$i<=31;$i++){
					     		?>
								 <option value="<?php echo $i;?>"><?php echo $i;?></option>
					     		<?php
					     	}
					     ?>
					   
					    </select>
					  
				  </div>
		        </div>
		        <div class="input-field col s12">
					  <div class="file-field input-field col s12 m12 l12">
				      <div class="btn">
				        <span>Im&aacute;gen(jpg o png)</span>
				        <input type="file" name="userfile" id="userfile">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" name="string_file">
				      </div>
				    </div>
				</div>
				<div class="input-field col s8 offset-s2">
			          <textarea id="comentario" name="comentario" class="materialize-textarea"></textarea>
			          <label for="textarea1">Comentario Adicional</label>
				</div>
		  </div>	
	</div>

	<div class="modal-footer">
	   <button class="btn waves-effect waves-light" type="submit" name="guardar">Guardar
   		 <i class="material-icons right">send</i>
  	  </button>
	</div>
	<?php echo form_close();?>  

</div>

<div class="row z-depth-4">
	<div class="col l12 cont_main">
		<div class="col l6 offset-l3 center">
			<h5>Nacimientos <a style="margin-top:-3px;margin-left:11px;display:inline-block;" data-tooltip="Crear nueva noticia" data-position="right" data-delay="50"  data-target="modal1" class="s modal-trigger tooltipped btn-floating  btn-medium waves-effect waves-light ">
			<i class="material-icons icon_add">add</i>
			</a></h5>
		</div>
	</div>
	<div class="content_cont_main">

		<table id="tb_usuarios"  class="centered dataTable bordered striped highlight responsive-table">
		<thead>
		  <tr>
		      <th data-field="usuario">Usuario</th>
		      <th data-field="pareja">Pareja</th>
		      <th data-field="hijo">Hijo</th>
		      <th data-field="fecha">Fecha</th>
		      <th data-field="imagen">Imagen</th>
		      <th data-field="comentario">Comentario</th>
		      <th data-field="operaciones">Operaciones</th>
		  </tr>
		</thead>

		<tbody>
		<?php 
		if($listado!=false){

		foreach($listado as $key){
		?>

		  <tr>
		    <td><?php echo $key["nombres"]." ".$key["apellidos"]?></td>
		    <td><?php echo $key["esposa"]?></td>
		    <td><?php echo $key["hijo"]?></td>
		    <td><?php echo $key["fecha"]?></td>
		    <?php 
		    if($key["imagen"]){
		    ?>
		   	<td><img data-tooltip="Ampliar Imagen" data-position="top" data-delay="5" data-caption="<?php echo $key["hijo"]?>" src="<?php echo base_url()?>assets/imagenes/nacimientos/<?php echo "min_".$key["imagen"]?>" class="materialboxed tooltipped" width="50px"></td>
		    <?php
		    }else{
		    ?>
		   	<td>Sin imagen</td>
		    <?php
		    }
		    ?>
		    <td><?php echo cortarTexto(nl2br($key['comentario']),40);?></td>
		    <td>
		    <a data-tooltip="Editar Registro" data-position="top" data-delay="5" data-target="modal2<?php echo $key["id"]?>" class="s modal-trigger tooltipped">
			<i class="material-icons icon_description">description</i>
			</a>
			<a data-tooltip="Eliminar Registro" data-position="top" data-delay="5"  data-target="modal3<?php echo $key["id"]?>" class="s modal-trigger tooltipped">
			<i class="material-icons icon_delete">delete</i>
			</a>		   
		   </td>
		  </tr>
		<?php 
		  } 
		} 
		?>
		</tbody>
		</table>

		<?php 
		if($listado!=false){
		  foreach($listado as $key){
		  $fecha=explode('-',$key["fecha"]);
		  $anio=$fecha[0];$mes=$fecha[1];$dia=$fecha[2];
		  
		?>
		
<!-- Modal Modificar -->
<div id="modal2<?php echo $key["id"]?>" class="modal modal-fixed-footer">

	<div class="modal-content">
	  <h4>Modificar Registro</h4>
	  <div class="validation-error-mod"></div>
	  <div class="progress2"></div>
        <?php echo form_open('admin_webkm/modificarnacimiento', array('id'=>'formmodificar','class'=>'formmodificar')); ?>
		<input type="hidden" name="id" value="<?php echo $key["id"]?>">
		      <div class="row">
		        <div class="input-field col s12 m12 l4">
		          <input id="rut" class="rut" type="text" class="validate" name="rut" required value="<?php echo $key["rut"]?>">
		          <label for="rut">Rut</label>
		        </div>
		   	    <div class="input-field col s12 m12 l4">
		          <input id="esposa" type="text" class="validate" name="esposa" value="<?php echo $key["esposa"]?>">
		          <label for="esposa">Pareja(Dejar vacio si no la hay)</label>
		        </div>
		        <div class="input-field col s12 m12 l4">
		          <input id="hijo" type="text" class="validate" name="hijo"  value="<?php echo $key["hijo"]?>">
		          <label for="hijo">Hijo</label>
		        </div>
		       </div>

		        <div class="input-field col s12">
		          <div class="input-field col s4">
					    <select name="anio" id="anio" class="browser-default">
					      <option value="0" disabled selected>A&ntilde;o</option>
						  <option value="<?php echo $anio?>" selected><?php echo $anio?></option>
					    </select>
					
				  </div>
				  <div class="input-field col s4">
					    <select name="mes" id="mes" class="browser-default">
					      <option value="0" disabled>Mes</option>
					      <?php
					     	for($i=1;$i<=12;$i++){
					     		if($i==$mes){
					     			?>
								     <option value="<?php echo $mes;?>" selected><?php echo $mes;?></option>
					     			<?php	
					     		}else{
					     			?>
								     <option value="<?php echo $i;?>"><?php echo $i;?></option>
					     			<?php		
					     		}
					     		?>
					     		<?php
					     	}
					     ?>
					    </select>
				  </div>
				  <div class="input-field col s4">
					      <select name="dia" id="dia" class="browser-default">
					      <option value="0" disabled>Dia</option>
					     <?php
					     	for($i=1;$i<=31;$i++){
					     		if($i==$dia){
					     			?>
								     <option value="<?php echo $dia;?>" selected><?php echo $dia;?></option>
					     			<?php	
					     		}else{
					     			?>
								     <option value="<?php echo $i;?>"><?php echo $i;?></option>
					     			<?php		
					     		}
					     	}
					     ?>
					   
					    </select>
				  </div>

		        </div>
	

		    <div class="input-field col s12">
					  <div class="file-field input-field col s12 m12 l12">
				      <div class="btn">
				        <span>Im&aacute;gen(jpg o png)</span>
				        <input type="file" name="userfile" id="userfile">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" name="string_file" value="<?php echo $key["imagen"]?>">
				      </div>
				    </div>
				</div>
				<div class="input-field col s8 offset-s2">
			          <textarea id="comentario" name="comentario" class="materialize-textarea"><?php echo $key["comentario"]?></textarea>
			          <label for="textarea1">Comentario Adicional</label>
				</div>
	</div>

	<div class="modal-footer">
	  <button class="btn waves-effect waves-light" type="submit" name="guardar">Modificar
   		 <i class="material-icons right">description</i>
  	  </button>
  	  <?php echo form_close();?>  
	</div>
</div>


<!-- Modal Eliminar -->
<div id="modal3<?php echo $key["id"]?>" class="modal">
	<div class="modal-content">
	  <h4>Eliminar</h4>

	  <div class="validation-error-del"></div>
	  <div class="progress2-del"></div>
	 	   <?php echo form_open_multipart('admin_webkm/eliminanacimiento', array('id'=>'formeliminar','class'=>'formeliminar')); ?>

	  <p style="font-size:18px;">¿Confirma que desea eliminar este registro?</p>
		<input type="hidden" name="id" id="id" value="<?php echo $key["id"]?>">
	</div>	

	<div class="modal-footer">
	   <button class="btn waves-effect waves-light" type="submit" name="eliminar">Eliminar
   		 <i class="material-icons right">delete</i>
  	   </button>
  	  <?php echo form_close();?>  
	</div>
</div>

</div>
</div>
<?php 
}
} 
?>
</div>
</div>
</div>
</div>
</section>

