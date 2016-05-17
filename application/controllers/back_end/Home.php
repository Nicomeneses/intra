<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
//coment
	public function __construct(){
		parent::__construct();
		$this->load->model("back_end/homemodel");
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}
		if ($this->uri->segment(1)=="admin_webkm" and $this->uri->segment(2)=="") {
		redirect("admin_webkm/home_admin");
		} 	
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
		$this->insertarVisita();
		$tipo="";
		switch ($this->session->userdata('tipo')) {
			case 1:$tipo="Administrador";break;
			case 2:$tipo="Jefe Secci&oacute;n";	break;
			case 3:$tipo="Administrador";break;	}
	    $datos = array(
	       'titulo' => "Administraci&oacute;n",
	       'contenido' => "home/home",
	       'listado' => $this->homemodel->getNoticias(),
	       'imagen'=>$this->getImagenUsuario(),
	       'tipo'=>$tipo
       	);  
		$this->load->view('plantillas/plantilla_back_end',$datos);
	}
	
	public function getUserData(){
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		if($this->homemodel->getUserData($rut)){
			echo json_encode(array("res" => "ok","users" => $this->homemodel->getUserData($rut)));exit;
		}else{
            echo json_encode(array("res" => "error","msg" => "No se han encontrado resultados"));exit;
		}
	}


	public function users(){
		if($this->homemodel->getUsers()){
            echo $this->homemodel->getUsers();
		}
	}

	public function getReporteriadata(){
		echo $this->homemodel->getReporteriadata();exit;
	}

	public function getAsisTable(){
		echo $this->homemodel->getAsisTable();exit;
	}

	public function getInspeccionesdata(){
		echo $this->homemodel->getInspeccionesdata();exit;
	}
	
	public function reporteVisitasMes(){		
		$mes=date("m");	
		echo $this->homemodel->reporteVisitasMes($mes);		
	}

	public function reporteVisitasDia(){		
		$mes=date("m");	
		$dia=date("d");
		echo $this->homemodel->reporteVisitasDia($mes,$dia);		
	}

	public function reporteUsuariosAct(){		
		echo $this->homemodel->reporteUsuariosAct();		
	}

	public function reporteUsuariosTotal(){		
		echo $this->homemodel->reporteUsuariosTotal();		
	}

	public function reporteUsuarios2(){		
		echo $this->homemodel->reporteUsuarios2();		
	}

	public function reporteFlotaEstado(){		
		echo $this->homemodel->reporteFlotaEstado();		
	}

	public function reporteFlotaAsignados(){		
		echo $this->homemodel->reporteFlotaAsignados();		
	}

	public function getPagosmontosdata(){		
		echo $this->homemodel->getPagosmontosdata();		
	}	
	public function getPagosproyectosdata(){		
		echo $this->homemodel->getPagosproyectosdata();		
	}
	public function getCantidadingresosdata(){
		echo $this->homemodel->getCantidadingresosdata();
	}
	public function getCantidadsalidasdata(){
		echo $this->homemodel->getCantidadsalidasdata();
	}

	public function getBolsaValores(){
		$JsonSource = "http://indicadoresdeldia.cl/webservice/indicadores.json";
		$json = json_decode(file_get_contents($JsonSource));
		
		$dolar=0;$euro=0;$uf=0;$utm=0;$fecha = '';
		if(isset($json->moneda->dolar)){$dolar=$json->moneda->dolar;}
		if(isset($json->moneda->dolar)){$euro=$json->moneda->euro;}
		if(isset($json->moneda->dolar)){$uf=$json->indicador->uf;}
		if(isset($json->moneda->dolar)){$utm=$json->indicador->utm;}
		if(isset($json->date)){$fecha=date('d/m/Y H:i:s', strtotime($json->date));}
		
			$datos = array(	'dolar'=>$dolar,'euro'=>$euro,
				'uf'=>$uf,	'utm'=>$utm,'fecha'=>date('Y-m-d H:i:s', strtotime($json->date)));
			$this->homemodel->crearDivisa($datos);			
			$leer = $this->homemodel->leerDivisaAyer();
			
			$find = array("$",".",",");
			if(isset($leer[0])){
				if(str_replace($find, '',$leer[0]['dolar'])<str_replace($find, '',$dolar)){$dolare = '+';}
				else if(str_replace($find, '',$leer[0]['dolar'])>str_replace($find, '',$dolar)){$dolare = '-';}
				else{$dolare = '=';}

				if(str_replace($find, '',$leer[0]['euro'])<str_replace($find, '',$euro)){$euroe = '+';}
				else if(str_replace($find, '',$leer[0]['euro'])>str_replace($find, '',$euro)){$euroe = '-';}
				else{$euroe = '=';}	

				if(str_replace($find, '',$leer[0]['uf'])<str_replace($find, '',$uf)){$ufe = '+';}
				else if(str_replace($find, '',$leer[0]['uf'])>str_replace($find, '',$uf)){$ufe = '-';}
				else{$ufe = '=';}

				if(str_replace($find, '',$leer[0]['utm'])<str_replace($find, '',$utm)){$utme = '+';}
				else if(str_replace($find, '',$leer[0]['utm'])>str_replace($find, '',$utm)){$utme = '-';}
				else{$utme = '=';}		
			}else{$utme ='';$ufe ='';$dolare='';$euroe='';}	

			$datos = array(	'dolar'=>substr($dolar, 0, -3),'euro'=>substr($euro, 0, -3),
				'uf'=>substr($uf, 0, -3),	'utm'=>substr($utm, 0, -3),'fecha'=>date('d/m/Y H:i:s', strtotime($json->date)),
				'dolare'=>$dolare,'euroe'=>$euroe,'ufe'=>$ufe,'utme'=>$utme);
			echo json_encode($datos);			
	}

	public function visitas(){
		$tipo="";
		switch ($this->session->userdata('tipo')) {
		case 1:$tipo="Administrador";break;
		case 2:$tipo="Jefe Secci&oacute;n";	break;
		case 3:$tipo="Administrador";break;	}

		$datos = array(
		   'imagen'=>$this->getImagenUsuario(),
	       'tipo'=>$tipo,
	       'titulo' => "Administraci&oacute;n",
	       'contenido' => "home/visitas",
	       'listado' => $this->homemodel->getVisitas()
       	);  
		$this->load->view('plantillas/plantilla_back_end',$datos);
	}

	public function comentarios(){
		$tipo="";
		switch ($this->session->userdata('tipo')) {
		case 1:$tipo="Administrador";break;
		case 2:$tipo="Jefe Secci&oacute;n";	break;
		case 3:$tipo="Administrador";break;	}

		$datos = array(
		   'imagen'=>$this->getImagenUsuario(),
	       'tipo'=>$tipo,
	       'titulo' => "Administraci&oacute;n",
	       'contenido' => "home/comentarios",
	       'comentariosNoticias' => $this->homemodel->getComentariosNoticias(),
	       'comentariosNacimientos' => $this->homemodel->getComentariosNacimientos(),
	       'comentariosIngresos' => $this->homemodel->getComentariosIngresos(),
	       'comentariosCumple' => $this->homemodel->getComentariosCumpleanios()
       	);  
		$this->load->view('plantillas/plantilla_back_end',$datos);
	}

	public function modComentarioNoticia(){
		$id=$this->input->post("id");
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
    	$data=array("comentario"=>$comentario);
    	if($this->homemodel->modComentarioNoticia($id,$data)){
			echo json_encode(array('st'=>1, 'msg' => 'Comentario modificado correctamente.'));
		}else{
			echo json_encode(array('st'=>0, 'msg' => '<blockquote>Problemas eliminando el registro, intente m&aacute;s tarde.</blockquote>'));
		}	
	}
	
	public function eliComentarioNoticia(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliComentarioNoticia($id)){
			echo json_encode(array('st'=>0, 'msg' => 'Comentario eliminado correctamente.'));
		}else{
			echo json_encode(array('st'=>1, 'msg' => '<blockquote>Problemas eliminando el comentario, intente m&aacute;s tarde.</blockquote>'));
		}	
	}

	public function modComentarioCumple(){
		$id=$this->input->post("id");
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
    	$data=array("comentario"=>$comentario);
    	if($this->homemodel->modComentarioCumple($id,$data)){
			echo json_encode(array('st'=>1, 'msg' => 'Comentario modificado correctamente.'));
		}else{
			echo json_encode(array('st'=>0, 'msg' => '<blockquote>Problemas eliminando el registro, intente m&aacute;s tarde.</blockquote>'));
		}	
	}
	
	public function eliComentarioCumple(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliComentarioCumple($id)){
			echo json_encode(array('st'=>0, 'msg' => 'Comentario eliminado correctamente.'));
		}else{
			echo json_encode(array('st'=>1, 'msg' => '<blockquote>Problemas eliminando el comentario, intente m&aacute;s tarde.</blockquote>'));
		}	
	}

	public function modComentarioIngreso(){
		$id=$this->input->post("id");
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
    	$data=array("comentario"=>$comentario);
    	if($this->homemodel->modComentarioIngreso($id,$data)){
			echo json_encode(array('st'=>1, 'msg' => 'Comentario modificado correctamente.'));
		}else{
			echo json_encode(array('st'=>0, 'msg' => '<blockquote>Problemas eliminando el registro, intente m&aacute;s tarde.</blockquote>'));
		}	
	}
	
	public function eliComentarioIngreso(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliComentarioIngreso($id)){
			echo json_encode(array('st'=>0, 'msg' => 'Comentario eliminado correctamente.'));
		}else{
			echo json_encode(array('st'=>1, 'msg' => '<blockquote>Problemas eliminando el comentario, intente m&aacute;s tarde.</blockquote>'));
		}	
	}

	public function modComentarioNacimiento(){
		$id=$this->input->post("id");
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
    	$data=array("comentario"=>$comentario);
    	if($this->homemodel->modComentarioNacimiento($id,$data)){
			echo json_encode(array('st'=>1, 'msg' => 'Comentario modificado correctamente.'));
		}else{
			echo json_encode(array('st'=>0, 'msg' => '<blockquote>Problemas eliminando el registro, intente m&aacute;s tarde.</blockquote>'));
		}	
	}
	
	public function eliComentarioNacimiento(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliComentarioNacimiento($id)){
			echo json_encode(array('st'=>0, 'msg' => 'Comentario eliminado correctamente.'));
		}else{
			echo json_encode(array('st'=>1, 'msg' => '<blockquote>Problemas eliminando el comentario, intente m&aacute;s tarde.</blockquote>'));
		}	
	}

	public function getImagenUsuario(){
		$rut=$this->session->userdata('rutUsuario');
		return $this->homemodel->getImagenUsuario($rut);
	}


}

/* End of file home.php */
/* Location: ./application/controllers/front_end/home.php */