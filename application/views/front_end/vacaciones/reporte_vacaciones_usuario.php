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
  select{
    height: 2rem;
  }
</style>
<div class="row">
<div class="col s12 m12 l12"> 
<!--    <div class="row">
        <div class="col s12">
          <div class="changepass_title">
             <h3>Mis periodos de vacaciones</h3>
          </div>
        </div>
   </div> -->
   <div class="row"> 
      <div class="col l10 offset-l1">
      <div class="table">
       <?php 
        if ($solicitudes!=FALSE) {
        ?>
      <table class="bordered highlight centered">
        <thead>
          <tr>
              <th>Usuario</th>
              <th>Fecha Solicitud</th>
              <th>Fecha Inicio</th>
              <th>Fecha T&eacute;rmino</th>
              <th>Estado</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach($solicitudes as $key){
          $estado="";
          if($key["estado"]==1){$estado="En espera";}
          if($key["estado"]==2){$estado="Aprobada";}
          if($key["estado"]==3){$estado="Rechazada";}
          ?><tr>
            <td><?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?></td>
            <td><?php echo revierte_fecha($key["fecha_solicitud"])?></td>
            <td><?php echo revierte_fecha($key["fecha_inicio"])?></td>
            <td><?php echo revierte_fecha($key["fecha_termino"])?></td>
            <td><?php echo $estado?></td>
            </tr>
          <?php
        }
        ?>
       </tbody>
       </table>
       <?php
       }else{
        ?>
        <h5><center><blockquote>No hay periodos de vacaciones para mostrar.</blockquote></h5>
        <?php
       }
       ?>
       </div>
     </div>
  </div>
</div>
</div><!-- FIN ROW -->

