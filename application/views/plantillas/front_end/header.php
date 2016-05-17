<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo $titulo?></title>
<script src="<?php echo base_url();?>assets/front_end/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/select2.min.js"></script>
<link href="<?php echo base_url();?>assets/front_end/css/select2.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/materialize.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/estilos.css" rel="stylesheet">

<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/normalize.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/featherlight.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/featherlight.gallery.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/themes/default/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/nivo-lightbox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/tablematerialize.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/front_end/js/rut.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/materialize.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/featherlight.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/featherlight.gallery.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/nivo-lightbox.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/functions.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/wow.min.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<?php
$nombre=$this->session->userdata("nombresUsuario");
?>
<header>

<ul id="dropdown3" class="dropdown-content">
<li><a style="font-size:12px;" href="<?php echo base_url()?>changepass">Cambiar Contrase&ntilde;a</a></li>
<li class="divider"></li>
<li><a style="font-size:12px;" href="<?php echo base_url()?>unlogin">Cerrar Sesi&oacute;n</a></li>
</ul>

<ul id="dropdown6" class="dropdown-content">
<li><a style="font-size:12px;" href="<?php echo base_url()?>changepass">Cambiar Contrase&ntilde;a</a></li>
<li class="divider"></li>
<li><a style="font-size:12px;" href="<?php echo base_url()?>unlogin">Cerrar Sesi&oacute;n</a></li>
</ul>

<?php 
/***ADMINISTRADOR**/
if($this->session->userdata('tipo')==2 or $this->session->userdata('tipo')==3 or $this->session->userdata('tipo')==4){
?>
<ul id="dropdown7" class="dropdown-content">
<li><a style="font-size:12px;" href="<?php echo base_url()?>prevencionderiesgos">Prevenci&oacute;n de riesgos </a></li>
<li><a style="font-size:12px;" href="<?php echo base_url()?>operacionestecnicas">Operaciones t&eacute;cnicas</a></li>
</ul>
<?php
}
?>

<!-- MENU APLICACIONES-->
<?php 


/***ADMINISTRADOR**/
if($this->session->userdata('tipo')==2 or $this->session->userdata('tipo')==3 or $this->session->userdata('tipo')==4){
?>
<ul id="dropdown0" class="dropdown-content">
<li><a style="font-size:12px;" href="<?php echo base_url()?>prevencionderiesgos">Prevenci&oacute;n de riesgos </a></li>
<li><a style="font-size:12px;" href="<?php echo base_url()?>operacionestecnicas">Operaciones t&eacute;cnicas</a></li>
</ul>
<?php
}


/***ADMINISTRADOR**/
if($this->session->userdata('tipo')==3){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_acceso">Control de accesos</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/compras">Control Compras</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_pagos">Control Pagos</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_flota">Control Flota</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_instrumentos">Control de Instrumentos</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/flujologisticotecnicos">Flujo Log&iacute;stico</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/inspeccion_operaciones">Inspecci&oacute;n operaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/productividad/buscar">Productividad Operaciones</a></li>
</ul>
<?php
}



