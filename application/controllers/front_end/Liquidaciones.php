<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Liquidaciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("front_end/liquidacionesmodel");
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
  
	public function index(){	
		$data=array("usuario"=>$this->session->userdata('nombresUsuario')." ".$this->session->userdata('apellidosUsuario'),
     	"fecha"=>date("Y-m-d G:i:s"),
    	"navegador"=>"navegador :".$this->agent->browser()."\nversion :".$this->agent->version()."\nos :".$this->agent-> platform()."\nmovil :".$this->agent->mobile(),
    	"ip"=>$this->input->ip_address(),
    	"pagina"=> $this->uri->segment("1")
    	);

    	$this->liquidacionesmodel->insertarVisita($data);
	    $datos = array(
	       'titulo' => "Liquidaciones",
	       'contenido' => "liquidaciones/liquidaciones",
		   'header'=>"index",
       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
	}

	public function formIngresarLiquidacion(){
		$datos = array();  
		$this->load->view('front_end/liquidaciones/formliquidacion',$datos);
	}

	public function existeLiqu(){
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		$mes=$this->security->xss_clean(strip_tags($this->input->post("mes")));
		$anio=$this->security->xss_clean(strip_tags($this->input->post("anio")));
		$periodo=$mes."-".$anio;
		$path = $_FILES['userfile']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$archivo=$rut.'_'.$periodo.".".$ext;

		if($this->liquidacionesmodel->existeLiqu($archivo)){
			echo json_encode(array('res'=>"si"));exit;
		}else{
			echo json_encode(array('res'=>"no"));exit;
		}
	}

	public function ingresarLiquidacion(){
		//sleep(2);
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		$area=$this->security->xss_clean(strip_tags($this->input->post("area")));
		$mes=$this->security->xss_clean(strip_tags($this->input->post("mes")));
		$anio=$this->security->xss_clean(strip_tags($this->input->post("anio")));
		$periodo=$mes."-".$anio;
		$fecha_subida=date("d-m-Y");
		$rut_sube=$this->session->userdata("rutUsuario");

		$archivo=$_FILES["userfile"]["name"];
		if($_FILES["userfile"]["name"]!=""){
			$fecha_creacion_carpeta = $mes.'-'.$anio;
            $carpeta = 'Archivo_PDF_Jefe_Seccion_LSP/'.$fecha_creacion_carpeta.'_'.trim(convert_accented_characters($area));
		    $path = $_FILES['userfile']['name'];
		    $ext = pathinfo($path, PATHINFO_EXTENSION);

			  if (!file_exists($carpeta)) { mkdir($carpeta, 0777, true); }
         	    $config['upload_path'] = $carpeta;
	    	    $config['allowed_types'] = 'pdf|jpg|png|JPG';
	    	    $config['file_name'] = $rut.'_'.$periodo.".".$ext;
				$config['max_size']	= '2000';
				$config['overwrite']	= TRUE;
	    	    $this->load->library('upload', $config); 

			    if ($this->upload->do_upload()){
			    	$id=$this->liquidacionesmodel->existeLiqu($rut.'_'.$periodo.".".$ext);
			    	if($id!=FALSE){
			    		 $data = array('nombre_archivo_PDF_jefe_seccion' => $rut.'_'.$periodo.".".$ext);
						if($this->liquidacionesmodel->actualizarLiquidacion($id,$data)){
							echo json_encode(array('res'=>"ok",'msg' => "Liquidaci&oacute;n actualizada con &eacute;xito."));exit;
						}else{
							echo json_encode(array('res'=>"error",'msg' => "Error actualizando la liquidaci&oacute;n, intente nuevamente."));exit;
						}
					}else{
						 $data = array('rut_usuario' => $rut,
				            'rut_jefe_seccion' => $rut_sube,
				            'archivo_PDF_emitido_jefe_seccion' => $carpeta.'/'.$rut.'_'.$periodo.".".$ext,
				            'fecha_archivo_PDF_emitido_jefe_seccion' =>  date("d-m-Y"),
				            'nombre_archivo_PDF_jefe_seccion' => $rut.'_'.$periodo.".".$ext,
				            'fecha_creacion_carpeta_jefe_seccion' => $fecha_creacion_carpeta,
				            'nombre_carpeta_jefe_seccion' => $fecha_creacion_carpeta.'_'.convert_accented_characters(trim($area)),
				            'periodo' => $fecha_creacion_carpeta);
						if($this->liquidacionesmodel->ingresarLiquidacion($data)){
							echo json_encode(array('res'=>"ok",'msg' => "Liquidaci&oacute;n ingresada con &eacute;xito."));exit;
						}else{
							echo json_encode(array('res'=>"error",'msg' => "Error ingresando la liquidaci&oacute;n, intente nuevamente."));exit;
						}
					}

	        
			   	 }else{
	          		  echo json_encode(array('res'=>"error",'msg' => $this->upload->display_errors()));exit;
			   	 }
		}else{
			 echo json_encode(array('res'=>"ok",'msg' => "Debe subir el archivo."));exit;
		}
	}

	public function datalistnombreliqu(){
		$nombre=$this->security->xss_clean(strip_tags($this->input->post("nombre")));
	 	foreach($this->liquidacionesmodel->datalist($nombre) as $key){
			echo "<option value='".$key["nombre_completo"]."'>".$key["nombre_completo"]."</option>";
		}
	}

	public function getDataDatalist(){
		$nombre=$this->security->xss_clean(strip_tags($this->input->post("nombre")));
		foreach($this->liquidacionesmodel->getDataDatalist($nombre) as $key){
		echo json_encode(array('res'=>"1",'rut' => $key["rut"],'area' => $key["area"]));
		}
	}

	public function listadoLiquidaciones(){
		$datos = array('listado' => $this->liquidacionesmodel->getLiquidaciones());  
		$this->load->view('front_end/liquidaciones/listadoliquidaciones',$datos);
	}

	public function misLiquidaciones(){
		$user=$this->session->userdata('rutUsuario');
		$datos = array('listado' => $this->liquidacionesmodel->getMisLiquidaciones($user));  
		$this->load->view('front_end/liquidaciones/misliquidaciones',$datos);
	}

	public function liquidacionesPersonal(){
		$user=$this->session->userdata("rutUsuario");
		$nombre=$this->liquidacionesmodel->getNombreByRut($user);
		$datos = array(
	       'nombre'=>$nombre,
	       'listado' =>$this->liquidacionesmodel->getLiquidacionesJefe($user) 
	       );  
		$this->load->view('front_end/liquidaciones/liquidacionespersonal',$datos);
	}


	public function getPersonalPorUsuario(){
		$rut=$_POST["rut"];
		$array=$this->liquidacionesmodel->getPersonalPorUsuario($rut);
		if($array){
			echo json_encode(array('res'=>'success', 'users' => $array));exit;
		}else{
			echo json_encode(array('res'=>'error'));exit;
		}

	}

	public function getPersonal(){
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		$nombre=$this->liquidacionesmodel->getNombreByRut($rut);
		$datos = array(
		   'nombre'=>$nombre,
		   'rut'=>$rut,
	       'listado' =>$this->liquidacionesmodel->getPersonalPorUsuario($rut));  
		 $this->load->view('front_end/liquidaciones/liquidacionespersonal',$datos);
	}
	
}
