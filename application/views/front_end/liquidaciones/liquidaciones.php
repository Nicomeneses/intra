<style type="text/css" media="screen">
  .go_back:hover{
    cursor: pointer;
  }
  .section {
      padding-bottom: 0rem!important;
  }
  table.dataTable tbody td, table.dataTable tbody th {
      padding: 1px 2px!important;
  }
  table tfoot  input{
     height: 1.5rem!important;
  }
  input[type=search] {
    height: 1.5rem!important;
  }
  .tabs .tab {
      line-height: 55px !important;
  }
  .tabs {
      position: relative;
      height: 55px !important;
  }
  .row {
      margin-bottom: 0px!important;
  }
  .changepass_form{
   padding: 0px!important;
  }
  .changepass{
      margin-top: 0px!important;
     padding: 0px!important;
  }
  .container {
    width: 98%!important; 
  }
  .tabs{
    background-color: #eee;
    margin-bottom: 20px;
  }
  .tabs .tab a {
      text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
      color: rgba(0, 0, 0, 0.5);
      text-align: center;

  }
  .tabs .tab a:hover{
   color: rgba(0, 0, 0, 0.5)!important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  }

 .card-panel{
    padding:0px!important;
  }
  .changepass_form{
    padding: 0!important;
  }
  blockquote{
    padding: 10px;
  }
  .tabs .tab {
    text-transform: none;
    letter-spacing: .1px;
}
</style>
<script type="text/javascript">
  function goBack() {
      window.history.back()
  }
  $(function(){
  var loader=$(".loader").hide();
  var url="<?php echo base_url()?>";
  
   $(document).on('click', '.ingresar_liqu', function(event) {
    event.preventDefault();
     $.post(url+"formIngresarLiquidacion"+"?"+$.now(), function(data) {
       $("#ingresar_liqu").html(data);
      });
  });

   $.post(url+"misLiquidaciones"+"?"+$.now(), function(data) {
       $("#mis_liqu").html(data);
      });
   
  $(document).on('click', '.mis_liqu', function(event) {
    event.preventDefault();
     $.post(url+"misLiquidaciones"+"?"+$.now(), function(data) {
       $("#mis_liqu").html(data);
      });
  });


  $(document).on('click', '.listado_liqu', function(event) {
    event.preventDefault();
     $.post(url+"listadoLiquidaciones"+"?"+$.now(), function(data) {
       $("#listado_liqu").html(data);
      });
  });

  $(document).on('click', '.liqu_personal', function(event) {
    event.preventDefault();
     $.post(url+"liquidacionesPersonal"+"?"+$.now(), function(data) {
       $("#liqu_personal").html(data);
      });

     $(document).on('click', '.selector', function(event) {
       event.preventDefault();
       /* Act on the event */
     });
  });
  });
</script>

<section>
<div class="container">
<div class="section">
<div class="row">
<div class="col s12 m12 l12"> 
<div class="changepass z-depth-2">
   <div class="changepass_form">
     
    <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <?php 
        $tipo=$this->session->userdata('tipo');
        if($tipo==2 or $tipo==3 or $tipo==4){
          ?>
        <li class="tab col s3 ingresar_liqu"><a href="#ingresar_liqu">Subir liquidaci&oacute;n</a></li>
          <?php
        }
        ?>
        
        <?php 
        if($tipo==3){
          ?>
        <li class="tab col s3 listado_liqu"><a href="#listado_liqu">Liquidaciones</a></li>
          <?php
        }
        ?>

        <?php 
        if($tipo==2 or $tipo==3 or $tipo==4){
          ?>
          <li class="tab col s3 liqu_personal">
          <i class="normal material-icons go_back" style="float:left;margin-top:15px;margin-left:20px;" onclick="goForward()">fast_rewind</i>
          <a href="#liqu_personal">Liquidaciones de mi personal</a>
          </li>
          <?php
        }
        ?>
        <li class="tab col s3 mis_liqu"><a href="#mis_liqu" class="active">Mis liquidaciones</a></li>
      </ul>
    </div>

    <div class="row">
     <div class="loader">
      <div class="col l10 offset-l1">
        <div class="progress">
         <div class="indeterminate"></div>
        </div>
      </div>
      </div>
    </div>

    <div class="contenido_liqui">
    <div id="ingresar_liqu" class="col s12"></div>
    <div id="listado_liqu" class="col s12"></div>
    <div id="mis_liqu" class="col s12"></div>
    <div id="liqu_personal" class="col s12"></div>
    </div></div><br>

   </div>
</div> 
</div>
</div>
</div>
</div>
</section>
