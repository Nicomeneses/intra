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

})
</script>
<div class="row">
<div class="col s12 m12 l12"> 
<!--    <div class="row">
        <div class="col s12">
          <div class="changepass_title">
             <h3>Listado de vacaciones</h3>
          </div>
        </div>
   </div> -->
   <div class="row"> 
      <div class="col l12">
       <?php 
        if ($solicitudes!=FALSE) {
        ?>     
        <table id="tb_listado"  style="border: 1px solid rgba(0, 0, 0, 0.1);" class="centered dataTable bordered striped highlight responsive-table">
        <thead>
          <tr>
              <th data-field="usuario">Usuario</th>
              <th data-field="rut">Rut</th>
              <th data-field="fecha solicitud">Fecha Solicitud</th>
              <th data-field="fecha inicio">Fecha Inicio</th>
              <th data-field="fecha t&eacute;rmino">Fecha T&eacute;rmino</th>
              <th data-field="fecha respuesta">Fecha Respuesta</th>
              <th data-field="estado">Estado</th>
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

