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
  }	#modal1{
		height:300px!important;
	}
</style>
<script>
	$(function(){
		$(document).on('click', '.del_img_gal', function(event) {
			event.preventDefault();
			var url=$(this).attr('href')+"?"+$.now();
			var idgal=$(this).attr('data-idgal');
			var idnot=$(this).attr('data-idnoticia');
		    $(".listado_gal").fadeOut('slow');
			$.ajax({
				cache:false,
				url:url,
				type:"POST",
				async:true,
      			data: {'idgal': idgal, 'idnot': idnot} ,
				success:function(data){
					 Materialize.toast(data,2000);
 					$(".listado_gal").load("<?php echo base_url()?>admin_webkm/galeria/getGaleria/"+idnot);               
		     	    $("html, body").animate({ scrollTop: 0 }, 400);
		     	    $(".listado_gal").fadeIn('slow');

				}
			});
		});
	});
</script>
<section class="main" id="main" style="margin-top:5px;">
<div class="container">

<?php //print_r($listado)?>
<div class="row z-depth-4">
	<div class="col l12 cont_main">
			<div class="row">
				<div class="col s6 col m6 col l6">
					<a  href="<?php echo base_url()?>admin_webkm/noticias" data-tooltip="Volver" data-position="top" data-delay="5" class="tooltipped del_gal">
					<i style="margin-top:5px!important;" class="material-icons">fast_rewind</i>
					</a>
				</div>
				<div class="col s6 col m6 col l6">
					<div class="right-align">
					<a data-tooltip="Cargar Im&aacute;genes" data-position="top" data-delay="50"  data-target="modal1" class="s modal-trigger tooltipped btn-floating  btn-medium waves-effect waves-light ">
					<i class="material-icons icon_add">add</i>
					</a>
					</div>
				</div>
			</div>
	</div>
<?php
$mensaje = $this->session->flashdata('mensaje');
    if ($mensaje):echo $mensaje; endif;
?>	
		<div class="listado_gal" style="background-color:#f9f9f9;">
		<?php
		if(sizeof($listado)==0){
		?>
		<div class="row">
		<div class="col s6 offset-s3">
			<h2 class="flow-text"> 
			<blockquote>No se han encontrado im&aacute;genes. </blockquote>
			</h2>
		</div>
		</div>

		<?php
		}else{
		?>

		<div class="row">
		<div class="col s12">
			<table id="table_gal" class="z-depth-1 bordered centered responsive-table highlight">
				<thead>
					<tr>
						<!--<th>T&iacute;tulo</th>-->
						<th>Imagen</th>
						<th>Operaciones</th>
					</tr>
				</thead>
				<tbody>
					
					<?php	
				
				foreach($listado as $key){

					?>
						<!--<tr><td><?php echo $key["titulo"];?></td>-->
						<tr><td><img data-tooltip="Ampliar Imagen" data-position="top" data-delay="5" data-caption="<?php echo $key["titulo"]?>" class="materialboxed tooltipped" width="150px" src="<?php echo base_url()?>assets/imagenes/noticias/<?php echo "min_".$key["imagen"];?>"></td>
						<td><!--<a data-id="<?php echo $key["id"];?>" data-idnoticia="<?php echo $key["idnoticia"];?>" href="<?php echo base_url()?>admin_webkm/eliminaimagengaleria/<?php echo $key["idnoticia"]?>/<?php echo $key["idgaleria"]?>" data-tooltip="Eliminar Imagen" data-position="top" data-delay="5" class="del_img_gal tooltipped del_gal">
							<i class="material-icons icon_delete">delete</i>
							</a>	-->
							<a data-idgal="<?php echo $key["idgaleria"];?>" data-idnoticia="<?php echo $key["idnoticia"];?>" href="<?php echo base_url()?>admin_webkm/eliminaimagengaleria" data-tooltip="Eliminar Imagen" data-position="top" data-delay="5" class="del_img_gal tooltipped del_gal">
							<i class="material-icons icon_delete">delete</i>
							</a>
						</td></tr>
					<?php
					}
				}
			?>	
					
				</tbody>
		</table>
		</div>
		</div>
		</div>
	</div>
</div>

	<div id="modal1" class="modal modal-fixed-footer">

	<div class="modal-content">
	  <h4>Carga de Im&aacute;genes </h4>
	  <div id="validation-error"></div>
	  <div class="progress2"></div>
	    <?php echo form_open_multipart('admin_webkm/cargaimagenes', array('id'=>'formcarga','class'=>'formcarga')); ?>
			<input type="hidden" name="id" value="<?php echo $idnoticia;?>">
		      <div class="row">
		   	  <div class="file-field input-field col s12 m12 l12">
			      <div class="btn">
			        <span>Im&aacute;genes (JPG o PNG)</span>
			        <input type="file" id="archivos" name="archivos[]" size="20" multiple="multiple">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text" name="string">
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
</section>