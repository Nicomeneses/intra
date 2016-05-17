<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nacimientos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("back_end/nacimientosmodel");
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}
		if ($this->uri->segment(1)=="admin_webkm" and $this->uri->segment(2)=="") {
		redirect("admin_webkm/home_admin");
		} 	
		$this->load->helper("str");
	}

	public function mensajes($vista,$nombre,$msge) { 
	    $this->session->set_flashdata($nombre, $msge);
	    redirect("back_end/".$vista, 'refresh');
	    echo $this->session->flashdata($nombre);
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
	       'contenido' => "nacimientos/nacimientos",
	       'listado' => $this->nacimientosmodel->getNacimientos()
       	);  
		$this->load->view('plantillas/plantilla_back_end',$datos);
	}

	public function getImagenUsuario(){
		$rut=$this->session->userdata('rutUsuario');
		return $this->nacimientosmodel->getImagenUsuario($rut);
	}

	public function nuevonacimiento(){
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		$rut1= str_replace('.', '', $rut); 
		$rut2= str_replace('-', '', $rut1); 
		$esposa=$this->security->xss_clean(strip_tags($this->input->post("esposa")));
		$hijo=$this->security->xss_clean(strip_tags($this->input->post("hijo")));
		$fecha=$this->input->post("anio")."-".$this->input->post("mes")."-".$this->input->post("dia");
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
		//$data=array("rut_usuario"=>$rut2,"esposa"=>$esposa,"hijo"=>$hijo,"fecha"=>$fecha,"imagen"=>"","comentario"=>$comentario);

        $this->form_validation->set_error_delimiters('<blockquote>', '</blockquote>'); 
		if ($this->form_validation->run("admin_webkm/nuevonacimiento") == FALSE){		
			echo json_encode(array('st'=>0, 'msg' => validation_errors()));
		}else{	

			if(empty($_FILES['userfile']['name'])){
				$data=array("rut_usuario"=>$rut2,"esposa"=>$esposa,"hijo"=>$hijo,"fecha"=>$fecha,"imagen"=>"","comentarios"=>$comentario);
				$this->nacimientosmodel->nuevoNacimiento($data);
				echo json_encode(array('st'=>1, 'msg' => 'Nacimiento ingresado correctamente.'));

			}else{
				$tipo=$_FILES['userfile']['type'];
				if($tipo=="image/jpg" or $tipo=="image/jpeg" or $tipo=="image/png"){

				$imagen1=rand(1,9999).url_title(convert_accented_characters($_FILES['userfile']['name']),'-',TRUE);

				$ext=substr($_FILES['userfile']['name'],-3);

				if($ext!="png" and $ext!="jpg"){
					echo json_encode(array('st'=>0, 'msg' => '<blockquote>Formato de imagen no soportado.</blockquote>'));
					exit;
				}
		
				if($ext=="jpg"){$imagen2=str_replace('jpg','',$imagen1);$imagen2.='.jpg';}
				if($ext=="png"){$imagen2=str_replace('png','',$imagen1);$imagen2.='.png';}

				$this->load->library('upload', $this->agrega_imagen($imagen2));
		  	    
		  	    if ($this->upload->do_upload()){	
			    $this->load->library('image_lib', $this->agrega_miniatura("640","480",$imagen2));

				    if ($this->image_lib->resize()) {
						$data=array("rut_usuario"=>$rut2,"esposa"=>$esposa,"hijo"=>$hijo,"fecha"=>$fecha,"comentarios"=>$comentario,"imagen"=>$imagen2);

						$this->nacimientosmodel->nuevoNacimiento($data);
						echo json_encode(array('st'=>1, 'msg' => 'Registro ingresado correctamente.'));

					}else{
						echo json_encode(array('st'=>0, 'msg' => '<blockquote>'.$this->image_lib->display_errors().'</blockquote>'));
					}
				}else{
					echo json_encode(array('st'=>0, 'msg' => '<blockquote>'.$this->upload->display_errors().'</blockquote>'));
				}	

				}else{
				echo json_encode(array('st'=>0, 'msg' => '<blockquote>Tipo de archivo no aceptado.</blockquote>'));

				}
			}
		}

	}


	public function modificarnacimiento(){
		$id=$this->input->post("id");
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		$rut1= str_replace('.', '', $rut); 
		$rut2= str_replace('-', '', $rut1); 		
		$esposa=$this->security->xss_clean(strip_tags($this->input->post("esposa")));
		$hijo=$this->security->xss_clean(strip_tags($this->input->post("hijo")));
		$fecha=$this->input->post("anio")."-".$this->input->post("mes")."-".$this->input->post("dia");
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
		//$data=array("rut_usuario"=>$rut2,"esposa"=>$esposa,"hijo"=>$hijo,"fecha"=>$fecha,"imagen"=>"","comentario"=>$comentario);

		$this->form_validation->set_error_delimiters('<blockquote>', '</blockquote>'); 
		if ($this->form_validation->run("admin_webkm/modificarnacimiento") == FALSE){		
			echo json_encode(array('st'=>0, 'msg' => '<blockquote>'.validation_errors().'</blockquote>'));
		}else{	

			if(empty($_FILES['userfile']['name'])){
				$data=array("rut_usuario"=>$rut2,"esposa"=>$esposa,"hijo"=>$hijo,"fecha"=>$fecha,"comentarios"=>$comentario);
				$this->nacimientosmodel->modificarnacimiento($id,$data);
				echo json_encode(array('st'=>1, 'msg' => 'Registro modificado correctamente.'));

			}else{
				$tipo=$_FILES['userfile']['type'];
				if($tipo=="image/jpg" or $tipo=="image/jpeg" or $tipo=="image/png"){

				$imagen=$this->nacimientosmodel->getImagen($id);
				foreach($imagen as $key){
					$imagen=$key["imagen"];
				}

				if (file_exists('./assets/imagenes/nacimientos/'.$imagen)){
				unlink('./assets/imagenes/nacimientos/'.$imagen);
				}

				if (file_exists('./assets/imagenes/nacimientos/min_'.$imagen)){
				unlink('./assets/imagenes/nacimientos/min_'.$imagen);
				}

				$imagen1=rand(1,9999).url_title(convert_accented_characters($_FILES['userfile']['name']),'-',TRUE);

				$ext=substr($_FILES['userfile']['name'],-3);

				if($ext!="png" and $ext!="jpg"){
					echo json_encode(array('st'=>3, 'msg' => 'Formato de imagen no soportado.'));
					exit;
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
			    $this->load->library('image_lib', $this->agrega_miniatura("640","480",$imagen2));

				    if ($this->image_lib->resize()) {
				    	$data=array("rut_usuario"=>$rut2,"esposa"=>$esposa,"hijo"=>$hijo,"fecha"=>$fecha,"imagen"=>$imagen2,"comentarios"=>$comentario);
						$this->nacimientosmodel->modificarnacimiento($id,$data);
						echo json_encode(array('st'=>1, 'msg' => 'Registro modificado correctamente.'));

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
	

	public function eliminanacimiento(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->nacimientosmodel->eliminanacimiento($id)){
			echo json_encode(array('st'=>0, 'msg' => 'Registro eliminado correctamente.'));
		}else{
			echo json_encode(array('st'=>1, 'msg' => '<blockquote>Problemas eliminando el registro, intente m&aacute;s tarde.</blockquote>'));
		}	
	}

	public function agrega_imagen($imagen){
		$config['upload_path'] ='./assets/imagenes/nacimientos';
		$config['allowed_types'] = 'jpg|png';
		$config['file_name'] = $imagen;
		$config['max_size']	= '1536'; 
		return $config;
	}	

	public function agrega_miniatura($width,$height,$nombre){
		$config["source_image"]='./assets/imagenes/nacimientos/'.$nombre;
		$config['new_image'] = "min_".$nombre;
		$config["width"]=$width;
		$config["height"]=$height;
		$config["quality"]='90%';
		$config["maintain_ratio"]=TRUE;
		$config["maintain_ratio"]=TRUE;
		return $config;
	}

}