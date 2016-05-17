<div class="listado_gal">
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
			<td><img data-tooltip="Ampliar Imagen" data-position="top" data-delay="5" data-caption="<?php echo $key["titulo"]?>" class="materialboxed tooltipped" width="150px" src="<?php echo base_url()?>assets/imagenes/noticias/<?php echo "min_".$key["imagen"];?>"></td>
			<td><!--<a data-id="<?php echo $key["id"];?>" data-idnoticia="<?php echo $key["idnoticia"];?>" href="<?php echo base_url()?>admin_webkm/eliminaimagengaleria/<?php echo $key["idnoticia"]?>/<?php echo $key["idgaleria"]?>" data-tooltip="Eliminar Imagen" data-position="top" data-delay="5" class="del_img_gal tooltipped del_gal">
				<i class="material-icons icon_delete">delete</i>
				</a>	-->
				<a data-idgal="<?php echo $key["idgaleria"];?>" data-idnoticia="<?php echo $key["idnoticia"];?>" href="<?php echo base_url()?>admin_webkm/eliminaimagengaleria" data-tooltip="Eliminar Imagen" data-position="top" data-delay="5" class="del_img_gal tooltipped del_gal">
				<i class="material-icons icon_delete">delete</i>
				</a>
			</td></tr>
		<?php
	}
?>	
		
</tbody>
</table>
</div>
</div>
</div>