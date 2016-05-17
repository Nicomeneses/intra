<style type="text/css">
  .card-panel {
    padding: 10px!important;
}
</style>
<script type="text/javascript">
  $('.tooltipped').tooltip({delay: 50});
</script>
<div class="row"> 
<div class="col l10 offset-l1">
<div class="table">
<?php 
if ($listado!=FALSE) {
?>
<table class="bordered highlight centered">
    <thead>
      <tr>
          <th>Archivo </th>
          <th>Periodo</th> 
      </tr>
    </thead>
    <tbody>
     <?php  
 	    foreach($listado as $key){
		$v=explode("-", $key["periodo"]);
		$mes=$v[0];$anio=$v[1];
      ?>
      <tr>   
        <td>
	        <?php
	        if ($key["archivo"]!="") {
	          ?>
	        <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Descargar" href="http://intranet.km-telecomunicaciones.cl/Archivo_PDF_Jefe_Seccion_LSP/<?php echo $key["carpeta"]?>/<?php echo $key["archivo"]?>"> <i class="small material-icons">play_for_work</i></a>
	          <?php
	        }
	        ?>
        </td>
        <td><?php echo meses($mes)." del ".$anio; ?></td>
        </tr>
      <?php
	  }
    ?>
   </tbody>
   </table>
<?php

}else{
	?>
	<div class='card-panel white-text teal lighten-1'><center>No se han encontrado liquidaciones.</center></div>
	<?php
}
?>

   </div>
 </div>
</div>
</div>
</div>
