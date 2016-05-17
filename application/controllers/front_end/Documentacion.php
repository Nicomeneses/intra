<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentacion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("front_end/documentacionmodel");
		$this->load->helper(array("fechas","str"));
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}
		if ($this->uri->segment(1)=="") {
		redirect("inicio");
		} 	
	}
	
	public function insertarVisita(){
    $this->load->model("front_end/homemodel");
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
	public function indexPrevencion(){	
	    $datos = array(
	       'titulo' => "Prevenci&oacute;n de riesgos",
	       'contenido' => "documentacion/prevenciondeRiesgos",
	       'header'=>"index",
		   'listado' => $this->documentacionmodel->getArchivosPrevencion(),
       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
	}


	public function formprevencionderiesgos(){
		sleep(1);
		if($_FILES["userfile"]["name"]==""){
	      echo json_encode(array('res'=>0, 'msg' => "Debe subir un archivo."));exit;
		}else{
			$nombre=explode(".", $_FILES['userfile']['name']);
			$nombre1=strtolower(url_title(convert_accented_characters($nombre[0])));
			$path = $_FILES['userfile']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$archivo=$nombre1.".".$ext;

			$fecha=date("Y-m-d");
			$categoria="prevencion";
			$subcategoria=$this->security->xss_clean(strip_tags($this->input->post("categoria")));

			$data=array("categoria"=>$categoria,"subcategoria"=>$subcategoria,"archivo"=>"archivos/".$archivo,"fecha_subida"=>$fecha);	
			if($this->load->library('upload', $this->agrega_archivo($archivo))){
				if($this->upload->do_upload()){
					if ($this->documentacionmodel->nuevoArchivoPrevencion($data)){	
						echo json_encode(array('res'=>1, 'msg' => "Archivo subido correctamente."));exit;
					}else{
						echo json_encode(array('res'=>0, 'msg' => 'Problemas ingresando el archivo a la base de datos, intente nuevamente.'));exit;
					}
			 	}else{
			 		echo json_encode(array('res'=>0, 'msg' => $this->upload->display_errors()));exit;
			 	}
			}else{
			echo json_encode(array('res'=>0, 'msg' => 'Problemas cargando librer&iacute;as, intente nuevamente.'));exit;
	    	} 	
		}
	}

	public function agrega_archivo($archivo){
		$config['upload_path'] ='./archivos';
		$config['allowed_types'] = 'doc|docx|ppt|pptx|pdf|xls|xlsx';
		$config['file_name'] = $archivo;
		$config['max_size']	= '3100'; 
		return $config;
	}	

	public function eliminarArchivoPrevencion(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		foreach ($this->documentacionmodel->getArchivoData($id) as $key) {
			$archivo=explode("/",$key["archivo"]);
		}
		if (file_exists('./archivos/'.$archivo[1])){
			if(unlink('./archivos/'.$archivo[1])){
				if($this->documentacionmodel->eliminarArchivoPrevencion($id)){
					echo json_encode(array('res'=>1, 'msg' => 'Archivo eliminado correctamente.'));exit;
				}else{
					echo json_encode(array('res'=>0, 'msg' => 'Problemas borrando datos, intente nuevamente.'));exit;
				}
			}else{
				echo json_encode(array('res'=>0, 'msg' => 'Problemas borrando el archivo del servidor, intente nuevamente.'));exit;
			}
		}else{
			echo json_encode(array('res'=>0, 'msg' => 'El archivo no existe en el servidor, intente nuevamente.'));exit;
		}
	}

	public function indexOperaciones(){	
	    $datos = array(
	       'titulo' => "Operaciones t&eacute;cnicas",
	       'contenido' => "documentacion/operacionesTecnicas",
	       'header'=>"index",
		   'listado' => $this->documentacionmodel->getArchivosOperaciones(),
       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
	}


	public function formoperacionestecnicas(){
		sleep(1);
		if($_FILES["userfile"]["name"]==""){
	      echo json_encode(array('res'=>0, 'msg' => "Debe subir un archivo."));exit;
		}else{
			$nombre=explode(".", $_FILES['userfile']['name']);
			$nombre1=strtolower(url_title(convert_accented_characters($nombre[0])));
			$path = $_FILES['userfile']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$archivo=$nombre1.".".$ext;

			$fecha=date("Y-m-d");
			$categoria="operaciones";
			$subcategoria=$this->security->xss_clean(strip_tags($this->input->post("categoria")));
			$data=array("categoria"=>$categoria,"subcategoria"=>$subcategoria,"archivo"=>"archivos/".$archivo,"fecha_subida"=>$fecha);	
			if($this->load->library('upload', $this->agrega_archivo($archivo))){
				if($this->upload->do_upload()){
					if ($this->documentacionmodel->nuevoArchivoPrevencion($data)){	
						echo json_encode(array('res'=>1, 'msg' => "Archivo subido correctamente."));exit;
					}else{
						echo json_encode(array('res'=>0, 'msg' => 'Problemas ingresando el archivo a la base de datos, intente nuevamente.'));exit;
					}
			 	}else{
			 		echo json_encode(array('res'=>0, 'msg' => $this->upload->display_errors()));exit;
			 	}
			}else{
			echo json_encode(array('res'=>0, 'msg' => 'Problemas cargando librer&iacute;as, intente nuevamente.'));exit;
	    	} 	
		}
	}

}
/* End of file home.php */
/* Location: ./application/controllers/front_end/home.php */