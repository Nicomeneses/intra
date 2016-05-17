<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method')){

    function menu_front(){

if(preg_match("/ /",$_SERVER["REQUEST_URI"])){
	?>
	  <li><a href="<?php echo base_url()?>inicio"><i class="material-icons left">store</i>Inicio</a></li>
      <li><a href="<?php echo base_url()?>intranet"><i class="material-icons left">dashboard</i>Intranet</a></li>
	  <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">perm_identity</i>Perfil<i class="material-icons right">arrow_drop_down</i></a></li>
	<?php
	}elseif (preg_match("/inicio/",$_SERVER["REQUEST_URI"])) {
	?>
 	  <li class="active"><a href="<?php echo base_url()?>inicio"><i class="material-icons left">store</i>Inicio</a></li>
      <li><a href="<?php echo base_url()?>intranet"><i class="material-icons left">dashboard</i>Intranet</a></li>
	  <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">perm_identity</i>Perfil<i class="material-icons right">arrow_drop_down</i></a></li>
	<?php
	}

	elseif (preg_match("/intranet/",$_SERVER["REQUEST_URI"] )) {
	?>
 	  <li><a href="<?php echo base_url()?>inicio"><i class="material-icons left">store</i>Inicio</a></li>
      <li class="active"><a href="<?php echo base_url()?>intranet"><i class="material-icons left">dashboard</i>Intranet</a></li>
	  <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">perm_identity</i>Perfil<i class="material-icons right">arrow_drop_down</i></a></li>
	<?php
	}
    }
 
}