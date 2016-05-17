<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method')){
 
       
    function menu(){
if(preg_match("/ /i",$_SERVER["REQUEST_URI"])){
	?>
   <li><a href="<?php echo base_url();?>admin_webkm/dashboard" class="active waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>
   <?php
    if($_SESSION["tipo"]==3){
      ?>
      <li><a href="<?php echo base_url();?>admin_webkm/noticias" class="waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Noticias</a></li>
      <li><a href="<?php echo base_url();?>admin_webkm/nacimientos" class="waves-effect waves-cyan"><i class="mdi-av-queue"></i> Nacimientos</a></li>
      <li><a href="<?php echo base_url();?>admin_webkm/comentarios" class="waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Comentarios</a></li>
      <li><a href="<?php echo base_url();?>admin_webkm/visitas" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert-circle"></i> Visitas</a></li>
      <?php
    }
   ?>
  <?php
	}
	elseif (preg_match("/dashboard\b/i",$_SERVER["REQUEST_URI"]) or preg_match("/home_admin\b/i",$_SERVER["REQUEST_URI"])) {
	?>
	   <li class="bold active"><a href="<?php echo base_url();?>admin_webkm/dashboard" class="active waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>
     <?php
    if($_SESSION["tipo"]==3){
      ?>
     <li><a href="<?php echo base_url();?>admin_webkm/noticias" class="waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Noticias</a></li>
     <li><a href="<?php echo base_url();?>admin_webkm/nacimientos" class="waves-effect waves-cyan"><i class="mdi-av-queue"></i> Nacimientos</a></li>
     <li><a href="<?php echo base_url();?>admin_webkm/comentarios" class="waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Comentarios</a></li>
     <li><a href="<?php echo base_url();?>admin_webkm/visitas" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert-circle"></i> Visitas</a></li>
     <?php
    }
   ?>
  <?php
  }
	elseif (preg_match("/noticias\b/i",$_SERVER["REQUEST_URI"])) {
	?>

	   <li><a href="<?php echo base_url();?>admin_webkm/dashboard" class="active waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>
      <?php
    if($_SESSION["tipo"]==3){
      ?>
     <li class="bold active"><a href="<?php echo base_url();?>admin_webkm/noticias" class="waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Noticias</a></li>
     <li><a href="<?php echo base_url();?>admin_webkm/nacimientos" class="waves-effect waves-cyan"><i class="mdi-av-queue"></i> Nacimientos</a></li>
     <li><a href="<?php echo base_url();?>admin_webkm/comentarios" class="waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Comentarios</a></li>
     <li><a href="<?php echo base_url();?>admin_webkm/visitas" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert-circle"></i> Visitas</a></li>
  <?php
    }
   ?>
  <?php
  }
    elseif (preg_match("/galeria\b/i",$_SERVER["REQUEST_URI"])) {
  ?>
  <li><a href="<?php echo base_url();?>admin_webkm/dashboard" class="active waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>
  <?php
    if($_SESSION["tipo"]==3){
      ?>
   <li class="bold active"><a href="<?php echo base_url();?>admin_webkm/noticias" class="waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Noticias</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/nacimientos" class="waves-effect waves-cyan"><i class="mdi-av-queue"></i> Nacimientos</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/comentarios" class="waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Comentarios</a></li>
   <?php
    }
   ?>
  <?php
  }
	elseif (preg_match("/nacimientos\b/i",$_SERVER["REQUEST_URI"] )){
  ?>
   <li><a href="<?php echo base_url();?>admin_webkm/dashboard" class="active waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>
   <?php
    if($_SESSION["tipo"]==3){
      ?>
   <li><a href="<?php echo base_url();?>admin_webkm/noticias" class="waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Noticias</a></li>
   <li class="bold active"><a href="<?php echo base_url();?>admin_webkm/nacimientos" class="waves-effect waves-cyan"><i class="mdi-av-queue"></i> Nacimientos</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/comentarios" class="waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Comentarios</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/visitas" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert-circle"></i> Visitas</a></li>
   <?php
    }
   ?>
  <?php
  }
  elseif (preg_match("/comentarios\b/i",$_SERVER["REQUEST_URI"] )){
  ?>
   <li><a href="<?php echo base_url();?>admin_webkm/dashboard" class="active waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>
   <?php
    if($_SESSION["tipo"]==3){
      ?>
   <li><a href="<?php echo base_url();?>admin_webkm/noticias" class="waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Noticias</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/nacimientos" class="waves-effect waves-cyan"><i class="mdi-av-queue"></i> Nacimientos</a></li>
   <li class="bold active"><a href="<?php echo base_url();?>admin_webkm/comentarios" class="waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Comentarios</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/visitas" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert-circle"></i> Visitas</a></li>
   <?php
      }
     ?>
    <?php
    }
    elseif (preg_match("/visitas\b/i",$_SERVER["REQUEST_URI"] )){
  ?>
   <li><a href="<?php echo base_url();?>admin_webkm/dashboard" class="active waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>
   <?php
    if($_SESSION["tipo"]==3){
      ?>
   <li><a href="<?php echo base_url();?>admin_webkm/noticias" class="waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Noticias</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/nacimientos" class="waves-effect waves-cyan"><i class="mdi-av-queue"></i> Nacimientos</a></li>
   <li><a href="<?php echo base_url();?>admin_webkm/comentarios" class="waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Comentarios</a></li>
   <li  class="bold active"><a href="<?php echo base_url();?>admin_webkm/visitas" class="waves-effect waves-cyan"><i class="mdi-action-swap-vert-circle"></i> Visitas</a></li>
 <?php
      }
     ?>
    <?php
    }
}
 
}