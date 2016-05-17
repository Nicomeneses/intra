<style type="text/css" media="screen">
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
  ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
      color:    rgba(0,0,0,.7);
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color:    rgba(0,0,0,.7);
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color:    rgba(0,0,0,.7);
  }
  :-ms-input-placeholder { /* Internet Explorer 10-11 */
      color:    rgba(0,0,0,.7);
  }
</style>
<script type="text/javascript">
  $(function(){
    $('.tooltipped').tooltip({delay: 50});
    $('#tb_listado2 tfoot th').each( function () {
    var title = $('#tb_listado2 thead th').eq( $(this).index() ).text();
        if(title!="Personal a cargo"){
          if(title!="Archivo PDF recepcionado"){
          $(this).html('<center><input type="text" class="" style="width:90px;font-size:11px;" /><center>' );
          }else{
            $(this).html("<center><b></b></center>");
          }
        }else{
          $(this).html("<center><b></b></center>");
        }

    });
     
    var table = $('#tb_listado2').DataTable({
       dom:
        "<'ui two column grid'<'left aligned column'l><'right aligned column'f>>" +
        "<'ui grid'<'column'tr>>" +
        "<'ui two column grid'<'left aligned column'i><'right aligned column'p>>",

      "iDisplayLength":5, 
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
      "bPaginate": true,
      "aaSorting" : [],
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
        "sSearch":         "",
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

    $(document).on('click', '.verpersonal', function(event) {
      event.preventDefault();
       var rut=$(this).attr("data-rut");
       $.post("getPersonal"+"?"+$.now(),{"rut":rut},function(data) {
        $("#liqu_personal").html(data);
       });
    });
  });
</script>

<div class="cont_datatable">
<div class="row"> 
<div class="col l12">
<div class="table">
   <div class="col s12 m12 l12">
   <table id="tb_listado2"  class="centered dataTable bordered striped highlight">
    <thead>
      <tr>
          <th>Nombre colaborador</th>
          <th>Rut colaborador</th>
          <th>Cargo</th>
          <th>Personal a cargo</th>
          <th>Periodo</th>
          <th>Archivo</th>
      </tr>
    </thead>

    <tfoot>
       <tr style="background-color:#F9F9F9">
          <th>Nombre colaborador</th>
          <th>Rut colaborador</th>
          <th>Cargo</th>
          <th>Personal a cargo</th>
          <th>Periodo</th>
          <th>Archivo</th>
      </tr>
    </tfoot>

    <tbody>
    <?php 
    if(FALSE!=$listado){
      
    foreach($listado as $key){  
      $nombre=$key["pn"]." ".$key["sn"]." ".$key["ap"];
      ?>  
        <tr data-rut="<?php echo $key["rut_usuario"]?>">
          <td>
          <?php echo $nombre?>
          </td>
          <td><?php echo $key["rut_usuario"]?></td>
          <td><?php echo $key["cargo"]?></td>
          <?php
          if($key["nivel_acceso"]==2 or $key["nivel_acceso"]==3 or $key["nivel_acceso"]==4 or $key["nivel_acceso"]==5){
          ?>
          <td><a data-rut="<?php echo $key["rut_usuario"]?>" style="font-size:14px;" class="verpersonal" href="#">Ver personal</a></td>
          <?php
          }else{
           ?>
          <td></td>
          <?php 
          }
          ?>

          <td><?php echo $key["periodo"]?></td>

          <?php
          $tipo=substr($key["archivo"],-3);
          if(!empty($key["archivo"])){
          ?>
         <td>
              <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Descargar" target="_blank" href="http://intranet.km-telecomunicaciones.cl/<?php echo $key["archivo"]?>"> <i class="small material-icons">play_for_work</i></a>
         </td>
          <?php
          }else{
          ?>
         <td>Archivo no disponible</td>
          <?php
          }
          ?>

          
        </tr>
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
