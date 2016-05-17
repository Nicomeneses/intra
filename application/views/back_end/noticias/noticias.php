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

	$('#rut,#rut2').Rut({
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
	var ext = $('#userfile').val().split('.').pop().toLowerCase();

	if($('#userfile').val()==""){
		$('#validation-error').html("<blockquote>Debe subir una Im&aacute;gen.</blockquote>");

		}else{

			if($.inArray(ext, ['png','jpg','JPG']) == -1) {
			   $('#validation-error').html("<blockquote>Tipo de archivo invalido.</blockquote>");
			}else{

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

				    }else
				    if(data.st == 1){
				     $('#validation-error').html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
				     $('#validation-error').fadeIn();		
				     $("#titulo").focus();
				     $(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
				     setTimeout(function(){window.location="noticias"} ,1000);   
				    }else  
				    if(data.st == 2){
				     $('#validation-error').html('<div class="alert alert-danger" align="center"><strong>'+data.msg+'</strong></div>');
				     $('#validation-error').fadeIn();
				     $("#titulo").focus();
				    }   
				     if(data.st == 3){
				     $('#validation-error').html('<div class="alert alert-danger" align="center"><strong>'+data.msg+'</strong></div>');
				     $('#validation-error').fadeIn();
				     $("#titulo").focus();
				    }   
		        }
	   	   });
	    }
	}
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
			    }else
			    if(data.st == 2){
				   	form.parent("div").find(".validation-error-mod").html(data.msg);
		        	form.parent("div").find(".validation-error-mod").fadeIn();
			     $(".titulo").focus();
			    }else
			    if(data.st == 1){
			     form.parent("div").find(".validation-error-mod").html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
	        	 form.parent("div").find(".validation-error-mod").fadeIn();	
	         	 form.parent("div").find(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="noticias"} ,1000);   
			    } 
			    if(data.st == 3){
				   	form.parent("div").find(".validation-error-mod").html(data.msg);
		        	form.parent("div").find(".validation-error-mod").fadeIn();
			     $(".titulo").focus();
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
				window.location="noticias";
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

<div class="row z-depth-4">
	<div class="col l12 cont_main">
		<div class="col l6 offset-l3 center">
			<h5>Noticias <a style="margin-top:-3px;margin-left:11px;display:inline-block;" data-tooltip="Crear nueva noticia" data-position="right" data-delay="50"  data-target="modal1" class="s modal-trigger tooltipped btn-floating  btn-medium waves-effect waves-light ">
			<i class="material-icons icon_add">add</i>
			</a></h5>
		</div>
		
	</div>

	<div class="content_cont_main">
     <table id="tb_usuarios"  class="centered dataTable bordered striped highlight responsive-table">
		<thead>
		  <tr>
		      <th>T&iacute;tulo</th>
		      <th>Fecha</th>
		      <th>Descripci&oacute;n</th>
		      <th>Imagen</th>
		      <th>Galer&iacute;a</th>
		      <th>Operaciones</th>
		  </tr>
		</thead>

        <tfoot>
          <tr style="background-color:#F9F9F9">
            <th>T&iacute;tulo</th>
            <th>Fecha</th>
            <th>Descripci&oacute;n</th>
            <th>Imagen</th>
            <th>Galer&iacute;a</th>
            <th>Operaciones</th>
        </tr>
        </tfoot>

		<tbody>
		<?php 

		foreach($listado as $key){
		?>
			
		  <tr>
		    <td><?php echo $key["titulo"]?></td>
		    <td><?php echo $key["fecha"]?></td>
		    <td><?php echo cortarTexto($key['descripcion'],40);?></td>
		    <td><img data-tooltip="Ampliar Imagen" data-position="top" data-delay="5" data-caption="<?php echo $key["titulo"]?>" src="<?php echo base_url()?>assets/imagenes/noticias/<?php echo "min_".$key["imagen"]?>" class="materialboxed tooltipped" width="50px"></td>
		    <td><a data-tooltip="Ver Galer&iacute;a" href="<?php echo base_url()?>admin_webkm/galeria/<?php echo $key["id"]?>" data-position="top" data-target="modal4<?php echo $key["id"]?>" data-delay="5" class="s modal-trigger tooltipped">
			<i class="material-icons">picture_in_picture</i>
				</a></td>
		    <td>
		    <a data-tooltip="Editar Noticia" data-position="top" data-delay="5" data-target="modal2<?php echo $key["id"]?>" class="s modal-trigger tooltipped">
			<i class="material-icons icon_description">description</i>
			</a>
			<a data-tooltip="Eliminar Noticia" data-position="top" data-delay="5"  data-target="modal3<?php echo $key["id"]?>" class="s modal-trigger tooltipped">
			<i class="material-icons icon_delete">delete</i>
			</a>		   
		   </td>
		  </tr>

		<?php 

		} 

		?>
		</tbody>
		</table>

		<?php 
		foreach($listado as $key){
		?>

		<!-- Modal Modificar -->
		<div id="modal2<?php echo $key["id"]?>" class="modal modal-fixed-footer" style="width:80%!important;height:70%!important;">

			<div class="modal-content">
			  <h4>Modificar Noticia</h4>
			  <div class="validation-error-mod"></div>
			  <div class="progress2"></div>
		        <?php echo form_open_multipart('admin_webkm/modificarnoticia', array('id'=>'formmodificar','class'=>'formmodificar')); ?>
				<input type="hidden" name="id" value="<?php echo $key["id"]?>">
				  <div class="row">
				      <div class="row">
				        <div class="input-field col s12 m12 l12">
				         <i class="material-icons prefix">mode_edit</i>
				          <input id="titulo" type="text" class="validate"  name="titulo_mod" value="<?php echo $key["titulo"]?>">
				          <label for="titulo">T&iacute;tulo</label>
				        </div>
				     
				   	  <div class="file-field input-field col s12 m12 l12">
					      <div class="btn">
					        <span>Im&aacute;gen (JPG o PNG)</span>
					        <input type="file" name="userfile" id="userfile" class="userfile">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text"  id="string_file_mod" class="string_file_mod" name="string_file_mod" value="<?php echo $key["imagen"]?>">
					      </div>
					    </div>
		 			</div>
				   	   <div class="row">
				        <div class="input-field col s12">
				          <i class="material-icons prefix">description</i>
				          <textarea id="descripcion" class="materialize-textarea"  name="descripcion_mod"><?php echo $key["descripcion"]?></textarea>
				          <label for="detalle">Detalle de la noticia</label>
				        </div>
				      </div>
						
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
			  <h4>Eliminar Noticia "<?php  echo $key["titulo"]?>"</h4>

			  <div class="validation-error-del"></div>
			  <div class="progress2-del"></div>
			 	   <?php echo form_open_multipart('admin_webkm/eliminaNoticia', array('id'=>'formeliminar','class'=>'formeliminar')); ?>

			  <p style="font-size:18px;">¿Confirma que desea eliminar esta noticia?</p>
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

<?php 
} 
?>
<!-- Modal Ingreso -->
	<div id="modal1" class="modal modal-fixed-footer" style="width:80%!important;height:70%!important;">
		<div class="modal-content">
		  <h4>Nueva Noticia</h4>
		  <div id="validation-error"></div>
		  <div class="progress2"></div>
	        <?php echo form_open_multipart('admin_webkm/nuevanoticia', array('id'=>'formnuevo','class'=>'formnuevo')); ?>

			  <div class="row">
			      <div class="row">
			        <div class="input-field col s12 m12 l12">
			         <i class="material-icons prefix">mode_edit</i>
			          <input id="titulo" type="text" class="validate" name="titulo">
			          <label for="titulo">T&iacute;tulo</label>
			        </div>
			     
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
			   	   <div class="row">
			        <div class="input-field col s12">
			          <i class="material-icons prefix">description</i>
			          <textarea id="descripcion" class="materialize-textarea" name="descripcion"></textarea>
			          <label for="detalle">Detalle de la noticia</label>
			        </div>
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

</div>
</div>
</div>
</div>
</section>

