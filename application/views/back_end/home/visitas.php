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

	});
</script>

<section class="main" id="main" style="margin-top:5px;">
<div class="container">
<div class="row z-depth-4">
	<div class="col l12 cont_main">
		<div class="col l6 offset-l3 center">
			<h5>Visitas </h5>
		</div>
	</div>
	<div class="content_cont_main">
		<table id="tb_usuarios"  class="centered dataTable bordered striped highlight responsive-table">
		<thead>
		  <tr>
		      <th data-field="titulo">Usuario</th>
		      <th data-field="fecha">Fecha</th>
		      <th data-field="descripcion">Navegador</th>
		      <th data-field="imagen">IP</th>
		      <th data-field="galeria">P&aacute;gina</th>
		 </tr>
		</thead>
		<tbody>
		<?php 
		foreach($listado as $key){
			if($key["pagina"]=="loginval"){
				$pag="intranet";
			}else{
				$pag=$key["pagina"];
			}
		?>
		  <tr>
		    <td><?php echo $key["usuario"]?></td>
		    <td><?php echo $key["fecha"]?></td>
		    <td><?php echo nl2br($key["navegador"])?></td>
		    <td><?php echo $key["ip"]?></td>
		    <td><?php echo $pag?></td>
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
</div>
</div>
</section>

