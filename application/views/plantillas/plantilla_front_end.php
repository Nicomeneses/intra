<?php
if(isset($header) and $header=="index"){
	$this->load->view('plantillas/front_end/header');
	$this->load->view('front_end/' . $contenido);
	$this->load->view('plantillas/front_end/footer');
	
}elseif(isset($header) and $header=="noticias"){
	$this->load->view('plantillas/front_end/header');
	$this->load->view('front_end/' . $contenido);
	//$this->load->view('plantillas/front_end/sidebar');
	$this->load->view('plantillas/front_end/footer');
}
elseif(isset($header) and $header=="intranet"){
	$this->load->view('front_end/' . $contenido);
}
elseif(isset($header) and $header=="login"){
	$this->load->view('front_end/' . $contenido);
}


