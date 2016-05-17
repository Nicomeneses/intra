<script type="text/javascript">
    var fecha = new Date();
      var month = new Array();
      month[0] = "Enero";
      month[1] = "Febrero";
      month[2] = "Marzo";
      month[3] = "Abril";
      month[4] = "Mayo";
      month[5] = "Junio";
      month[6] = "Julio";
      month[7] = "Agosto";
      month[8] = "Septiembre";
      month[9] = "Octubre";
      month[10] = "Noviembre";
      month[11] = "Diciembre";
      var mesanterior = month[fecha.getMonth()-1];
      var mesactual = month[fecha.getMonth()];
      var url="<?php echo base_url()?>";

      google.charts.load('current', {'packages':['corechart','table','bar']});
      google.charts.setOnLoadCallback(drawAsis);
      google.charts.setOnLoadCallback(drawAsisTable);
      google.charts.setOnLoadCallback(drawInspecciones);
      google.charts.setOnLoadCallback(drawInspeccionesTable);
      google.charts.setOnLoadCallback(drawFlotaEstado);
      google.charts.setOnLoadCallback(drawFlotaEstadoTable);
      google.charts.setOnLoadCallback(drawFlotaAsignados);
      google.charts.setOnLoadCallback(drawFlotaAsignadosTable)
      google.charts.setOnLoadCallback(drawPagosMontos);
      google.charts.setOnLoadCallback(drawPagosFacturas);
      google.charts.setOnLoadCallback(drawTotalIgresos);
       google.charts.setOnLoadCallback(drawTotalSalidas);
      ValoresBolsa1();
      widgetVisitas();
      widgetUsuarios();

   function widgetVisitas(){
      $.post(url+'admin_webkm/reporteVisitasMes'+"?"+$.now(), function(data) {
            $(".visitas_cont_mes").html(data);
      }); 
       $.post(url+'admin_webkm/reporteVisitasDia'+"?"+$.now(), function(data) {
            $(".visitas_cont_dia").html(data);
      }); 
   }

   function widgetUsuarios(){
      $.post(url+'admin_webkm/reporteUsuariosAct'+"?"+$.now(), function(data) {
         $(".nuevos_usuarios_mes").html(data);
      });
      $.post(url+'admin_webkm/reporteUsuariosTotal'+"?"+$.now(), function(data) {
         $(".nuevos_usuarios_totales").html(data);
      });
   }

   function drawAsis(){
      var datos1 = $.ajax({
          url:url+'admin_webkm/getReporteriadata'+"?"+$.now(),
          type:'post',
          dataType:'json',
          async:false       
      }).responseText;
       datos = JSON.parse(datos1);    
       var data = google.visualization.arrayToDataTable(datos);
       var options = {
         isStacked: "percent",
         title: 'Asistencia operación domiciliaria Santiago',
         width: "100%",
         height: 240,
         is3D:true,
         colors:["#00897b","#26a69a","#80cbc4"],
         
         chartArea:{
         left:50,
         right:151,
         bottom:40,
         top:40,
         width:"100%",
         height:"100%"
         },

         backgroundColor: '#009688',

         titleTextStyle: {color: '#FFF',
         fontName: 'Roboto',
         fontSize: '16', 
         fontWidth: 'normal',
         bold:false
         },

         legend: {textStyle: {fontSize: 13,bold:false,color:'#FFF',fontName: 'Roboto'}}, 

         hAxis: {
          textStyle:{color: '#FFF', bold:false,fontName: 'Roboto'},
         },
         vAxis: {
          textStyle:{color: '#FFF',bold:false,fontName: 'Roboto'},
         },

         tooltip:{textStyle:{fontSize:'13'}}
        };

      var chart = new google.visualization.ColumnChart(document.getElementById('asistencia'));
      chart.draw(data, options);
   }

   function drawAsisTable(){
      var datos1 = $.ajax({
          url:url+'admin_webkm/getReporteriadata'+"?"+$.now(),
          type:'post',
          dataType:'json',
          async:false       
      }).responseText;
      datos = JSON.parse(datos1);    
      var data = google.visualization.arrayToDataTable(datos);
      var table = new google.visualization.Table(document.getElementById('tablaasistencia'));

      var cssClassNames = {
                    'headerRow': 'header-row',
                    'tableRow': 'table-row',
                    'oddTableRow': 'odd-table-row',
                    'selectedTableRow': 'selected-table-row',
                    'hoverTableRow': 'hover-table-row',
                    'headerCell': 'header-cell center color-gradient font15',
                    'tableCell': 'table-cell left-text font12',
                    'rowNumberCell': ''};
      var options = {
         width:"100%", 
         height: "100%",
         page: 'enable',
         pageSize: 6,
         pagingSymbols: {
          prev: 'Anterior',
          next: 'Siguiente'
         },
         pagingButtonsConfiguration: 'auto','cssClassNames': cssClassNames

      }
      table.draw(data, options);
   }

   function drawInspecciones(){
      var datos1 = $.ajax({
          url:url+'admin_webkm/getInspeccionesdata'+"?"+$.now(),
          type:'post',
          dataType:'json',
          async:false       
      }).responseText;
       datos = JSON.parse(datos1);    
       var data = google.visualization.arrayToDataTable(datos);

       var options = {
         is3D:true,
         title: 'Inspecciones mes de '+mesanterior+' operación domiciliaria Santiago',
         sliceVisibilityThreshold:0,
         width: "100%",
         height: 240,
         chartArea:{
           left:10,
           right:10,
           bottom:10,
           top:30,
           width:"100%",
           height:"100%"
           },
           backgroundColor: '#009688',
           titleTextStyle: {color: '#FFF',
           fontName: 'Roboto',
           fontSize: '16', 
           fontWidth: 'normal',
           bold:false
           },
           legend: {textStyle: {fontSize: 12,bold:false,color:'#FFF',fontName: 'Roboto'}},
           tooltip:{textStyle:{fontSize:'13'}}
        };
       var chart = new google.visualization.PieChart(document.getElementById('inspecciones'));
       chart.draw(data, options); 
   }

   function drawInspeccionesTable(){
      var datos1 = $.ajax({
          url:url+'admin_webkm/getInspeccionesdata'+"?"+$.now(),
          type:'post',
          dataType:'json',
          async:false       
      }).responseText;
      datos = JSON.parse(datos1);    
      var data = google.visualization.arrayToDataTable(datos);

      var table = new google.visualization.Table(document.getElementById('tablainspecciones'));

      var cssClassNames = {
        'headerRow': 'header-row',
        'tableRow': 'table-row',
        'oddTableRow': 'odd-table-row',
        'selectedTableRow': 'selected-table-row',
        'hoverTableRow': 'hover-table-row',
        'headerCell': 'header-cell center color-gradient font15',
        'tableCell': 'table-cell left-text font12',
        'rowNumberCell': ''};
      var options = {
         width:"100%", 
         height: "100%",
         page: 'enable',
         pageSize: 6,
         pagingSymbols: {
          prev: 'Anterior',
          next: 'Siguiente'
         },
         pagingButtonsConfiguration: 'auto','cssClassNames': cssClassNames
      }
      table.draw(data, options);
   }

   function drawFlotaEstado(){
      var datos1 = $.ajax({
          url:url+'admin_webkm/reporteFlotaEstado'+"?"+$.now(),
          type:'post',
          dataType:'json',
          async:false       
      }).responseText;
      datos = JSON.parse(datos1);    
       var data = google.visualization.arrayToDataTable(datos);

       var options = {
         is3D:true,
         title: 'Estado de vehículos Brisas del maipo',
         sliceVisibilityThreshold:0,
         width: "100%",
         height: 240,
         chartArea:{
           left:10,
           right:10,
           bottom:10,
           top:30,
           width:"100%",
           height:"100%"
           },
           backgroundColor: '#00acc1',
           titleTextStyle: {color: '#FFF',
           fontName: 'Roboto',
           fontSize: '16', 
           fontWidth: 'normal',
           bold:false
           },
           legend: {textStyle: {fontSize: 12,bold:false,color:'#FFF',fontName: 'Roboto'}},
           tooltip:{textStyle:{fontSize:'13'}}
        };
        var chart = new google.visualization.PieChart(document.getElementById('flotaestado'));
        chart.draw(data, options); 
   }
   
   function drawFlotaEstadoTable(){
      var datos1 = $.ajax({
          url:url+'admin_webkm/reporteFlotaEstado'+"?"+$.now(),
          type:'post',
          dataType:'json',
          async:false       
      }).responseText;
      datos = JSON.parse(datos1);    
      var data = google.visualization.arrayToDataTable(datos);

      var table = new google.visualization.Table(document.getElementById('flotaestadotable'));

      var cssClassNames = {
                    'headerRow': 'header-row',
                    'tableRow': 'table-row',
                    'oddTableRow': 'odd-table-row',
                    'selectedTableRow': 'selected-table-row',
                    'hoverTableRow': 'hover-table-row',
                    'headerCell': 'header-cell center color-gradient font15',
                    'tableCell': 'table-cell left-text font12',
                    'rowNumberCell': ''};
      var options = {
       is3D:true,
       title: 'Estado de vehículos',
       sliceVisibilityThreshold:0,
       width: "100%",
       height: 130,
       chartArea:{
         left:10,
         right:10,
         bottom:10,
         top:30,
         width:"100%",
         height:"100%"
         },
         backgroundColor: '#00acc1',
         titleTextStyle: {color: '#FFF',
         fontName: 'Roboto',
         fontSize: '16', 
         fontWidth: 'normal',
         bold:false
         },
         legend: {textStyle: {fontSize: 12,bold:false,color:'#FFF',fontName: 'Roboto'}},
         tooltip:{textStyle:{fontSize:'13'}},'cssClassNames': cssClassNames
      };
        table.draw(data, options);
   }

   function drawFlotaAsignados(){
     var datos1 = $.ajax({
        url:url+'admin_webkm/reporteFlotaAsignados'+"?"+$.now(),
        type:'post',
        dataType:'json',
        async:false       
     }).responseText;
     datos = JSON.parse(datos1);    
     var data = google.visualization.arrayToDataTable(datos);
     var options = {
         is3D:true,
         title: 'Vehículos asignados Brisas del maipo',
         sliceVisibilityThreshold:0,
         width: "100%",
         height: 240,
         chartArea:{
           left:10,
           right:10,
           bottom:10,
           top:30,
           width:"100%",
           height:"100%"
           },
           backgroundColor: '#00acc1',
           titleTextStyle: {color: '#FFF',
           fontName: 'Roboto',
           fontSize: '16', 
           fontWidth: 'normal',
           bold:false
           },
           legend: {textStyle: {fontSize: 12,bold:false,color:'#FFF',fontName: 'Roboto'}},
           tooltip:{textStyle:{fontSize:'13'}}
        };
      var chart = new google.visualization.PieChart(document.getElementById('flotaasignados'));
      chart.draw(data, options); 
   }

   function drawFlotaAsignadosTable (){
      var datos1 = $.ajax({
          url:url+'admin_webkm/reporteFlotaAsignados'+"?"+$.now(),
          type:'post',
          dataType:'json',
          async:false       
      }).responseText;
      datos = JSON.parse(datos1);    
      var data = google.visualization.arrayToDataTable(datos);

      var table = new google.visualization.Table(document.getElementById('flotaasignadostable'));


      var cssClassNames = {
                    'headerRow': 'header-row',
                    'tableRow': 'table-row',
                    'oddTableRow': 'odd-table-row',
                    'selectedTableRow': 'selected-table-row',
                    'hoverTableRow': 'hover-table-row',
                    'headerCell': 'header-cell center color-gradient font15',
                    'tableCell': 'table-cell left-text font12',
                    'rowNumberCell': ''};
      var options = {
       is3D:true,
       title: 'Vehículos asignados',
       sliceVisibilityThreshold:0,
       width: "100%",
       height: 130,
       chartArea:{
         left:10,
         right:10,
         bottom:10,
         top:30,
         width:"100%",
         height:"100%"
         },
         backgroundColor: '#00acc1',
         titleTextStyle: {color: '#FFF',
         fontName: 'Roboto',
         fontSize: '16', 
         fontWidth: 'normal',
         bold:false
         },
         legend: {textStyle: {fontSize: 12,bold:false,color:'#FFF',fontName: 'Roboto'}},
         tooltip:{textStyle:{fontSize:'13'}},'cssClassNames': cssClassNames
      };
        table.draw(data, options);
   }

   function drawPagosMontos(){
     
      var datos1 = $.ajax({
        url:url+'admin_webkm/getPagosmontosdata',
        type:'post',
        data:{"data":""},
        dataType:'json',
        async:false       
      }).responseText;
      datos = JSON.parse(datos1);    
                var data = google.visualization.arrayToDataTable(datos);
                var options = {   
                  colors: ['#366DDA', '#FF3333'],
                  backgroundColor: { fill: "#26a69a" },
                  titleTextStyle:{color:'#FFFFFF',fontSize:16,fontName:'Roboto',bold:false},
                    title: 'Proyectos Facturados',
                      is3D:true,
                     chartArea:{
                        left:20,
                        right:40,
                        bottom:10,
                        top:40,
                        width:"100%",
                        height:"100%"                      
                         }
                    ,hAxis: {
                        textStyle:{
                            color: '#FFFFFF',
                            opacity: 100,
                             fontSize: 12,fontName:'Roboto'
                          }
                    },legend:{textStyle:{fontSize:'15',fontName:'Roboto',color:'#FFFFFF'}}
                    ,tooltip:{textStyle:{fontSize:'15',fontName:'Roboto'}}
                };                
                var chart = new google.visualization.PieChart(document.getElementById('graficoDineroPagos'));
                chart.draw(data, options);
   }

   function drawPagosFacturas(){
      
        var datos1 = $.ajax({
          url:url+'admin_webkm/getPagosproyectosdata',
          type:'post',
          data:{"data":""},
          dataType:'json',
          async:false       
        }).responseText;
        datos = JSON.parse(datos1);    
                  var data = google.visualization.arrayToDataTable(datos);                
                  var options = {   
                    colors: ['#00796b', '#4ED857'],
                    backgroundColor: { fill: "#26a69a" },
                    titleTextStyle:{color:'#FFFFFF',fontSize:16,fontName:'Roboto',bold:false},
                      title: 'Proyectos Facturados',
                       chartArea:{
                          left:50,
                          right:70,
                          bottom:30,
                          top:40,
                          width:"100%",
                          height:"100%"
                           }
                      ,hAxis: {
                          textStyle:{
                              color: '#FFFFFF',
                              opacity: 100,
                               fontSize: 12,fontName:'Roboto'
                            }
                      },vAxis: {title:'N° Proyectos',
                       titleTextStyle:{color:'#FFFFFF',fontName:'Roboto'},
                          textStyle:{
                              color: '#FFFFFF',
                              opacity: 100,fontName:'Roboto'
                            }
                      },legend: 'none'
                      ,tooltip:{textStyle:{fontSize:'15',fontName:'Roboto'}}
                  };
                  
                  var chart = new google.visualization.ColumnChart(document.getElementById('graficoPagosFacturas'));
                  chart.draw(data, options);
   }

   function drawTotalIgresos(){
      
        var datos1 = $.ajax({
          url:url+'admin_webkm/getCantidadingresosdata',
          type:'post',
          data:{"data":""},
          dataType:'json',
          async:false       
        }).responseText;
        datos = JSON.parse(datos1);    
                  var data = google.visualization.arrayToDataTable(datos);
                   var options = {

                    backgroundColor: { fill: "#00acc1" },
                    titleTextStyle:{color:'#FFFFFF',fontSize:16,fontName:'Roboto',bold:false},
                      title: 'Total de Ingresos Brisas del maipo',
                       chartArea:{
                          left:50,
                          right:70,
                          bottom:30,
                          top:40,
                          width:"100%",
                          height:"100%"
                           }
                      ,hAxis: {
                          textStyle:{
                              color: '#FFFFFF',
                              opacity: 100,
                               fontSize: 12,fontName:'Roboto'
                            }
                      },vAxis: {title:'N° Ingresos',
                       titleTextStyle:{color:'#FFFFFF',fontName:'Roboto'},
                          textStyle:{
                              color: '#FFFFFF',
                              opacity: 100,fontName:'Roboto'
                            }
                      },legend: 'none'
                      ,tooltip:{textStyle:{fontSize:'15',fontName:'Roboto'}}
                  };

                   var cssClassNames = {
                      'headerRow': 'header-row',
                      'tableRow': 'table-row',
                      'oddTableRow': 'odd-table-row',
                      'selectedTableRow': 'selected-table-row',
                      'hoverTableRow': 'hover-table-row',
                      'headerCell': 'header-cell center color-gradient font15',
                      'tableCell': 'table-cell left-text font12',
                      'rowNumberCell': ''};

                  
                  var chart = new google.visualization.AreaChart(document.getElementById('graficoControlIngresos'));
                  chart.draw(data, options);
                   var table = new google.visualization.Table(document.getElementById('tablaControlIngresos'));
          table.draw(data, {showRowNumber: true, width: '100%', height: '100%','cssClassNames': cssClassNames});
   }

   function drawTotalSalidas(){
      
        var datos1 = $.ajax({
          url:url+'admin_webkm/getCantidadsalidasdata',
          type:'post',
          data:{"data":""},
          dataType:'json',
          async:false       
        }).responseText;
        datos = JSON.parse(datos1);    
                  var data = google.visualization.arrayToDataTable(datos);
                  var options = {
                    backgroundColor: { fill: "#00acc1" },
                    titleTextStyle:{color:'#FFFFFF',fontSize:16,fontName:'Roboto',bold:false},
                      title: 'Total de Salidas Brisas del maipo',
                       chartArea:{
                          left:50,
                          right:70,
                          bottom:30,
                          top:40,
                          width:"100%",
                          height:"100%"
                           }
                      ,hAxis: {
                          textStyle:{
                              color: '#FFFFFF',
                              opacity: 100,
                               fontSize: 12,fontName:'Roboto'
                            }
                      },vAxis: {title:'N° Salidas',
                       titleTextStyle:{color:'#FFFFFF'},
                          textStyle:{
                              color: '#FFFFFF',
                              opacity: 100,fontName:'Roboto'
                            }
                      },legend: 'none'
                      ,tooltip:{textStyle:{fontSize:'15',fontName:'Roboto'}}
                  }; 
                  var cssClassNames = {
                      'headerRow': 'header-row',
                      'tableRow': 'table-row',
                      'oddTableRow': 'odd-table-row',
                      'selectedTableRow': 'selected-table-row',
                      'hoverTableRow': 'hover-table-row',
                      'headerCell': 'header-cell center color-gradient font15',
                      'tableCell': 'table-cell left-text font12',
                      'rowNumberCell': ''};
                  
                             
                  var chart = new google.visualization.AreaChart(document.getElementById('graficoControlSalidas'));
                  chart.draw(data, options);
                  var table = new google.visualization.Table(document.getElementById('tablaControlSalidas'));
            table.draw(data, {showRowNumber: true, width: '100%', height: '100%','cssClassNames': cssClassNames});        
   }

   function ValoresBolsa1(){ 
      $.ajax({
            cache:false,
            url:"getBolsaValores"+"?"+$.now(),           
            type:"GET",
            beforeSend:function(){
              //alert("cargando");
            },
            success:function(data){
              json = JSON.parse(data);
                var valordolar = json.dolar;
                var valoreuro = json.euro;
                var valoruf = json.uf;
                var valorutm = json.utm;
                var actualizacion = json.fecha;

                var sdolar = json.dolare;
                var seuro = json.euroe;
                var suf = json.ufe;
                var sutm = json.utme;

                if(sdolar == '+'){$('#sdolar1').html('↑');}
                    else if(sdolar == '-'){$('#sdolar1').html('↓');}
                if(seuro == '+'){$('#seuro1').html('↑');}
                     else if(seuro == '-'){$('#seuro1').html('↓');}
                if(suf == '+'){$('#suf1').html('↑');}
                     else if(suf == '-'){$('#suf1').html('↓');}
                if(sutm == '+'){$('#sutm1').html('↑');}
                     else if(sutm == '-'){$('#sutm1').html('↓');}

                $('#dolar1').html("<b>"+valordolar+"</b>");
                $('#euro1').html("<b>"+valoreuro+"</b>");
                $('#uf1').html("<b>"+valoruf+"</b>");
                $('#utm1').html("<b>"+valorutm+"</b>");
                $('#valorhora1').html("<b>"+actualizacion+"</b>");
              },
            error:function(){
              alert("error");
            }
    });
}

   //create trigger to resizeEnd event     
   /*   $(window).resize(function() {
      if(this.resizeTO) clearTimeout(this.resizeTO);
      this.resizeTO = setTimeout(function() {
          $(this).trigger('resizeEnd');
      }, 1);
    });*/
 
   //redraw graph when window resize is completed  
   /*$(window).on('resizeEnd',function() {
      drawPagosMontos();
      drawPagosFacturas();
      drawTotalIgresos();
      drawTotalSalidas();
      drawAsis();
      drawAsisTable();
      drawInspecciones();
      drawInspeccionesTable();
      drawFlotaEstado();
      drawFlotaEstadoTable();
      drawFlotaAsignados();
      drawFlotaAsignadosTable();  
   });*/
