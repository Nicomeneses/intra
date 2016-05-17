<?php  if($this->session->userdata("rutUsuario")){redirect("inicio");}?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="">
<meta name="author" content="">

<title><?php echo $titulo?></title>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/normalize.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/materialize.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/estilos.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/animate.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/front_end/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/materialize.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css" media="screen">
  @font-face {
    font-family: ubuntu;
    src: url(Ubuntu-R.ttf) format("truetype");
  }
  article,body,footer,header,nav,section {
    font-family: ubuntu;
  }
  .container {
    font-family: ubuntu;
  }
  body{
    outline: 0;
    background-color: #000;
  }

  .login{
    background-color:#fff;
    border-radius:4px;
  }
  .cont_login{
     display: flex;
      justify-content: center;
      align-content: center;
      flex-direction: column;
  }
  form{
    padding:20px 30px 20px 30px;
    border-radius:4px;
  }
  .validacion{
    font-size:15px;
  }
  .card-panel{
    padding:10px;
  }
  blockquote{
    padding:0;
    margin:0;
  }
  .modal {
    width: 48%;
  }
  .modal .modal-footer .btn, .modal .modal-footer .btn-large, .modal .modal-footer .btn-flat {
   float:none;
  }
</style>
<script type="text/javascript">
  $(function(){
    $('.modal-trigger').leanModal();
    $('#formlog').submit(function(e){
        var formElement = document.querySelector("#formlog");
        var formData = new FormData(formElement);
        data: formData;

        $.ajax({
            url: $('#formlog').attr('action')+"?"+$.now(),
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            dataType: "json",
            contentType : false,
            beforeSend: function(){
              //$(".before").fadeIn(500); 
              //$("#cargarmas").hide();   
            },
            success:function(data){
              //var json = JSON.parse(data);

              if(data.respuesta == "ok"){    
                $(".validacion").hide();       
                $(".validacion").html("<div class='row'><div class='card-panel white-text teal lighten-2'><center>Ingresando al Sistema...</center></div></div>");
                $(".validacion").fadeIn(1000);
                $("#recupera_pass").hide();

                var url2 = window.location.href;  
                part=url2.split("/");
                cont=(part.length)-1;
                if(part[cont]=="vacaciones#solicitudes_jefe"){
                   setTimeout(function(){location.href='<?php echo base_url()?>vacaciones#solicitudes_jefe';} , 500); 
                }else{
                    setTimeout(function(){location.href='<?php echo base_url()?>inicio';} , 500); 
                }

              $(".btn_submit").html('<div class="preloader-wrapper active">'
               + '<div class="spinner-layer spinner-green-only">'
               + '<div class="circle-clipper left">'
               + '<div class="circle"></div>'
               + '</div><div class="gap-patch">'
               + '<div class="circle"></div>'
               + '</div><div class="circle-clipper right">'
               + '<div class="circle"></div></div></div></div>');  
              }else if(data.respuesta == "nouser"){
                $(".validacion").hide();
                $(".validacion").html("<div class='card-panel white-text red darken-3'><center><blockquote>El usuario ingresado no existe.<br>Contactar a administrador.web@km-telecomunicaciones.cl</blockquote></center></div>");
                $(".validacion").fadeIn(1000);
              }else if(data.respuesta == "vacios"){
                $(".validacion").hide();
                $(".validacion").html("<div class='card-panel white-text red darken-3'><center><blockquote>Debe ingresar usuario y contrase&ntilde;a.</blockquote></center></div>");
                $(".validacion").fadeIn(1000);
              }else if(data.respuesta == "invalidpass"){
                $(".validacion").hide();
                $(".validacion").html("<div class='card-panel white-text red darken-3'><center><blockquote>Contrase&ntilde;a Incorrecta.<br>Contactar a administrador.web@km-telecomunicaciones.cl</blockquote></center></div>");
                $(".validacion").fadeIn(1000);
              }else{
                $(".validacion").hide();
                $(".validacion").html("<div class='card-panel white-text red darken-3'><center><blockquote>Error, Intente nuevamente.</blockquote></center></div>");
                $(".validacion").fadeIn(1000);
              }

            },
            error:function(data){
              alert("No se puede acceder a la base de datos, Intente nuevamente.");
            }
        });
        return false;
      });

  $('#recuperarpass').submit(function(){

  var formElement = document.querySelector("#recuperarpass");
  var formData = new FormData(formElement);
      $.ajax({
          url: $('.recuperarpass').attr('action')+"?"+$.now(),  
          type: 'POST',
          data: formData,
          cache: false,
          processData: false,
          dataType: "json",
          contentType : false,
          success: function (data) {
         
          if(data.res == 1){    
                $(".validacion-rut").hide();       
                $(".validacion-rut").html("<div class='row'><div class='card-panel white-text teal lighten-2'><center>Nueva contrase&ntilde;a enviada a su correo.</center></div></div>");
                $(".validacion-rut").fadeIn(1000);
                  //setTimeout(function(){window.location='<?php echo base_url()?>inicio'} , 4000); 
              }else if(data.res == 2){
                $(".validacion-rut").hide();
                $(".validacion-rut").html("<div class='row'><div class='card-panel white-text red darken-3'><center><blockquote>El rut ingresado no esta registrado en la base de datos.</blockquote></center></div></div>");
                $(".validacion-rut").fadeIn(1000);
              }else if(data.res == 3){
                $(".validacion-rut").hide();
                $(".validacion-rut").html("<div class='row'><div class='card-panel white-text red darken-3'><center><blockquote>Error, Intente nuevamente.</blockquote></center></div></div>");
                $(".validacion-rut").fadeIn(1000);
              }
          }
         
      });
        return false;     
  });
  $(".usuario").keyup(function(event) {
    $(".rut").attr("value",$(this).val());
  });
 
  });
