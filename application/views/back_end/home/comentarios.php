<script type="text/javascript">
	$(function(){

	$('#tb_comentario_noticia').dataTable({

	dom:
	        "<'ui two column grid'<'left aligned column'l><'right aligned column'f>>" +
	        "<'ui grid'<'column'tr>>" +
	        "<'ui two column grid'<'left aligned column'i><'right aligned column'p>>",
		  "order": [[ 1, "desc" ]],
	      "iDisplayLength":5, 
	      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
	      "bPaginate": true,
	      "bLengthChange": false,
	      "bFilter": true,
	      "bSort": true,
	      "bInfo": true,
	      "pagingType": "simple" ,
	      "bAutoWidth": true ,
		"language": {
		    "url": "<?php echo base_url()?>assets/back_end/es.json",      
		},
		});

		$('#tb_comentario_cumple').dataTable({
	dom:
	        "<'ui two column grid'<'left aligned column'l><'right aligned column'f>>" +
	        "<'ui grid'<'column'tr>>" +
	        "<'ui two column grid'<'left aligned column'i><'right aligned column'p>>",
		  "order": [[ 1, "desc" ]],
	      "iDisplayLength":5, 
	      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
	      "bPaginate": true,
	      "bLengthChange": false,
	      "bFilter": true,
	      "bSort": true,
	      "bInfo": true,
	      "pagingType": "simple" ,
	      "bAutoWidth": true ,
		"language": {
		    "url": "<?php echo base_url()?>assets/back_end/es.json",      
		},
		});

		$('#tb_comentario_ingreso').dataTable({
		dom:
	        "<'ui two column grid'<'left aligned column'l><'right aligned column'f>>" +
	        "<'ui grid'<'column'tr>>" +
	        "<'ui two column grid'<'left aligned column'i><'right aligned column'p>>",
		  "order": [[ 1, "desc" ]],
	      "iDisplayLength":5, 
	      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
	      "bPaginate": true,
	      "bLengthChange": false,
	      "bFilter": true,
	      "bSort": true,
	      "bInfo": true,
	      "pagingType": "simple" ,
	      "bAutoWidth": true ,
		"language": {
		    "url": "<?php echo base_url()?>assets/back_end/es.json",      
		},
		});

		$('#tb_comentario_nacimientos').dataTable({
	dom:
	        "<'ui two column grid'<'left aligned column'l><'right aligned column'f>>" +
	        "<'ui grid'<'column'tr>>" +
	        "<'ui two column grid'<'left aligned column'i><'right aligned column'p>>",
		  "order": [[ 1, "desc" ]],
	      "iDisplayLength":5, 
	      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
	      "bPaginate": true,
	      "bLengthChange": false,
	      "bFilter": true,
	      "bSort": true,
	      "bInfo": true,
	      "pagingType": "simple" ,
	      "bAutoWidth": true ,
		"language": {
		    "url": "<?php echo base_url()?>assets/back_end/es.json",      
		},
		});


	$(document).on('submit', '.formModificarComentarioNoticia', function(event) {
	var form=$(this);
	var formData = new FormData( this );
	    $.ajax({
	        url: $(".formModificarComentarioNoticia").attr('action')+"?"+$.now(),  
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
			    else
			    if(data.st == 1){
			     form.parent("div").find(".validation-error-mod").html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
	        	 form.parent("div").find(".validation-error-mod").fadeIn();	
	         	 form.parent("div").find(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="comentarios?v=not"} ,1000);   
			    } 
	        }
	       
	    });
	      return false;   
	 });    

	$('.formEliminarComentarioNoticia').submit(function(){
	 $.post($(this).attr('action')+"?"+$.now(), $(this).serialize(), function(data) {
	    if(data.st == 1){
	     $(this).children('.validation-error-del').html(data.msg);
	     $(this).children('.validation-error-del').fadeIn();
	   }else
	    if(data.st == 0){
			Materialize.toast(data.msg, 1000,'',function(){
				window.location="comentarios?v=not";
			});
	    }   
	}, 'json');
	return false;  
	});


	$(document).on('submit', '.formModificarComentarioCumple', function(event) {
	var form=$(this);
	var formData = new FormData( this );
	    $.ajax({
	        url: $(".formModificarComentarioCumple").attr('action')+"?"+$.now(),  
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
			    else
			    if(data.st == 1){
			     form.parent("div").find(".validation-error-mod").html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
	        	 form.parent("div").find(".validation-error-mod").fadeIn();	
	         	 form.parent("div").find(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="comentarios?v=cump"} ,1000);   
			    } 
	        }
	       
	    });
	      return false;   
	 });    

	$('.formEliminarComentarioCumple').submit(function(){
	 $.post($(this).attr('action')+"?"+$.now(), $(this).serialize(), function(data) {
	    if(data.st == 1){
	     $(this).children('.validation-error-del').html(data.msg);
	     $(this).children('.validation-error-del').fadeIn();
	   }else
	    if(data.st == 0){
			Materialize.toast(data.msg, 1000,'',function(){
				window.location="comentarios?v=cump";
			});
	    }   
	}, 'json');
	return false;  
	});


	$(document).on('submit', '.formModificarComentarioIngreso', function(event) {
	var form=$(this);
	var formData = new FormData( this );
	    $.ajax({
	        url: $(".formModificarComentarioIngreso").attr('action')+"?"+$.now(),  
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
			    else
			    if(data.st == 1){
			     form.parent("div").find(".validation-error-mod").html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
	        	 form.parent("div").find(".validation-error-mod").fadeIn();	
	         	 form.parent("div").find(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="comentarios?v=ing"} ,1000);   
			    } 
	        }
	       
	    });
	      return false;   
	 });    

	$('.formEliminarComentarioIngreso').submit(function(){
	 $.post($(this).attr('action')+"?"+$.now(), $(this).serialize(), function(data) {
	    if(data.st == 1){
	     $(this).children('.validation-error-del').html(data.msg);
	     $(this).children('.validation-error-del').fadeIn();
	   }else
	    if(data.st == 0){
			Materialize.toast(data.msg, 1000,'',function(){
				window.location="comentarios?v=ing";
			});
	    }   
	}, 'json');
	return false;  
	});

	$(document).on('submit', '.formModificarComentarioNacimiento', function(event) {
	var form=$(this);
	var formData = new FormData( this );
	    $.ajax({
	        url: $(".formModificarComentarioNacimiento").attr('action')+"?"+$.now(),  
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
			    else
			    if(data.st == 1){
			     form.parent("div").find(".validation-error-mod").html('<div class="alert alert-success" align="center"><strong>'+data.msg+'</strong></div>');
	        	 form.parent("div").find(".validation-error-mod").fadeIn();	
	         	 form.parent("div").find(".progress2").html('<div class="progress"><div class="indeterminate"></div></div>');
			     setTimeout(function(){window.location="comentarios?v=nac"} ,1000);   
			    } 
	        }
	       
	    });
	      return false;   
	 });    

	$('.formEliminarComentarioNacimiento').submit(function(){
	 $.post($(this).attr('action')+"?"+$.now(), $(this).serialize(), function(data) {
	    if(data.st == 1){
	     $(this).children('.validation-error-del').html(data.msg);
	     $(this).children('.validation-error-del').fadeIn();
	   }else
	    if(data.st == 0){
			Materialize.toast(data.msg, 1000,'',function(){
				window.location="comentarios?v=nac";
			});
	    }   
	}, 'json');
	return false;  
	});
	$('ul.tabs').tabs();
	});
