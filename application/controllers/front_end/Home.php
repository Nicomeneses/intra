<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("front_end/homemodel");
		$this->load->helper(array("fechas","str"));
		//$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}

		if ($this->uri->segment(1)=="") {
		redirect("inicio");
		} 	
	}

	public function mensajes($vista,$nombre,$msge) { 
	    $this->session->set_flashdata($nombre, $msge);
	    redirect("front_end/".$vista, 'refresh');
	    echo $this->session->flashdata($nombre);
	}

	public function index(){	

	    $datos = array(
	       'titulo' => "Home",
	       'contenido' => "home/home",
		   'listado' => $this->homemodel->getNoticias(),
		   'header'=>"index",
		   'cumpleanios' => $this->homemodel->getCumpleaniosMes(),
		   'contratos' =>$this->homemodel->getContratos(),
		   'nacimientos' =>$this->homemodel->getNacimientos()

       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
	}


	public function inicio(){	

	    $datos = array(
	       'titulo' => "Home",
	       'contenido' => "home/home",
		   'listado' => $this->homemodel->getNoticias(),
		   'header'=>"index",
		   'cumpleanios' => $this->homemodel->getCumpleaniosMes(),
		   'contratos' =>$this->homemodel->getContratos(),
		   'nacimientos' =>$this->homemodel->getNacimientos()

       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
	}

	 public function loadMore(){
		sleep(1);
        if($this->input->is_ajax_request() && $this->input->post("lastId")){
            $nuevos_datos = $this->homemodel->cargarMasNoticias((int)$this->input->post("lastId"));
            if($nuevos_datos !== FALSE) {
                echo json_encode(array("res" => "success", "users" => $nuevos_datos));
            }else{
                echo json_encode(array("res" => "empty"));
            }
        }
        exit;
	}

	public function users(){
		if($this->homemodel->getUsers()){
            echo $this->homemodel->getUsers();
		}else{
		}
	}

	public function getUserData(){
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		if($this->homemodel->getUserData($rut)){
			echo json_encode(array("res" => "ok","users" => $this->homemodel->getUserData($rut)));exit;
		}else{
            echo json_encode(array("res" => "error","msg" => "No se han encontrado resultados"));exit;
		}
	}

	public function enviar_comentario_not(){
		$id_not=$this->security->xss_clean(strip_tags($this->input->post("id_not")));
		$usuario=$this->session->userdata('rutUsuario');
		$noticia_comentario=$this->security->xss_clean(strip_tags($this->input->post("noticia_comentario")));
		$fecha=date("Y-m-d H:i:s", time());
		$data=array("id_noticia"=>$id_not,"rut_usuario"=>$usuario,"fecha"=>$fecha,"comentario"=>$noticia_comentario);
		if($this->homemodel->enviar_comentario_not($data)){
			echo json_encode(array("res" => "ok"));
		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function getComentarios_not(){
		sleep(1);
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		$comentarios=$this->homemodel->getComentarios_not($id);
		if($comentarios){
            echo json_encode(array("res" => "ok", "comentarios" => $comentarios));
		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function eliminar_comentario_not(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliminar_comentario_not($id)){
		   echo "ok";
		}else{
            echo "error";
		}
	}

	
	public function getComentarios_cumple(){
		sleep(1);
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		//echo $this->homemodel->getComentarios_ing($rut);exit;
		$comentarios=$this->homemodel->getComentarios_cumple($rut);
		if($comentarios){
            echo json_encode(array("res" => "ok", "comentarios" => $comentarios));
		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function enviar_comentario_cumple(){
		$rut_cumple=$this->security->xss_clean(strip_tags($this->input->post("rut_cumple")));
		$rut_comenta=$this->session->userdata('rutUsuario');
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
		$fecha=date("Y-m-d H:i:s", time());
		$data=array("rut_cumple"=>$rut_cumple,"rut_comenta"=>$rut_comenta,"fecha"=>$fecha,"comentario"=>$comentario);
		if($this->homemodel->enviar_comentario_cumple($data)){
			echo json_encode(array("res" => "ok"));

		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function eliminar_comentario_cumple(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliminar_comentario_cumple($id)){
		   echo "ok";
		}else{
            echo "error";
		}
	}
	
	public function getComentarios_ing(){
		sleep(1);
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		//echo $this->homemodel->getComentarios_ing($rut);exit;
		$comentarios=$this->homemodel->getComentarios_ing($rut);
		if($comentarios){
            echo json_encode(array("res" => "ok", "comentarios" => $comentarios));
		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function enviar_comentario_ing(){
		$rut_ing=$this->security->xss_clean(strip_tags($this->input->post("rut_ing")));
		$rut_comenta=$this->session->userdata('rutUsuario');
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
		$fecha=date("Y-m-d H:i:s", time());
		$data=array("rut_ing"=>$rut_ing,"rut_comenta"=>$rut_comenta,"fecha"=>$fecha,"comentario"=>$comentario);
		if($this->homemodel->enviar_comentario_ing($data)){
			echo json_encode(array("res" => "ok"));

		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function eliminar_comentario_ing(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliminar_comentario_ing($id)){
		   echo "ok";
		}else{
            echo "error";
		}
	}


	public function getComentarios(){
		sleep(1);
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		$comentarios=$this->homemodel->getComentariosNacimientos($id);
		if($comentarios){
            echo json_encode(array("res" => "ok", "comentarios" => $comentarios));
		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function enviar_comentario(){
		$id_nacimiento=$this->security->xss_clean(strip_tags($this->input->post("id_nacimiento")));
		$usuario=$this->security->xss_clean(strip_tags($this->input->post("usuario")));
		$comentario=$this->security->xss_clean(strip_tags($this->input->post("comentario")));
		$fecha=date("Y-m-d H:i:s", time());
		$data=array("id_nacimiento"=>$id_nacimiento,"rut_usuario"=>$usuario,"fecha"=>$fecha,"comentario"=>$comentario);
		if($this->homemodel->enviar_comentario($data)){
			echo json_encode(array("res" => "ok"));

		}else{
            echo json_encode(array("res" => "error"));
		}
	}

	public function eliminar_comentario_nac(){
		$id=$this->security->xss_clean(strip_tags($this->input->post("id")));
		if($this->homemodel->eliminar_comentario_nac($id)){
		   echo "ok";
		}else{
            echo "error";
		}
	}

	/*public function l(){
		echo $this->homemodel->l();
	}*/


}
/* End of file home.php */
/* Location: ./application/controllers/front_end/home.php */