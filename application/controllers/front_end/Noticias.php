<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}
		$this->load->model("front_end/noticiasmodel");
		$this->load->model("front_end/homemodel");
		$this->load->helper(array("fechas","str"));
	}

	public function index(){	
		$noticia=$this->uri->segment(2);
		$id=$this->noticiasmodel->getNoticiaId($noticia);
	    $datos = array(
	       'titulo' => $noticia,
	       'contenido' => "noticias/noticias",
	       'header' => "noticias",
	       'cumpleanios' => $this->homemodel->getCumpleaniosMes(),
		   'contratos' =>$this->homemodel->getContratos(),
		   'nacimientos' =>$this->homemodel->getNacimientos(),
		   'noticia' => $this->noticiasmodel->getNoticia($noticia),
		   'galeria' => $this->noticiasmodel->getGaleria($id)

       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
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

}

