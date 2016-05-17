<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {

	public function __construct()
	{	
		date_default_timezone_set("Chile/Continental");
		parent::__construct();
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}
		$this->load->model("back_end/noticiasmodel");
		$this->load->helper("str");
	}

	public function mensajes($vista,$nombre,$msge) { 
	    $this->session->set_flashdata($nombre, $msge);
	    redirect($vista, 'refresh');
	    echo $this->session->flashdata($nombre);
	}

	public function index(){	
	    $tipo="";
		switch ($this->session->userdata('tipo')) {
		case 1:$tipo="Administrador";break;
		case 2:$tipo="Jefe Secci&oacute;n";	break;
		case 3:$tipo="Administrador";break;	}

		$datos = array(
		   'imagen'=>$this->getImagenUsuario(),
	       'tipo'=>$tipo,
	       'titulo' => "Administraci&oacute;n",
	       'contenido' => "noticias/noticias",
	       'listado' => $this->noticiasmodel->getNoticias()

       	);  
		$this->load->view('plantillas/plantilla_back_end',$datos);
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

	public function getImagenUsuario(){
		$rut=$this->session->userdata('rutUsuario');
		return $this->noticiasmodel->getImagenUsuario($rut);
	}
	
	public function nuevanoticia(){
		$this->form_validation->set_error_delimiters('<blockquote>', '</blockquote>'); 
		if ($this->form_validation->run("admin_webkm/nuevanoticia") == FALSE){		
			echo json_encode(array('st'=>0, 'msg' => validation_errors()));exit;
		}else{	

		$titulo=$this->security->xss_clean(strip_tags($this->input->post("titulo")));
		$url=strtolower(url_title(convert_accented_characters($titulo)));
		$descripcion=$this->security->xss_clean(strip_tags($this->input->post("descripcion")));
		$fecha=date("Y-m-d H:i:s", time()); ;

		$imagen=rand(1,9999).url_title(convert_accented_characters($_FILES['userfile']['name']),'-',TRUE);
		
		$ext=substr($_FILES['userfile']['name'],-3);

		if($ext!="png" and $ext!="jpg" and $ext!="JPG" ){
			echo json_encode(array('st'=>3, 'msg' => 'Formato de imagen no soportado.'));
			exit;
		}

		if($ext=="JPG"){
			$imagen2=str_replace('JPG','',$imagen);
			$imagen2.='.JPG';
		}
		if($ext=="jpg"){
			$imagen2=str_replace('jpg','',$imagen);
			$imagen2.='.jpg';
		}

		if($ext=="png"){
			$imagen2=str_replace('png','',$imagen);
			$imagen2.='.png';
		}


		$data=array("titulo"=>$titulo,"descripcion"=>$descripcion,"fecha"=>$fecha,"imagen"=>$imagen2,"url"=>$url);

				if($this->noticiasmodel->nuevaNoticia($data)){

				$this->load->library('upload', $this->agrega_imagen($imagen2));
				
					if ($this->upload->do_upload()){	
					$this->load->library('image_lib', $this->agrega_miniatura("700","330",$imagen2));
						
						if (!$this->image_lib->resize()) {
							echo $this->image_lib->display_errors();
						}else{
						echo json_encode(array('st'=>1, 'msg' => 'Noticia ingresada correctamente.'));exit;
						}

					}else{
						echo json_encode(array('st'=>1, 'msg' => 'Noticia ingresada correctamente.'));exit;
					}
				}else{
					echo json_encode(array('st'=>2, 'msg' => 'Problemas ingresando la noticia, intente nuevamente.'));exit;
				}
			}
	}


	public function modificarnoticia(){
		$this->form_validation->set_error_delimiters('<blockquote>', '</blockquote>'); 
		if ($this->form_validation->run("admin_webkm/modificarnoticia") == FALSE){		
			echo json_encode(array('st'=>0, 'msg' => validation_errors()));
		}else{	



		$id=$this->input->post("id");
		$titulo=$this->security->xss_clean(strip_tags($this->input->post("titulo_mod")));
		$url=strtolower(url_title(convert_accented_characters($titulo)));
		$descripcion=$this->security->xss_clean(strip_tags($this->input->post("descripcion_mod")));
		$fecha=date("Y-m-d H:i:s", time());

			if(empty($_FILES['userfile']['name'])){
				$data=array("titulo"=>$titulo,"descripcion"=>$descripcion,"url"=>$url);
				$this->noticiasmodel->modificarnoticia($id,$data);
			echo json_encode(array('st'=>1, 'msg' => 'Noticia Modificada correctamente.'));

			}else{
				$tipo=$_FILES['userfile']['type'];
				if($tipo=="image/JPG" or $tipo=="image/jpg" or $tipo=="image/jpeg" or $tipo=="image/png"){

				$imagen=$this->noticiasmodel->getImagen($id);
				foreach($imagen as $key){
					$imagen=$key["imagen"];
				}

				if (file_exists('./assets/imagenes/noticias/'.$imagen)){
				unlink('./assets/imagenes/noticias/'.$imagen);
				}

				if (file_exists('./assets/imagenes/noticias/min_'.$imagen)){
				unlink('./assets/imagenes/noticias/min_'.$imagen);
				}

				$imagen1=rand(1,9999).url_title(convert_accented_characters($_FILES['userfile']['name']),'-',TRUE);


				$ext=substr($_FILES['userfile']['name'],-3);

				if($ext!="png" and $ext!="jpg" and $ext!="JPG"){
					echo json_encode(array('st'=>3, 'msg' => 'Formato de imagen no soportado.'));
					exit;
				}
				
				if($ext=="JPG"){
					$imagen2=str_replace('JPG','',$imagen1);
					$imagen2.='.JPG';
				}
				if($ext=="jpg"){
					$imagen2=str_replace('jpg','',$imagen1);
					$imagen2.='.jpg';
				}
				if($ext=="png"){
					$imagen2=str_replace('png','',$imagen1);
					$imagen2.='.png';
				}

				$this->load->library('upload', $this->agrega_imagen($imagen2));
		  	    
		  	    if ($this->upload->do_upload()){	
			    $this->load->library('image_lib', $this->agrega_miniatura("700","330",$imagen2));

				    if ($this->image_lib->resize()) {
						$data=array("titulo"=>$titulo,"descripcion"=>$descripcion,"fecha"=>$fecha,"imagen"=>$imagen2,"url"=>$url);
						$this->noticiasmodel->modificarnoticia($id,$data);
						echo json_encode(array('st'=>1, 'msg' => 'Noticia Modificada correctamente.'));

					}else{
						echo json_encode(array('st'=>0, 'msg' => '<blockquote>'.$this->image_lib->display_errors().'</blockquote>'));
					}
				}else{
					echo json_encode(array('st'=>0, 'msg' => '<blockquote>'.$this->upload->display_errors().'</blockquote>'));
				}	

				}else{
				echo json_encode(array('st'=>2, 'msg' => '<blockquote>Tipo de archivo no aceptado.</blockquote>'));

				}


			}
		}
	}


	public function eliminaNoticia(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->noticiasmodel->eliminarNoticia($id)){
			echo json_encode(array('st'=>0, 'msg' => 'Noticia eliminada correctamente.'));
		}else{
			echo json_encode(array('st'=>1, 'msg' => '<blockquote>Problemas eliminando la noticia, intente m&aacute;s tarde.</blockquote>'));
		}
		
	}
	

	public function agrega_imagen($imagen){
		$config['upload_path'] ='./assets/imagenes/noticias';
		$config['allowed_types'] = 'JPG|JPEG||jpg|png';
		$config['file_name'] = $imagen;
		$config['max_size']	= '1536'; 
		return $config;
	}	

	public function agrega_miniatura($width,$height,$nombre){
		$config["source_image"]='./assets/imagenes/noticias/'.$nombre;
		$config['new_image'] = "min_".$nombre;
		$config["width"]=$width;
		$config["height"]=$height;
		$config["quality"]='90%';
		$config["maintain_ratio"]=TRUE;
		$config["maintain_ratio"]=TRUE;
		return $config;
	}

	public function not_check($n){   
		if ($this->noticiasmodel->not_check($n)) {
			$this->form_validation->set_message('not_check', 'Ya existe una noticia con este nombre.');	
			return FALSE;
		}else{
			return TRUE;
		}		
 	}	

 	public function not_check_mod($n){
	$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
	if ($this->noticiasmodel->not_check_mod($n,$id)) {
		$this->form_validation->set_message('not_check_mod', 'Ya existe una noticia con este nombre.');	
		return FALSE;
	}else{
		return TRUE;
	}		
}


}

/* End of file home.php */
/* Location: ./application/controllers/front_end/home.php */