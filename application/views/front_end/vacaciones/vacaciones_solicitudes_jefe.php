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
             <h3>Solicitudes de mi personal</h3>
          </div>
        </div>
   </div> -->
   <div class="row"> 
      <div class="col l10 offset-l1">
      <div class="table">
     <table class="bordered highlight centered">
        <thead>
          <tr>
              <th>Comprobante </th>
              <th>Usuario</th>
              <th>Rut</th>
              <th>Fecha Solicitud</th>
              <th>Fecha Inicio</th>
              <th>Fecha T&eacute;rmino</th>  
              <th>Fecha Respuesta</th>
              <th>Estado </th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach($solicitudes as $key){
          ?><tr>   
            <td>
            <?php
            if ($key["archivo"]!="") {
              ?>
            <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Descargar" href="<?php echo base_url()?><?php echo $key["archivo"]?>"> <i class="small material-icons">play_for_work</i></a>
              <?php
            }
            ?>
            </td>
            <td><?php echo $key["usuario"]?></td>
            <td><?php echo $key["rut_usuario"]?></td>
            <td><?php echo revierte_fecha($key["fecha_solicitud"])?></td>
            <td><?php echo revierte_fecha($key["fecha_inicio"])?></td>
            <td><?php echo revierte_fecha($key["fecha_termino"])?></td>   
            <td>
            <?php 
            if ($key["fecha_respuesta"]=="0000-00-00") {
              echo "-";
            }else{
            echo revierte_fecha($key["fecha_respuesta"]);
            }
            ?>

            </td>
            <td>
              <select data-env="<?php echo $key["enviada"]?>" data-id="<?php echo $key["id"]?>" name="estado_peticion" class="estado_peticion browser-default" id="estado_peticion">
              <?php 
              if ($key["estado"]==1) {
               ?>
                <option value="1" selected>Pendiente</option>
                <option value="2">Aprobada</option>
                <option value="3">Rechazada</option>
               <?php
              }elseif ($key["estado"]==2) {
               ?>
                <option value="1">Pendiente</option>
                <option value="2" selected>Aprobada</option>
                <option value="3">Rechazada</option>
               <?php
              }elseif ($key["estado"]==3) {
               ?>
                <option value="1">Pendiente</option>
                <option value="2">Aprobada</option>
                <option value="3" selected>Rechazada</option>
               <?php
              }
              ?>
              </select>
            </td>
            </tr>
          <?php
        }
        ?>
       </tbody>
       </table>
       </div>
     </div>
  </div>
</div>
</div><!-- FIN ROW -->

