<style type="text/css">
.modal.modal-fixed-footer {
    padding: 0px !important;
    height: 70% !important;
}
.modal {
    background-color: #FAFAFA;
    padding: 0px;
    max-height: 90% !important;
    top: 13% !important;
}
.modal {
    width: 75% !important;
}
@media only screen and (min-width : 993px) {
  .container {
    width: 100%; } }

</style>
<script type="text/javascript">
$(function(){

$('#tb_listado').dataTable({
	dom:
	"<'ui two column grid'<'left aligned column'l><'right aligned column'f>>" +
	"<'ui grid'<'column'tr>>" +
	"<'ui two column grid'<'left aligned column'i><'right aligned column'p>>",
   "order": [[ 3, "asc" ]],
  "iDisplayLength":10,   
  "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
  "bPaginate": true,
  "bLengthChange": true,
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

$('#formprevencionderiesgos').submit(function(){

var formElement = document.querySelector("#formprevencionderiesgos");
var formData = new FormData(formElement);
var ext = $('#userfile').val().split('.').pop().toLowerCase();

if($('.categoria').val()==""){
	$('#validation-error').html("<blockquote>Debe seleccionar la categor&iacute;a.</blockquote>");
	}else{
	if($('#userfile').val()==""){
		$('#validation-error').html("<blockquote>Debe seleccionar un archivo.</blockquote>");
		}else{
			if($.inArray(ext, ['doc','docx','ppt','pptx','pdf','xls','xlsx','sql']) == -1) {
		   $('#validation-error').html("<blockquote>Tipo de archivo invalido.</blockquote>");
		}else{
	    $.ajax({
	        url: $('.formprevencionderiesgos').attr('action')+"?"+$.now(),  
	        type: 'POST',
	        data: formData,
	        cache: false,
	        processData: false,
	        dataType: "json",
	  		contentType : false,
	/*  		beforeSend:function(){
            $("#validation-error").html("<img src='<?php echo base_url()?>assets/imagenes/loader.gif' height='10px' width='150px'>");
            },*/
	        success: function (data) {
	        	//alert(data);
				if(data.res == 0){
			     $('#validation-error').html("<blockquote>"+data.msg+"</blockquote>");
			     $('#validation-error').fadeIn();
			     $("#userfile").focus();
			    }else if(data.res == 1){
			     $('#validation-error').html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
			     $('#validation-error').fadeIn();		
			     $("#userfile").focus();
			     $(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="prevencionderiesgos"} ,1000);   
			    } 
	        }
   	   });
    }
}
}
return false;     
});

$('.formeliminar').submit(function(){
 $.post($(this).attr('action')+"?"+$.now(), $(this).serialize(), function(data) {
    if(data.res == 0){
     $(this).children('.validation-error-del').html(data.msg);
     $(this).children('.validation-error-del').fadeIn();
   }else
    if(data.res == 1){
		Materialize.toast(data.msg, 1000,'',function(){
			window.location="prevencionderiesgos";
		});
    }   
  }, 'json');
  return false;  
  });
});
</script>
<section class="main">
<div class="container">
<!-- Modal Ingreso -->
<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <center><h4>Nuevo Archivo de Prevenci&oacute;n</h4></center>
	  <div id="validation-error"></div>

	  <div class="card-panel white-text teal lighten-2">
		<blockquote style="border-left: 5px solid white;margin: 0px 0px;">
			*formatos aceptados : pdf,xls,xlsx,doc,docx,ppt,pptx. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*peso maximo : 3mg.
		</blockquote>
	  </div>

	  <div class="progress2"></div>
        <?php echo form_open_multipart('formprevencionderiesgos', array('id'=>'formprevencionderiesgos','class'=>'formprevencionderiesgos')); ?>
		  <div class="row">
		  <div class="input-field">
			
				<div class="input-field col s6">
			    <select class="browser-default categoria" name="categoria" id="categoria">
			      <option value="" selected>Seleccione Categor&iacute;a...</option>
			      <option value="Riesgos eléctricos">Riesgos eléctricos</option>
			      <option value="Riesgos en altura">Riesgos en altura</option>
			      <option value="Protocolos de accidente">Protocolos de accidente</option>
			      <option value="Exámenes obligatorios">Exámenes obligatorios</option>
			      <option value="Otros">Otros</option>
			    </select>
		    </div>

		      <div class="file-field input-field col s6">
		      <div class="btn">
		        <span>Archivo</span>
		        <input type="file" name="userfile" id="userfile">
		      </div>
		      <div class="file-path-wrapper ">
		        <input class="file-path validate" type="text" placeholder="Seleccionar archivo (pdf,doc,ppt,xls,xlsx)">
		      </div>
		      </div>

		      <center><div class="input-field col s12 l12">
		      <button class="btn waves-effect waves-light" type="submit">Subir
	   		  <i class="material-icons right">navigation</i>
	  	      </button>	
	  	      </div> </center>
	  	  </div>
		  </div>	
	</div>
	<?php echo form_close();?>  
</div>

<!-- Fin Modal Ingreso -->

<section class="">
<div class="container">
<div class="section">
<div class="row">
  <div class="col s12 m12 l12"> 
    <div class="changepass z-depth-2">
	<div class="row jumbotron">
		<div class="col l12 jumbotron_title">
			<div class="col s10">
				<h3>Prevenci&oacute;n de riesgos</h3>
			</div>
			<div class="col s2">
				<a  data-tooltip="Subir nuevo archivo " data-position="top" data-delay="50"  data-target="modal1" class="s modal-trigger tooltipped btn-floating  btn-medium waves-effect waves-light ">
				<i class="material-icons icon_add">add</i>
				</a>
			</div>
		</div>
	</div>

	<div class="changepass_form">
		<table id="tb_listado"  style="border: 1px solid rgba(0, 0, 0, 0.1);" class="centered dataTable bordered striped highlight responsive-table">
		<thead>
		  <tr> 
		  	  <th data-field="categoria">Categor&iacute;a</th>
		  	  <th data-field="subcategoria">Subcategor&iacute;a</th>
		      <th data-field="titulo">Titulo</th>
		      <th data-field="archivo">Archivo</th>
		      <th data-field="fecha">Fecha subida</th>
		      <th data-field="operaciones">Eliminar</th>
		  </tr>
		</thead>

		<tbody>
		<?php 
		if ($listado!=false) {
		foreach($listado as $key){
			$titulo=explode("/", $key["archivo"]);
			$titulo2=$titulo[1];
			$titulo3=explode(".", $titulo2);
		?>
		  <tr>
		    <td>Prevenci&oacute;n</td>
		    <td><?php echo $key["subcategoria"]?></td>
		    <td><?php echo $titulo3[0]?></td>
		    <td>
			<?php if ($titulo3[1]=="pdf" or $titulo3[1]=="PDF") {?>
		    <a data-tooltip="Visualizar PDF" data-position="top" data-delay="5" class="s modal-trigger tooltipped" href="<?php echo base_url()?><?php echo $key["archivo"]?>"><img src="<?php echo base_url()?>assets/imagenes/pdf.png"></a>
			<?php } ?>
			<?php if ($titulo3[1]=="xlsx" or $titulo3[1]=="XLSX" or $titulo3[1]=="xls" or $titulo3[1]=="XLS") {?>
		    <a data-tooltip="Visualizar EXCEL" data-position="top" data-delay="5" class="s modal-trigger tooltipped" href="<?php echo base_url()?><?php echo $key["archivo"]?>"><img src="<?php echo base_url()?>assets/imagenes/excel_icon.png" width="32px"></a>
			<?php } ?>
			<?php if ($titulo3[1]=="doc" or $titulo3[1]=="DOC" or $titulo3[1]=="docx" or $titulo3[1]=="DOCX" ) {?>
		    <a data-tooltip="Visualizar WORD" data-position="top" data-delay="5" class="s modal-trigger tooltipped" href="<?php echo base_url()?><?php echo $key["archivo"]?>"><img src="<?php echo base_url()?>assets/imagenes/word.png"></a>
			<?php } ?>
			<?php if ($titulo3[1]=="pptx" or $titulo3[1]=="PPTX" or $titulo3[1]=="ppt" or $titulo3[1]=="PPT") {?>
		    <a data-tooltip="Visualizar PPT" data-position="top" data-delay="5" class="s modal-trigger tooltipped" href="<?php echo base_url()?><?php echo $key["archivo"]?>"><img src="<?php echo base_url()?>assets/imagenes/powerpoint.png"></a>
			<?php } ?>
		    </td>
		    <td><?php echo $key["fecha_subida"]?></td>
		    <td>
			<a data-tooltip="Eliminar Archivo" data-position="top" data-delay="5"  data-target="modal3<?php echo $key["id"]?>" class="s modal-trigger tooltipped btn_eliminar">
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

		<!-- Modals -->
		<?php 
		if ($listado!=false) {
		foreach($listado as $key){
		$titulo=explode("/", $key["archivo"]);
		$titulo2=$titulo[1];
		$titulo3=explode(".", $titulo2);
		?>
		<!-- Modal Eliminar -->
		<div id="modal3<?php echo $key["id"]?>" class="modal">
			  <div class="modal-content">
			  <div class="validation-error-del"></div>
			  <div class="progress2-del"></div>

			  <?php echo form_open_multipart('eliminarArchivo', array('id'=>'formeliminar','class'=>'formeliminar')); ?>
			  <input type="hidden" name="id" id="id" value="<?php echo $key["id"]?>">
		      </div>
		      <center><p style="font-size:18px;text-align:center;!important">¿Confirma que desea eliminar este archivo?</p></center>
			  <br>
			  <center><button class="btn waves-effect waves-light" type="submit" name="eliminar">Eliminar
		   	  <i class="material-icons left">delete</i>
		  	  </button></center>
		  	  <br>
			  <?php echo form_close();?>
		</div>

	<?php 
	} 
	} 
?>
</div>
</div>
</div>
</div>
</div>	
</div>
</div>
</section>

