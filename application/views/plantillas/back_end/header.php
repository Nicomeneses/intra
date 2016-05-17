<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo $titulo?></title>
<link href="<?php echo base_url();?>assets/back_end/css/normalize.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/prism.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/ghpages-materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/materialize.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/estilos.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/animate.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/footable.core.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/footable.standalone.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/tablematerialize.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/select2.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/back_end/css/loader.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/back_end/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/back_end/js/loader.js" charset="UTF-8"></script>
<script src="<?php echo base_url();?>assets/back_end/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/back_end/js/materialize.min.js"></script>
<script src="<?php echo base_url();?>assets/back_end/js/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/back_end/js/footable.js"></script>
<script src="<?php echo base_url();?>assets/back_end/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/back_end/js/rut.js"></script>
<script src="<?php echo base_url();?>assets/back_end/js/jquery.simpleWeather.min.js"></script>
</head>

<body id="body">
<div id="loader-wrapper">
  <div  id="loader" ></div>        
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div> 
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<header>
<div class="navbar-fixed">
  <nav class="">
    <div class="container">
      <div class="nav-wrapper">
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

          <ul class="left">
            <a href="#!" class="brand-logo"><img src="<?php echo base_url();?>assets/back_end/images/logo.png" alt="" height="45px" width="165px"></a>
          </ul>
         <!--<select id="selectusuarios" style="width:100%!important;">
               <option value="">Ingrese nombre del usuario...</option>
            </select> -->

        <!--           <div class="header-search-wrapper">
            <div class="input-field busqueda">
              <input type="search" placeholder="Buscar usuario" required class="input-usuarios header-search-input z-depth-2">
              <label for="search"><i class="material-icons" style=" margin-top:-10px!important;">search</i></label>
              <i class="material-icons" style=" margin-top:-10px!important;" class="buscar_contacto">close</i>
            </div>
          </div> -->

          <ul class="right" class="">
           <li><a href="#!" onclick="toggleFullScreen()" class="waves-effect waves-block waves-light hide-on-med-and-down"><i class="mdi-action-settings-overscan"></i></a> </li>
          </ul>

      </div>
      </div>
    </nav>
  </div>
</header>

<div id="main">
  <div class="wrapper">
    <aside id="left-sidebar-nav">
      <ul style="width: 240px;" id="slide-out" class="side-nav fixed leftside-navigation ps-container ps-active-y">
       
        <li class="user-details cyan darken-2">
          <div class="row present">
              <div class="col s4 m4 l3">
                  <img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $imagen?>" alt="" class="circle responsive-img valign profile-image">
              </div>
              <div class="col s8 m8 l9">
               <p class="profile-text"><?php echo $this->session->userdata('nombresUsuario')." ".$this->session->userdata('apellidosUsuario');?>
               <p class="user-role"><?php echo $tipo?></p>
              </div>

          </div>
        </li> 
        <?php echo menu()?>
       
        <div class="divider"></div>
        <li><a href="<?php echo base_url();?>inicio" class="waves-effect waves-cyan"><i class="mdi-action-home"></i> Volver a Web KM</a></li>
        <li><a href="<?php echo base_url();?>unlogin"  class="waves-effect waves-cyan"><i class="mdi-navigation-arrow-drop-down-circle"></i> Cerrar Sesi&oacute;n</a></li>

     </ul>

       <ul class="side-nav" id="mobile-demo">
       
        <li class="user-details cyan darken-2" >
          <div class="row present">
              <div class="col col s4 m4 l3">
                  <img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $imagen?>" alt="" class="circle responsive-img valign profile-image">
              </div>
              <div class="col col s8 m8 l9">
               <p class="profile-text"><?php echo $this->session->userdata('nombresUsuario')." ".$this->session->userdata('apellidosUsuario');?>
               <p class="user-role"><?php echo $tipo?></p>
              </div>

          </div>
        </li> 
        <?php echo menu()?>
       
         <div class="divider"></div>
         <li><a href="<?php echo base_url();?>inicio" class="waves-effect waves-cyan"><i class="mdi-action-home"></i> Volver a Web KM</a></li>
         <li><a href="<?php echo base_url();?>unlogin"  class="waves-effect waves-cyan"><i class="mdi-navigation-arrow-drop-down-circle"></i> Cerrar Sesi&oacute;n</a></li>

        </ul>
    </aside>
  </div>
</div>
<script type="text/javascript">
$(function(){

/*  $.getJSON("admin_webkm/users", function (json) {
      $("#selectusuarios").select2({
         placeholder: 'Ingrese su busqueda...',
         data: json
      });
  });*/

/*$(".input-usuarios").change(function(event) {
  var rut=$(this).val();
   $.ajax({
          url: "admin_webkm/getUserData",  
          type: 'POST',
          data: {"rut":rut},
          cache: false,
          success: function (data) {
            var json = JSON.parse(data);
            if(json.res == "ok"){      
              for(datos in json.users) {
                fono_celular=json.users[datos].fono_celular;
                fono_casa=json.users[datos].fono_domicilio;
                fono_empresa=json.users[datos].celular_empresa;
                $(".res_telefonos1").html(fono_celular);
                if(fono_casa!="" && fono_casa!="no hay datos" && fono_casa!="no"){
                  $(".res_telefonos2").html("/"+fono_casa);$(".res_telefonos2").show();
                }else{
                  $(".res_telefonos2").html("");$(".res_telefonos2").hide();
                }

                if(fono_empresa!="" && fono_empresa!="no hay datos"  && fono_empresa!="no"){
                  $(".res_telefonos3").html("/"+fono_empresa);$(".res_telefonos3").show();
                }else{
                  $(".res_telefonos3").html("");$(".res_telefonos3").hide();
                }

                $(".res_correo").html(json.users[datos].correo);
                $(".res_area").html(json.users[datos].area);
                $(".res_ciudad").html(json.users[datos].sucursal);
                $(".res-buscador").show();


              }
             }else{
              alert("error");
             }
          }
        });
  });*/
  
});
</script>

<!-- MODAL BUSQUEDA-->
<!--   <div id="modal1" class="modal">
    <div class="modal-content" style="padding:5px;">
      <center><h5>Buscar usuario</h5></center>
      <div class="divider"></div>
        <div class="row">
         <div class="input-field col s12 l6 offset-l3">
        <select id="selectusuarios" style="width:100%!important;">
          <option value="">Ingrese nombre del usuario...</option>
        </select>
          </div>
         </div>
       <div class="divider"></div>
        <div class="row res-buscador"><br>
        <div class="col l12">
      <table class="centered res-buscador bordered">
          <thead>
            <tr>
                <th>Telefonos</th>
                <th>Correo</th>
                <th>&Aacute;rea KM</th>
                <th>Ciudad Laboral</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td>
              <span class="res_telefonos1"></span>
              <span class="res_telefonos2"></span>
              <span class="res_telefonos3"></span> 
            </td>
            <td><span class="res_correo"></span> </td>
            <td><span class="res_area"></span> </td>
            <td><span class="res_ciudad"></span> </td>
          </tr>
          </tbody>
        </table>
     </div>
         </div>
    </div>
    <div class="modal-footer">
     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
  </div> -->