</script>
<style type="text/css"> 
  .bold-font {
    font-weight: bold;
  }
  .font12{
    font-size: 12px;
  }
   .font15{
    font-size: 15px;
  }
  .font17{
    font-size: 17px;
  }
  .left-text {
    text-align: left;
  }
  .color-gradient{      
    background: #b8e2f6; 
    background: -moz-linear-gradient(top,  #b8e2f6 1%, #b6dffd 19%, #d8f0fc 99%); 
    background: -webkit-linear-gradient(top,  #b8e2f6 1%,#b6dffd 19%,#d8f0fc 99%);
    background: linear-gradient(to bottom,  #b8e2f6 1%,#b6dffd 19%,#d8f0fc 99%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b8e2f6', endColorstr='#d8f0fc',GradientType=0 ); 
  }
  .font-white{
    color:white;
  }
  .valordivisas{
    padding: 5px 5px;text-align: center;
  }
  .botonCard{
    position: absolute;top: 0;right: 0;margin-right: 5px;margin-top: 5px;
  }
</style>

<section class="main" id="main">
<div class="container">
<div class="row">

 <!-- TARJETAS-->

      <div class="col s12 col m6 col l3">
        <div class="card card-visitas waves-effect waves-block waves-light">
          <div class="card-content blue-grey white-text white-text">
              <p class="card-title">
              <span id="weather"></span>
              </p>
             <p> <span class="region"></span></p>
          </div>
          <div class="card-action blue-grey darken-2">
             <p><span class="estadotiempo"></span></p>   
          </div>
        </div>
      </div>

      <!--TESTESET -->
      <div class="col s12 col m6 col l3">
           <div class="card  waves-effect waves-block waves-light">
              <div class="card-content pink lighten-1 white-text" style="padding:4px;">
              <p class="card-stats-title " style="text-align: center;font-size: 16px;"><i class="mdi-editor-attach-money"></i>Divisas</p>
                    <table>
                        <tr>
                            <td class="valordivisas font12" style="white-space: nowrap;width: 25%;padding: 0px;"><i id="sdolar1"></i>  Dolar</td>
                            <td class="valordivisas font12" style="white-space: nowrap;width: 25%;padding: 0px;"><i id="seuro1"></i>  Euro</td>
                            <td class="valordivisas font12" style="white-space: nowrap;width: 25%;padding: 0px;"><i id="suf1"></i>  UF</td>
                            <td class="valordivisas font12" style="white-space: nowrap;width: 25%;padding: 0px;"><i id="sutm1"></i>  UTM</td>       
                        </tr>
                        </table>   
            </div>
            <div class="card-action  pink darken-2"  style="padding: 0px;">
                   <div id="invoice-line" class="center-align font-white">
                        <table>
                            <tr>
                              <td class="valordivisas" style=" width: 25%;padding:0px;"><label class="font-white " id="dolar1"></label></td>
                              <td class="valordivisas" style=" width: 25%;padding:0px;"><label class="font-white " id="euro1"></label></td>
                              <td class="valordivisas" style=" width: 25%;padding:0px;"><label class="font-white " id="uf1" ></label></td>
                              <td class="valordivisas" style=" width: 25%;padding:0px;"><label class="font-white " id="utm1"></label></td>
                           </tr>            
                        </table>

                   </div>
            </div>
          </div>
      </div>


      <div class="col s12 col m6 col l3">
        <div class="card card-visitas waves-effect waves-block waves-light">
            <div class="card-content green white-text">
                <p class="card-title">
                <i class="mdi-social-group-add"></i> Visitas
                </p>
                <p><span class="visitas_cont_mes"></span> este mes</p>
            </div>
            <div class="card-action green darken-2">
                 <p>
                 <span class="visitas_cont_dia"></span> hoy
                 </p>
            </div>
        </div>
      </div>

      <div class="col s12 col m6 col l3">
        <div class="card card-visitas waves-effect waves-block waves-light">
          <div class="card-content purple white-text">
              <p class="card-title">
              <i class="mdi-social-group-add"></i> Usuarios
              </p>
             <p> <span class="nuevos_usuarios_totales"></span> totales</p>
          </div>
          <div class="card-action purple darken-2">
             <p><span class="nuevos_usuarios_mes"></span> este mes</p>   
          </div>
        </div>
      </div>
  

 <!-- GRAFICO ASISTENCIA -->
  
      <div class="col s12 m6 l6">
        <div class="card hoverable waves-effect waves-block waves-light" style="background-color:#009688;">
          <div class="card-image waves-effect waves-block waves-light">
           <span class="card-title activator grey-text text-darken-4"></span>
          </div>

          <div class="card-content">
            <a style="background-color:#00acc1;" data-tooltip="Ver Tabla"  data-position="right" class="tooltipped btn-floating btn-move-up waves-effect waves-light darken-2 right"><i class="mdi-content-add activator"></i></a>
            <div id="asistencia"></div>
          </div>

          <div class="card-reveal">
          <p><span class="tooltipped card-title grey-text text-darken-4" data-tooltip="Ver Grafico"  data-position="right" ><i class="material-icons right">close</i> Volver a grafico</span></p>
           <p><div id="tablaasistencia"></div></p>
          </div>

        </div>
      </div>

 <!-- GRAFICO INSPECCIONES-->
      <div class="col s12 m6 l6">
        <div class="card hoverable waves-effect waves-block waves-light" style="background-color:#009688;">
          <div class="card-image waves-effect waves-block waves-light">
           <span class="card-title activator grey-text text-darken-4"></span>
          </div>

          <div class="card-content">
            <a style="background-color:#00acc1;" data-tooltip="Ver Tabla"  data-position="left" class="tooltipped btn-floating btn-move-up waves-effect waves-light darken-2 right"><i class="mdi-content-add activator"></i></a>
            <div id="inspecciones"></div>
          </div>

          <div class="card-reveal">
          <p><span class="card-title grey-text text-darken-4"  ><i class="tooltipped material-icons right" data-tooltip="Ver Grafico"  data-position="bottom">close</i> Volver a grafico</span></p>
           <p><div id="tablainspecciones"></div></p>
          </div>

        </div>
      </div>


 <!-- GRAFICOS FLOTA-->

      <div class="col s12 m6 l6">
        <div class="card hoverable waves-effect waves-block waves-light" style="background-color:#00acc1 ;">
          <div class="card-image waves-effect waves-block waves-light">
           <span class="card-title activator grey-text text-darken-4"></span>
          </div>

          <div class="card-content">
            <a style="background-color:teal;" data-tooltip="Ver Tabla"  data-position="right" class="tooltipped btn-floating btn-move-up waves-effect waves-light darken-2 right"><i class="mdi-content-add activator"></i></a>
            <div id="flotaestado"></div>
          </div>

          <div class="card-reveal">
          <p><span class="tooltipped card-title grey-text text-darken-4" data-tooltip="Ver Grafico"  data-position="right" ><i class="material-icons right">close</i> Volver a grafico</span></p>
           <p><div id="flotaestadotable"></div></p>
          </div>

        </div>
      </div>
      <div class="col s12 m6 l6">
        <div class="card hoverable waves-effect waves-block waves-light" style="background-color:#00acc1;">
          <div class="card-image waves-effect waves-block waves-light">
           <span class="card-title activator grey-text text-darken-4"></span>
          </div>

          <div class="card-content">
            <a style="background-color:teal;" data-tooltip="Ver Tabla"  data-position="left" class="tooltipped btn-floating btn-move-up waves-effect waves-light darken-2 right"><i class="mdi-content-add activator"></i></a>
            <div id="flotaasignados"></div>
          </div>

          <div class="card-reveal">
          <p><span class="card-title grey-text text-darken-4"  ><i class="tooltipped material-icons right" data-tooltip="Ver Grafico"  data-position="bottom">close</i> Volver a grafico</span></p>
           <p><div id="flotaasignadostable"></div></p>
          </div>

        </div>
      </div>



         <!-- draw montos-->
      <div class="col s12 m6 l6">
         <div class="card">
                <div >        
                        <div id="graficoDineroPagos" class="waves-effect waves-block waves-light"></div>        
                </div>              
          </div>    
     </div>    
    <!-- draw n° facturados vs otros -->
      <div class="col s12 m6 l6">
           <div class="card">
              <div>        
                      <div id="graficoPagosFacturas"  class="waves-effect waves-block waves-light"></div>          
              </div>
        </div>    
     </div>
   

    <!-- draw total ingresos -->
      <div class="col s12 m6 l6">
          <div class="card">
              <div>        
                     <div id="graficoControlIngresos" style="padding: 0px;"  class="waves-effect waves-block waves-light"></div>
                      <a class="btn-floating btn-medium btn activator teal botonCard" title="Ver Tabla" ><i class="material-icons">view_list</i></a>  
              </div>         
              <div class="card-reveal" style="padding: 0px;">
                      <a class="btn-floating btn-medium btn card-title teal botonCard" title ="Ver Grafico" ><i class="material-icons ">assessment</i></a>                
                     <div id="tablaControlIngresos" style="padding: 0px;"></div>
              </div>
        </div>    
     </div>
    <!-- draw total salidas -->
      <div class="col s12 m6 l6">
           <div class="card">
              <div >        
                     <div id="graficoControlSalidas" style="padding: 0px;"  class="waves-effect waves-block waves-light"></div>
                      <a class="btn-floating btn-medium btn activator teal botonCard" title="Ver Tabla"><i class="material-icons">view_list</i></a>  
              </div>         
              <div class="card-reveal" style="padding: 0px;">
                      <a class="btn-floating btn-medium btn card-title teal botonCard" title ="Ver Grafico"><i class="material-icons ">assessment</i></a>                
                     <div id="tablaControlSalidas"   style="padding: 0px;"></div>
              </div>
        </div>      
    </div>
</div>
</section>

