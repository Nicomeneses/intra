<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galeria extends CI_Controller {

	public function __construct(){	
		date_default_timezone_set("Chile/Continental");
		parent::__construct();
		$this->load->model("back_end/noticiasmodel");
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}
	}

	public function insertarVisita(){
		$this->load->model("back_end/homemodel");
		$this->load->library('user_agent');
		$rut=$this->session->userdata('rutUsuario');
		if($rut!="169868220" and $rut!="188485650"){
			$data=array("usuario"=>$this->session->userdata('nombresUsuario')." ".$this->session->userdata('apellidosUsuario'),
	     	"fecha"=>date("Y-m-d G:i:s"),
	    	"navegador"=>"navegador :".$this->agent->browser()."\nversion :".$this->agent->version()."\nos :".$this->agent-> platform()."\nmovil :".$this->agent->mobile(),
	    	"ip"=>$this->input->ip_address(),
	    	"pagina"=> $this->uri->segment("1")
	    	);
	    	$this->homemodel->insertarVisita($data);
		}
	}

	public function mensajes($vista,$nombre,$msge) { 
	    $this->session->set_flashdata($nombre, $msge);
	    redirect($vista, 'refresh');
	    echo $this->session->flashdata($nombre);
	}

	public function index(){
		$id=$this->uri->segment(3);
		$tipo="";
		switch ($this->session->userdata('tipo')) {
		case 1:$tipo="Administrador";break;
		case 2:$tipo="Jefe Secci&oacute;n";	break;
		case 3:$tipo="Administrador";break;	}

		$datos = array(
		   'imagen'=>$this->getImagenUsuario(),
	       'tipo'=>$tipo,
	       'titulo' => "Administraci&oacute;n de Im&aacute;genes",
	       'contenido' => "noticias/galeria",
	       'listado' => $this->noticiasmodel->getGaleria($id),
	       'idnoticia'=>$id
       	);  
		$this->load->view('plantillas/plantilla_back_end',$datos);
	
	}

	public function getImagenUsuario(){
		$rut=$this->session->userdata('rutUsuario');
		return $this->noticiasmodel->getImagenUsuario($rut);
	}
	
	public function getGaleria(){
		$id=$this->uri->segment(4);
	    $datos = array(	
	       'listado' => $this->noticiasmodel->getGaleria($id),
       	);  
		$this->load->view('back_end/noticias/galeria_listado',$datos);
	
	}

	public function eliminaimagengaleria(){

		$idnoticia=$this->input->post('idnot');
		$idgaleria=$this->input->post('idgal');
		
		$img=$this->noticiasmodel->getGaleriaImg($idgaleria);
		foreach($img as $key){
			@unlink('./assets/imagenes/noticias/'.$key["imagen"]);
			@unlink('./assets/imagenes/noticias/min_'.$key["imagen"]);
		}
		//eliminar de la bd
		if($this->noticiasmodel->eliminarGaleriaImg($idgaleria)){
			echo "Imagen eliminada con &eacute;xito.";
			/*$this->mensajes("admin_webkm/galeria/".$idnoticia."","mensaje",'<blockquote>Imagen Eliminada con &eacute;xito.</blockquote>');*/
		}else{
			echo "Problemas eliminando la imagen, intente m&aacute;s tarde.";
			/*$this->mensajes("admin_webkm/galeria/".$idnot."","mensaje",'<blockquote>Problemas eliminando la imagen,intente nuevamente.</blockquote>');*/
		}
   		
	}



public function createThumbnail($imagen){

    $this->load->library('image_lib');
    $config['image_library']    = "gd2";      
    $config['source_image']     = "./assets/imagenes/noticias/".$imagen;      
	$config['new_image'] = "min_".$imagen;
    $config['maintain_ratio']   = TRUE;      
    $config['width'] = "700";      
    $config['height'] = "330";

    $this->image_lib->initialize($config);

    if(!$this->image_lib->resize()){
        echo $this->image_lib->display_errors();
    } 
    $this->image_lib->clear();     
}

public function cargaimagenes(){
	$id=$this->input->post("id");
	$config['upload_path'] = './assets/imagenes/noticias';
	$config['allowed_types'] = 'JPG|jpg|png';
	$config['max_size']	= '1536';

	$this->load->library('upload', $config);
	$num_archivos = count($_FILES['archivos']['tmp_name']);
	
	for ($i=0;$i<$num_archivos;$i++){
		$imagen=rand(1,9999).url_title(convert_accented_characters($_FILES['archivos']['name'][$i]),'-',TRUE);
		
		$ext=substr($_FILES['archivos']['name'][$i],-3);


		if($ext!="png" and $ext!="jpg" and $ext!="JPG"){
		$this->mensajes("admin_webkm/galeria/".$id."","mensaje",'<blockquote>Formato de imagen no soportado.</blockquote>');
			exit;
		}

		if($ext=="jpg"){
			$imagen2=str_replace('jpg','',$imagen);
			$imagen2.='.jpg';
		}
		if($ext=="JPG"){
			$imagen2=str_replace('JPG','',$imagen);
			$imagen2.='.JPG';
		}

		if($ext=="png"){
			$imagen2=str_replace('png','',$imagen);
			$imagen2.='.png';
		}
		
		$titulo=preg_replace('/[0-9]+/', '', $imagen2);
		$titulo=explode('.',$titulo);
		$titulo=$titulo[0];
	    $_FILES['userfile']['name'] = $imagen2;
	    $_FILES['userfile']['type'] = $_FILES['archivos']['type'][$i];
	    $_FILES['userfile']['tmp_name'] = $_FILES['archivos']['tmp_name'][$i];
	    $_FILES['userfile']['error'] = $_FILES['archivos']['error'][$i];
	    $_FILES['userfile']['size'] = $_FILES['archivos']['size'][$i];
             
	  	if (!$this->upload->do_upload()){   
			$this->mensajes("admin_webkm/galeria/".$id."","mensaje",'<blockquote>Problemas Cargando las im&aacute;genes, intente nuevamente.'.$this->upload->display_errors().'</blockquote>');
	    }
	    $data=array(
	   		'id_noticia'=>$id,
	   		'titulo' 	=>$titulo,
	   		'imagen'	=>$imagen2
	   	);

	   $this->noticiasmodel->addGaleria($data);
	   $this->createThumbnail($imagen2); 

} 
$this->mensajes("admin_webkm/galeria/".$id."","mensaje",'<blockquote>Imagenes Cargadas con &eacute;xito.</blockquote>');

}	



}