</script>
</head>

<body>
<section class="cont_login">
  <div class="container">

      <div class="row">
        <div class="col s12 col m8 offset-m2 col l6 offset-l3 login animated bounceInDown"> 
          <?php echo form_open(base_url()."loginval",array("id"=>"formlog","class" =>"formlog"));?>
          <div class="row">
          <center><h5>Inicio de Sesi&oacute;n</h5></center>

               <div class="validacion"> </div>

              <div class="input-field col s10 offset-s1">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" name="usuario" id="usuario" class="usuario validate">
                <label for="icon_prefix">Rut (Sin guiones ni puntos)</label>
              </div>
              <div class="input-field col s10 offset-s1">
                <i class="material-icons prefix">lock</i>
                <input id="icon_phonelink_lock" name="pass" id="password" type="password" class="password validate">
                <label for="icon_phonelink_lock">Contrase&ntilde;a</label>
              </div>
             
            <center><div class="input-field col s10 offset-s1 btn_submit">
             <button class="btn waves-effect waves-light" id="btn_log" type="submit">Ingresar
              <i class="material-icons right">send</i>
            </button>
            </div></center>

            <center><div class="input-field col s10 offset-s1">
                <a href="#modal1" id="recupera_pass" style="font-size:11px;" class="modal-trigger">
                 ¿ Olvid&oacute; su contrase&ntilde;a ?
                </a>  
            </div></center>
          </div>
         <?php echo form_close();?>
        </div>
      </div>
    </div>

     <div id="modal1" class="modal modalcorreo">
        <div class="modal-content">
          <center><h6>Recuperar Contrase&ntilde;a</h6></center>
       
           <div class="validacion-rut"></div>
        
           <?php echo form_open('recuperarpass', array('id'=>'recuperarpass','class'=>'recuperarpass')); ?>
       
            <div class="row">
              <div class="input-field col s12 l10 offset-l1">
                <i class="material-icons prefix">assignment_ind</i>
                <input id="icon_prefix" type="text" id="rut" name="rut" required class="validate rut">
              </div>
           </div>

        </div>
       <div class="modal-footer">
          <center><button class="btn waves-effect waves-light btn_submit_correo" type="submit">Enviar
            <i class="material-icons right">send</i>
          </button>
          <a class="btn waves-effect modal-close waves-light"> Cerrar</a>
          </center><br>
        </div>
        <?php echo form_close();?>
     </div>
</section>
</body>
</html>