</script>

<section class="main" id="main" style="margin-top:5px;">
<div class="container">
<div class="row z-depth-4">
<div class="cont_main z-depth-2">
	<div class="col l12 cont_main">
		<div class="col l6 offset-l3 center">
			<h5>Gesti&oacute;n de comentarios</h5>
		</div>
	</div>

  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a <?php if(@$_GET["v"]=="not"){ echo "class='active'";  }?> href="#noticias">Noticias</a></li>
        <li class="tab col s3"><a <?php if(@$_GET["v"]=="cump"){ echo "class='active'";  }?> href="#cumpleanios">Cumplea&ntilde;os</a></li>
        <li class="tab col s3"><a <?php if(@$_GET["v"]=="ing"){ echo "class='active'";  }?> href="#ultimos_ingresos">&Uacute;ltimos ingresos</a></li>
        <li class="tab col s3"><a <?php if(@$_GET["v"]=="nac"){ echo "class='active'";  }?> href="#nacimientos">Nacimientos</a></li>
      </ul>
    </div>

    <div id="noticias" class="col s12">
	    <div class="content_cont_main">
		    <table id="tb_comentario_noticia"  class="centered dataTable bordered striped highlight responsive-table" style="border:1px solid rgba(0,0,0,.1);">
		        <thead>
		          <tr>
		              <th>Noticia</th>
		              <th>Usuario</th>
		              <th>Fecha</th>
		              <th>Comentario</th>
		              <th>Operaciones</th>
		          </tr>
		        </thead>
		        <tbody>
			    <?php 
			     foreach($comentariosNoticias as $noticia){
			    ?>
		      	 <tr>
		      	 	<td><p data-id="<?php echo $noticia["id"]?>"><?php echo $noticia["titulo"]?></p></td>
			        <td><p data-id="<?php echo $noticia["id"]?>"><?php echo $noticia["pn"]." ".$noticia["ap"]?></p></td>
			        <td><p data-id="<?php echo $noticia["id"]?>"><?php echo $noticia["fecha"]?></p></td>
			        <td><p data-id="<?php echo $noticia["id"]?>"><?php echo $noticia["comentario"]?></p></td>
			        <td>
				    <a data-tooltip="Editar Comentario" data-position="top" data-delay="5" data-target="modalnm<?php echo $noticia["id"]?>" class="s modal-trigger tooltipped atable">
					<i class="material-icons icon_description">description</i>
					</a>
					<a data-tooltip="Eliminar Comentario" data-position="top" data-delay="5"  data-target="modalne<?php echo $noticia["id"]?>" class="s modal-trigger tooltipped atable">
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
			     foreach($comentariosNoticias as $key){
			    ?>
				<div id="modalnm<?php echo $key["id"]?>" class="modal modal-fixed-footer">
				<div class="modal-content">
				  <center><h4>Modificar Comentario</h4></center>
				  <div class="divider"></div>
				  <div class="validation-error-mod"></div>
				  <div class="progress2"></div><br><br>
			        <?php echo form_open('admin_webkm/modComentarioNoticia', array('id'=>'formModificarComentarioNoticia','class'=>'formModificarComentarioNoticia')); ?>
					<input type="hidden" name="id" value="<?php echo $key["id"]?>">
				    <div class="row">
				    <div class="input-field col s6 offset-s3">
			          <textarea id="comentario" name="comentario" class="materialize-textarea"><?php echo $key["comentario"]?></textarea>
			          <label for="textarea1">Comentario Adicional</label>
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

				<div id="modalne<?php echo $key["id"]?>" class="modal">

					<div class="modal-content">
					  <center><h4>Eliminar Comentario</h4></center>
					  <div class="validation-error-del"></div>
					  <div class="progress2-del"></div>
					  <?php echo form_open_multipart('admin_webkm/eliComentarioNoticia', array('id'=>'formEliminarComentarioNoticia','class'=>'formEliminarComentarioNoticia')); ?>
					  <p style="font-size:18px;text-align:center;">¿Confirma que desea eliminar este registro?</p>
					  <input type="hidden" name="id" id="id" value="<?php echo $key["id"]?>">
					</div>

					<div class="modal-footer">
					   <button class="btn waves-effect waves-light" type="submit" name="eliminar">Eliminar
				   		 <i class="material-icons right">delete</i>
				  	   </button>
				  	  <?php echo form_close();?>  
					</div>

				</div>
				<?php
			   }
			   ?>
	    </div>
	</div>

    <div id="cumpleanios" class="col s12">
      <div class="content_cont_main">

	   	<table id="tb_comentario_cumple"  class="centered dataTable bordered striped highlight responsive-table" style="border:1px solid rgba(0,0,0,.1);">
	        <thead>
	          <tr>
	              <th>Usuario Comentario</th>
	              <th>Fecha</th>
	              <th>Comentario</th>
	              <th>Operaciones</th>
	          </tr>
	        </thead>
	        <tbody>
		    <?php 
		     foreach($comentariosCumple as $cumple){
		    ?>
	      	 <tr>
	      	 	<td><p data-id="<?php echo $cumple["id"]?>"><?php echo $cumple["pn"]." ".$cumple["ap"]?></p></td>
		        <td><p data-id="<?php echo $cumple["id"]?>"><?php echo $cumple["fecha"]?></p></td>
		        <td><p data-id="<?php echo $cumple["id"]?>"><?php echo $cumple["comentario"]?></p></td>
		        <td>
			    <a data-tooltip="Editar Comentario" data-position="top" data-delay="5" data-target="modalcm<?php echo $cumple["id"]?>" class="s modal-trigger tooltipped atable">
				<i class="material-icons icon_description">description</i>
				</a>
				<a data-tooltip="Eliminar Comentario" data-position="top" data-delay="5"  data-target="modalce<?php echo $cumple["id"]?>" class="s modal-trigger tooltipped atable">
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
		     foreach($comentariosCumple as $key){
		    ?>
			<div id="modalcm<?php echo $key["id"]?>" class="modal modal-fixed-footer">
			<div class="modal-content">
			  <center><h4>Modificar Comentario</h4></center>
			  <div class="divider"></div>
			  <div class="validation-error-mod"></div>
			  <div class="progress2"></div><br><br>
		        <?php echo form_open('admin_webkm/modComentarioCumple', array('id'=>'formModificarComentarioCumple','class'=>'formModificarComentarioCumple')); ?>
				<input type="hidden" name="id" value="<?php echo $key["id"]?>">
			    <div class="row">
			    <div class="input-field col s6 offset-s3">
		          <textarea id="comentario" name="comentario" class="materialize-textarea"><?php echo $key["comentario"]?></textarea>
		          <label for="textarea1">Comentario Adicional</label>
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
			<div id="modalce<?php echo $key["id"]?>" class="modal">
				<div class="modal-content">
				  <center><h4>Eliminar Comentario</h4></center>
				  <div class="validation-error-del"></div>
				  <div class="progress2-del"></div>
				  <?php echo form_open_multipart('admin_webkm/eliComentarioCumple', array('id'=>'formEliminarComentarioCumple','class'=>'formEliminarComentarioCumple')); ?>
				  <p style="font-size:18px;text-align:center;">¿Confirma que desea eliminar este registro?</p>
				  <input type="hidden" name="id" id="id" value="<?php echo $key["id"]?>">
				</div>
				<div class="modal-footer">
				   <button class="btn waves-effect waves-light" type="submit" name="eliminar">Eliminar
			   		 <i class="material-icons right">delete</i>
			  	   </button>
			  	  <?php echo form_close();?>  
				</div>
			</div>
			<?php
		   }
		   ?>
	    </div>
  	 </div>

    <div id="ultimos_ingresos" class="col s12">
    <div class="content_cont_main">
	<table id="tb_comentario_ingreso" class="centered dataTable bordered striped highlight responsive-table" style="border:1px solid rgba(0,0,0,.1);">
        <thead>
          <tr>
              <th>Usuario Comentario</th>
              <th>Fecha</th>
              <th>Comentario</th>
              <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>
	    <?php 
	     foreach($comentariosIngresos as $ingreso){
	    ?>
      	 <tr>
      	 	<td><p data-id="<?php echo $ingreso["id"]?>"><?php echo $ingreso["pn"]." ".$ingreso["ap"]?></p></td>
	        <td><p data-id="<?php echo $ingreso["id"]?>"><?php echo $ingreso["fecha"]?></p></td>
	        <td><p data-id="<?php echo $ingreso["id"]?>"><?php echo $ingreso["comentario"]?></p></td>
	        <td>
		    <a data-tooltip="Editar Comentario" data-position="top" data-delay="5" data-target="modalim<?php echo $ingreso["id"]?>" class="s modal-trigger tooltipped atable">
			<i class="material-icons icon_description">description</i>
			</a>
			<a data-tooltip="Eliminar Comentario" data-position="top" data-delay="5"  data-target="modalie<?php echo $ingreso["id"]?>" class="s modal-trigger tooltipped atable">
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
	     foreach($comentariosIngresos as $key){
	    ?>
		<div id="modalim<?php echo $key["id"]?>" class="modal modal-fixed-footer">
		<div class="modal-content">
		  <center><h4>Modificar Comentario</h4></center>
		  <div class="divider"></div>
		  <div class="validation-error-mod"></div>
		  <div class="progress2"></div><br><br>
	        <?php echo form_open('admin_webkm/modComentarioIngreso', array('id'=>'formModificarComentarioIngreso','class'=>'formModificarComentarioIngreso')); ?>
			<input type="hidden" name="id" value="<?php echo $key["id"]?>">
		    <div class="row">
		    <div class="input-field col s6 offset-s3">
	          <textarea id="comentario" name="comentario" class="materialize-textarea"><?php echo $key["comentario"]?></textarea>
	          <label for="textarea1">Comentario Adicional</label>
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

		<div id="modalie<?php echo $key["id"]?>" class="modal">

			<div class="modal-content">
			  <center><h4>Eliminar Comentario</h4></center>
			  <div class="validation-error-del"></div>
			  <div class="progress2-del"></div>
			  <?php echo form_open_multipart('admin_webkm/eliComentarioIngreso', array('id'=>'formEliminarComentarioIngreso','class'=>'formEliminarComentarioIngreso')); ?>
			  <p style="font-size:18px;text-align:center;">¿Confirma que desea eliminar este registro?</p>
			  <input type="hidden" name="id" id="id" value="<?php echo $key["id"]?>">
			</div>
			<div class="modal-footer">
			   <button class="btn waves-effect waves-light" type="submit" name="eliminar">Eliminar
		   		 <i class="material-icons right">delete</i>
		  	   </button>
		  	  <?php echo form_close();?>  
			</div>

		</div>
		<?php
	   }
	   ?>
 </div>
 </div>	

 <div id="nacimientos" class="col s12">
 <div class="content_cont_main">
 <table id="tb_comentario_nacimientos" class="centered dataTable bordered striped highlight responsive-table" style="border:1px solid rgba(0,0,0,.1);">
        <thead>
          <tr>
              <th>Usuario Comentario</th>
              <th>Fecha</th>
              <th>Comentario</th>
              <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>
	    <?php 
	     foreach($comentariosNacimientos as $nac){
	    ?>
      	 <tr>
      	 	<td><p data-id="<?php echo $nac["id"]?>"><?php echo $nac["pn"]." ".$nac["ap"]?></p></td>
	        <td><p data-id="<?php echo $nac["id"]?>"><?php echo $nac["fecha"]?></p></td>
	        <td><p data-id="<?php echo $nac["id"]?>"><?php echo $nac["comentario"]?></p></td>
	        <td>
		    <a data-tooltip="Editar Comentario" data-position="top" data-delay="5" data-target="modalncm<?php echo $nac["id"]?>" class="s modal-trigger tooltipped atable">
			<i class="material-icons icon_description">description</i>
			</a>
			<a data-tooltip="Eliminar Comentario" data-position="top" data-delay="5"  data-target="modalnce<?php echo $nac["id"]?>" class="s modal-trigger tooltipped atable">
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
	     foreach($comentariosNacimientos as $key){
	    ?>
		<div id="modalncm<?php echo $key["id"]?>" class="modal modal-fixed-footer">
		<div class="modal-content">
		  <center><h4>Modificar Comentario</h4></center>
		  <div class="divider"></div>
		  <div class="validation-error-mod"></div>
		  <div class="progress2"></div><br><br>
	        <?php echo form_open('admin_webkm/modComentarioNacimiento', array('id'=>'formModificarComentarioNacimiento','class'=>'formModificarComentarioNacimiento')); ?>
			<input type="hidden" name="id" value="<?php echo $key["id"]?>">
		    <div class="row">
		    <div class="input-field col s6 offset-s3">
	          <textarea id="comentario" name="comentario" class="materialize-textarea"><?php echo $key["comentario"]?></textarea>
	          <label for="textarea1">Comentario Adicional</label>
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

		<div id="modalnce<?php echo $key["id"]?>" class="modal">

			<div class="modal-content">
			  <center><h4>Eliminar Comentario</h4></center>
			  <div class="validation-error-del"></div>
			  <div class="progress2-del"></div>
			  <?php echo form_open_multipart('admin_webkm/eliComentarioNacimiento', array('id'=>'formEliminarComentarioNacimiento','class'=>'formEliminarComentarioNacimiento')); ?>
			  <p style="font-size:18px;text-align:center;">¿Confirma que desea eliminar este registro?</p>
			  <input type="hidden" name="id" id="id" value="<?php echo $key["id"]?>">
			</div>
			<div class="modal-footer">
			   <button class="btn waves-effect waves-light" type="submit" name="eliminar">Eliminar
		   		 <i class="material-icons right">delete</i>
		  	   </button>
		  	  <?php echo form_close();?>  
			</div>

		</div>
		<?php
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

