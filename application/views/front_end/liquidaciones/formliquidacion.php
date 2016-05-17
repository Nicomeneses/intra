<style type="text/css">
  .card-panel {
      padding: 7px !important;
  }
</style>
<script type="text/javascript">
  $(function(){
      
/*    $("#nombre").val("Ricardo Antonio Hernández Espinoza");
    $("#anio").val("2016");
    $("#mes").val("04");
    $("#rut").val("169868220");
    $("#area").val("Informatica");
  
*/
  $('#formcrear').submit(function(){

        var img = $('#userfile').val(); 
        var nombre = $('#nombre').val(); 
        var rut = $('#rut').val(); 
        var area = $('#area').val();   
        var d = new Date(); 
        var mes = $('#mes').val(); 
        var anio = $('#anio').val(); 
        var mesactual = d.getMonth()+1;
        var anioactual = d.getFullYear();

        if(mes!="10"){
           mesf=mes.replace('0', '');
         }else{
           mesf=mes;
         }
        if(parseInt(mesf)!="" && parseInt(anio)!=""){
          if(parseInt(mesf)>parseInt(mesactual) || parseInt(anio)>parseInt(anioactual)){
           $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>Fecha inválida.</div>");
           return false;
          }
        }
        
        if(img==""){
          $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>Debe ingresar el archivo.</div>");
          return false;
        }if(nombre==""){
          $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>Debe ingresar el nombre.</div>");
          return false;
        }if(rut==""){
          $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>Debe ingresar el rut.</div>");
          return false;
        }if(area==""){
          $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>Debe ingresar el area.</div>");
          return false;
        }if(mes==""){
          $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>Debe ingresar el mes.</div>");
          return false;
        }if(anio==""){
          $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>Debe ingresar el anio.</div>");
           return false;
        }

      var formElement = document.querySelector("#formcrear");
      var formData = new FormData(formElement);

      $.ajax({
          url: "existeLiqu"+"?"+$.now(),   
          type: 'POST',
          data: formData,
          cache: false,
          processData: false,
          dataType: "json",
          contentType : false,
          beforeSend:function(){
            $(".liqu-validador").html('<div class="progress"><div class="indeterminate"></div></div>');
          },
          success: function (data) {
            if(data.res=="si"){
              if(confirm("¿Esta liquidación ya existe, desea sobreescribirla?")){
                 $.ajax({
                    url: $('.formcrear').attr('action')+"?"+$.now(),  
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    contentType : false,
                    beforeSend:function(){
                      $(".liqu-validador").html('<div class="progress"><div class="indeterminate"></div></div>');
                    },
                    success: function (data) {
                      if(data.res=="ok"){
                          $(".liqu-validador").html("<div class='card-panel white-text teal lighten-3'><center>"+data.msg+"</center></div>");
                      }else{
                         $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>"+data.msg+"</center></div>");
                      }
                    }
                });
              }
            $(".liqu-validador").html("");
            }else{
               $.ajax({
                    url: $('.formcrear').attr('action')+"?"+$.now(),  
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    contentType : false,
                    beforeSend:function(){
                      $(".liqu-validador").html('<div class="progress"><div class="indeterminate"></div></div>');
                    },
                    success: function (data) {
                      if(data.res=="ok"){
                          $(".liqu-validador").html("<div class='card-panel white-text teal lighten-3'><center>"+data.msg+"</center></div>");
                      }else{
                         $(".liqu-validador").html("<div class='card-panel white-text red darken-3'><center>"+data.msg+"</center></div>");
                      }
                    }
                });
            }
          }
      });

    return false;  

  });

    $("#nombre").bind('input', function () {
      window.checkDatalist(this);
    });

    window.checkDatalist = function(ele){
    var datalist=$(".datalistnombre");
    var nombre=$("#nombre").val();
      $.ajax({
              cache:false,
              url:"datalistnombreliqu"+"?"+$.now(),
              data: {'nombre': nombre},
              type:"POST",
              success:function(data){
               datalist.empty();
               datalist.append(data);
               $.ajax({
                url:"getDataDatalist"+"?"+$.now(),
                data: {'nombre': nombre},
                type:"POST",
                dataType: "json",
                success:function(data2){
                  if(data2.res="ok"){
                     $("#area").val(data2.area); 
                     $("#rut").val(data2.rut);
                  }
                }
                });
              },
              error:function(){
                 alert("Error accediendo a la base de datos, intente más tarde");
              }
      });
      datalist.empty();
    }
  });
</script>

<div class="cont_form_liqu">
  <?php echo form_open_multipart('ingresarLiquidacion', array('id'=>'formcrear','class'=>'formcrear')); ?>
  <div class="row">
   <div class="col l12">

   <div class="row">
      <div class="input-field col s4 m4 l6">
       <i class="material-icons prefix">mode_edit</i>
        <input id="nombre" name="nombre" type="text"  list="datalistnombre"> 
        <datalist id="datalistnombre" class="datalistnombre"></datalist>
        <label for="titulo">Nombre</label>
      </div>
      
       <div class="input-field col s4 m4 l3">
        <input id="rut" name="rut" type="text" placeholder="Rut" readonly> 
      </div>

       <div class="input-field col s4 m4 l3">
        <input id="area" name="area" type="text" placeholder="&Aacute;rea" readonly> 
      </div>
    </div>
    
    <div class="row">
      <div class="divider" style="margin-bottom:15px;margin-top:15px;"></div>
    </div>

    <div class="row">
       <div class="input-field col s4 m4 l3">  
        <select id="mes" name="mes" class="browser-default">
        <option value="" selected="">Mes</option>
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
        </select>
     </div>
<?php 
  $time = strtotime("-1 year", time());
  $anio_anterior = date("Y", $time);
?>
     <div class="input-field col s4 m4 l3">  
      <select id="anio" name="anio" class="browser-default">
       <option value="" selected="">A&ntilde;o</option>
       <option value="<?php echo $anio_anterior;?>"><?php echo $anio_anterior;?></option>
       <option value="<?php echo date("Y")?>"><?php echo date("Y")?></option>
       </select>
     </div>

      <div class="file-field input-field col s4 m4 l6">  
        <div class="btn">
          <span>Im&aacute;gen (JPG, PNG, PDF)</span>
          <input type="file" name="userfile" id="userfile" class="userfile">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text"  id="string_file" class="string_file" name="string_file">
        </div>
      </div>
    </div>


    <div class="row">
      <div class="divider" style="margin-bottom:15px;margin-top:15px;"></div>
    </div>
    

    <div class="row">
    <div class="col l8 offset-l2">
      <div class="liqu-validador"></div>
    </div>
    </div>
    
    <div class="row">
    <div class="input-field col s12 m12 l12">  
    <center>
       <button class="btn waves-effect waves-light"  type="submit">Ingresar
       <i class="material-icons right">send</i>
      </button>
   </center>
    </div>
   </div>
   </div>
  </div>
 <?php echo form_close();?>  
</div>