///FLOTA
if($this->session->userdata('rutUsuario')=="167909043" or $this->session->userdata('rutUsuario')=="122751597"){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_flota">Control Flota</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_acceso">Control de accesos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***SUPERVISORES**/
if($this->session->userdata('tipo')==2){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/inspeccion_operaciones">Inspecci&oacute;n operaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_flota">Control Flota</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_acceso">Control de accesos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***GESTION DE COMPRAS*/
if($this->session->userdata('perfil')=="compras"){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/compras">Control Compras</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***GESTION DE LOGISTICO*/
if($this->session->userdata('rutUsuario')=="122895319" or $this->session->userdata('rutUsuario')=="124644119" or $this->session->userdata('rutUsuario')=="167844413" or $this->session->userdata('rutUsuario')=="130896154" or $this->session->userdata('rutUsuario')=="133343091" or $this->session->userdata('rutUsuario')=="130643353" or $this->session->userdata('rutUsuario')=="174595674" or $this->session->userdata('rutUsuario')=="166222400" or $this->session->userdata('rutUsuario')=="189772718" or $this->session->userdata('rutUsuario')=="124644119" or $this->session->userdata('rutUsuario')=="122895319"){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/flujologisticotecnicos">Flujo Log&iacute;stico</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/productividad/buscar">Productividad Operaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}
 
/***GESTION DE PAGOS*/
if($this->session->userdata('rutUsuario')=="174895007"){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_pagos">Control Pagos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}


/**GESTION DE ACCESO*/
if($this->session->userdata('rutUsuario')=="185151654" or $this->session->userdata('rutUsuario')=="19097149k" or $this->session->userdata('rutUsuario')=="19097149K" or $this->session->userdata('rutUsuario')=="167909043" or $this->session->userdata('rutUsuario')=="122751597"){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_acceso">Control de accesos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***TODOS LOS USUARIOS**/
if($this->session->userdata('tipo')==1){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***TODOS LOS USUARIOS**/
if($this->session->userdata('tipo')==1){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}
?>
<!-- MENU MANTENEDORES-->

<?php
/*** ADMINISTRADOR**/
if($this->session->userdata('tipo')==3){
?>
<ul id="dropdown2" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios">Usuarios</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/admin_webkm/noticias">Noticias</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/areas">&Aacute;reas</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/cargos">Cargos</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/jefes">Jefaturas</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/proyectos">Proyectos</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/perfiles">Perfiles</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedord/valordia">Valor d&iacute;a</a></li>

</ul>
<?php
}
?>

<!--MENU APLICACIONES MOBILE-->

<?php

/***ADMINISTRADOR**/
if($this->session->userdata('tipo')==3){
?>
<ul id="dropdown4" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_acceso">Control de accesos</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/compras">Control Compras</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_pagos">Control Pagos</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_flota">Control Flota</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_instrumentos">Control de Instrumentos</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/flujologisticotecnicos">Flujo Log&iacute;stico</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/inspeccion_operaciones">Inspecci&oacute;n operaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/productividad/buscar">Productividad Operaciones</a></li>
</ul>
<?php
}



/***GESTION DE TECNICOS**/
if($this->session->userdata('rutUsuario')=="171220890"){
?>
<ul id="dropdown4" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_flota">Control Flota</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_instrumentos">Control  Instrumentos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}


/***SUPERVISORES**/
if($this->session->userdata('tipo')==2){
?>
<ul id="dropdown4" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/inspeccion_operaciones">Inspecci&oacute;n operaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/control_flota">Control Flota</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_acceso">Control de accesos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***GESTION DE COMPRAS**/

if($this->session->userdata('perfil')=="compras"){
?>
<ul id="dropdown4" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/compras">Control Compras</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***GESTION LOGISTICO*/
if($this->session->userdata('rutUsuario')=="122895319" or $this->session->userdata('rutUsuario')=="124644119" or $this->session->userdata('rutUsuario')=="167844413" or $this->session->userdata('rutUsuario')=="130896154" or $this->session->userdata('rutUsuario')=="133343091" or $this->session->userdata('rutUsuario')=="130643353" or $this->session->userdata('rutUsuario')=="174595674" or $this->session->userdata('rutUsuario')=="166222400" or $this->session->userdata('rutUsuario')=="189772718" or $this->session->userdata('rutUsuario')=="124644119" or $this->session->userdata('rutUsuario')=="122895319"){
?>
<ul id="dropdown4" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/flujologisticotecnicos">Flujo Log&iacute;stico</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/productividad/buscar">Productividad Operaciones</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***GESTION PAGOS*/
if($this->session->userdata('rutUsuario')=="174895007"){
?>
<ul id="dropdown4" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_pagos">Control Pagos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/**GESTION DE ACCESO*/
if($this->session->userdata('rutUsuario')=="185151654" or $this->session->userdata('rutUsuario')=="19097149k" or $this->session->userdata('rutUsuario')=="19097149K" or $this->session->userdata('rutUsuario')=="167909043" or $this->session->userdata('rutUsuario')=="122751597"){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>control_acceso">Control de accesos</a></li>
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

/***TODOS LOS USUARIOS**/
if($this->session->userdata('tipo')==1){
?>
<ul id="dropdown1" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="<?php echo base_url()?>liquidaciones">Liquidaciones</a></li>
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/asistencia/asistencia">Asistencia</a></li>
</ul>
<?php
}

?>
<!-- MENU MANTENEDORES-->

<?php
/*** ADMINISTRADOR**/
if($this->session->userdata('tipo')==3){
?>
<ul id="dropdown5" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios">Usuarios</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/admin_webkm/noticias">Noticias</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/areas">&Aacute;reas</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/cargos">Cargos</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/proyectos">Proyectos</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/perfiles">Perfiles</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/jefes">Jefaturas</a></li>
<li><a style="font-size:12px;" target="_blank" href="http://intranet.km-telecomunicaciones.cl/mantenedord/valordia">Valor d&iacute;a</a></li>
</ul>
<?php
}
?>

<?php
/***MENU JEFES**/
if($this->session->userdata('tipo')==2){
?>
<ul id="dropdown5" class="dropdown-content">
<li><a style="font-size:12px;" target="_blank"  href="http://intranet.km-telecomunicaciones.cl/flujologisticotecnicos">Flujo Log&iacute;stico</a></li>
</ul>
<?php
}


?>

<div class="navbar-fixed">
	<nav class="grey darken-4">
		<div class="container">
			<div class="nav-wrapper">
				<div class="logo">  
				<a id="logo-container" href="<?php echo base_url();?>inicio" class="brand-logo">
				<img src="<?php echo base_url();?>assets/imagenes/logo2.png"> 
				</a>
				</div>
				
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<!-- MENU ESCRITORIO-->
			<ul class="right hide-on-med-and-down">
				<li><a href="<?php echo base_url()?>inicio"><i class="material-icons left">store</i>Inicio</a></li>
				<?php 
				if ($this->session->userdata('tipo')=="2" or $this->session->userdata('tipo')=="3" or $this->session->userdata('tipo')=="4") {
					?>
				<li><a href="<?php echo base_url()?>admin_webkm/dashboard" target="_blank"><i class="material-icons left">dashboard</i>Dashboard</a></li>
				<li><a class="dropdown-button" href="#!" data-activates="dropdown0"><i class="material-icons left">library_books</i>Documentaci&oacute;n<i class="material-icons right">arrow_drop_down</i></a></li>
					<?php
				}
				?>

				<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">view_module</i>Aplicaciones<i class="material-icons right">arrow_drop_down</i></a></li>
				<?php 
				if($this->session->userdata('tipo')==3){
				?>
				<li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="material-icons left">dashboard</i>Mantenedores<i class="material-icons right">arrow_drop_down</i></a></li>
				<?php 
				}
				?>
				
				<li><a class="dropdown-button" href="#!" data-activates="dropdown3"><i class="material-icons left">perm_identity</i><i class="material-icons right">arrow_drop_down</i><?php echo $this->session->userdata("nombresUsuario")?></a></li>
			</ul>
			<!-- MENU MOVIL-->
			<ul class="side-nav" id="mobile-demo">
				<li><a href="<?php echo base_url()?>inicio"><i class="material-icons left">store</i>Inicio</a></li>
				<?php 
				if ($this->session->userdata('tipo')=="2" or $this->session->userdata('tipo')=="3" or $this->session->userdata('tipo')=="4") {
					?>
				<li><a href="<?php echo base_url()?>admin_webkm/dashboard" target="_blank"><i class="material-icons left">dashboard</i>Dashboard</a></li>
				<li><a class="dropdown-button" href="#!" data-activates="dropdown7"><i class="material-icons left">library_books</i>Documentaci&oacute;n<i class="material-icons right">arrow_drop_down</i></a></li>
					<?php
				}
				?>

				<li><a class="dropdown-button" href="#!" data-activates="dropdown4"><i class="material-icons left">view_module</i>Aplicaciones<i class="material-icons right">arrow_drop_down</i></a></li>
				<?php 
				if($this->session->userdata('tipo')==3){
				?>
				<li><a class="dropdown-button" href="#!" data-activates="dropdown5"><i class="material-icons left">dashboard</i>Mantenedores<i class="material-icons right">arrow_drop_down</i></a></li>
				<?php 
				}
				?>
				
				<li><a class="dropdown-button" href="#!" data-activates="dropdown6"><i class="material-icons left">perm_identity</i><i class="material-icons right">arrow_drop_down</i><?php echo $this->session->userdata("nombresUsuario")?></a></li>
			</ul>
			
			</div>
		</div>
	</nav>
</div> 
</header>

<!-- MODAL BUSQUEDA-->
	<div id="modal1" class="modal">
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
	</div>

