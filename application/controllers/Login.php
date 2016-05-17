<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("front_end/homemodel");
		$this->load->library('user_agent');
	}

	public function index(){
		$datos = array(
        'titulo' => "Login",
        'contenido' => "home/login",
	    'header'=>"login"
       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
	}

	public function loginval(){
		$rut=$this->security->xss_clean($this->input->post("usuario"));
		$rut1=str_replace('.', '', $rut);
		$rut2=str_replace('.', '', $rut1);
		$usuario=str_replace('-', '', $rut2);
		$pass=sha1($this->security->xss_clean(strip_tags($this->input->post("pass"))));

		if (empty($usuario) or empty($pass)) {
			echo json_encode(array("respuesta" => "vacios"));exit;
		}else{
			if ($this->homemodel->login($usuario,$pass)==1) {
				echo json_encode(array("respuesta" => "ok", "usuario" => $pass));exit;
			}elseif($this->homemodel->login($usuario,$pass)==2){
				echo json_encode(array("respuesta" => "nouser", "usuario" => $pass));exit;
			}
			elseif($this->homemodel->login($usuario,$pass)==3){
				echo json_encode(array("respuesta" => "invalidpass", "usuario" => $pass));exit;
			}
		}
	}
	
	public function unlogin(){
		$this->session->unset_userdata("nombresUsuario"); 
	    $this->session->unset_userdata("apellidosUsuario"); 
		$this->session->unset_userdata("rutUsuario"); 
		$this->session->unset_userdata("correo"); 
		$this->session->unset_userdata("tipo");
		$this->session->unset_userdata("ultimoacceso");
		$this->session->sess_destroy();
		redirect("");
	}

	public function changepass(){
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}
		$datos = array(
        'titulo' => "Cambiar Contrase&ntilde;a",
        'contenido' => "home/changepass",
	    'header'=>"index"
       	);  
		$this->load->view('plantillas/plantilla_front_end',$datos);
	}

	public function changepassproc(){
		$rut=$this->session->userdata("rutUsuario");
		$passactual=$this->security->xss_clean(strip_tags($this->input->post("pass_actual")));
		$pass_nueva=$this->security->xss_clean(strip_tags($this->input->post("pass_nueva")));
		$pass_nueva2=$this->security->xss_clean(strip_tags($this->input->post("pass_nueva2")));
		$passbd=$this->homemodel->getUserPass($rut);
		//echo $passbd["contrasena"];exit;
		if($passactual=="" or $pass_nueva=="" or $pass_nueva2==""){
			echo json_encode(array("res" => 0));
			exit;
		}
		if($pass_nueva!=$pass_nueva2){
			echo json_encode(array("res" => 1));
			exit;
		}
		if($passbd["contrasena"]!=sha1($passactual)){
			echo json_encode(array("res" => 2));
			exit;
		}
		
		$data=array("contrasena"=>sha1($pass_nueva));
		if($this->homemodel->updatePass($rut,$data)){
			echo json_encode(array("res" => 3));
			exit;
		}else{
			echo json_encode(array("res" => 4));
			exit;
		}
	}

	public function recuperarpass(){
		$rut=$this->security->xss_clean(strip_tags($this->input->post("rut")));
		if($this->homemodel->getCorreo($rut)){
		$min=1000; $max=9999;
   
			$correo=$this->homemodel->getCorreo($rut);
			$pass=rand($min,$max);
			$data=array("contrasena"=>sha1($pass));
				if($this->homemodel->recuperarpass($rut,$data)){
					$this->load->library('email');

					$this->email->from('no-reply@km-telecomunicaciones.cl', 'km-telecomunicaciones');
					$this->email->to($correo);
					//$this->email->cc('ricardo.hernandez.esp@gmail.com');
					$this->email->subject('Contraseña solicitada Web KM');
					$this->email->message("Nueva contraseña : ".$pass);
					$this->email->send();
					echo json_encode(array("res" => 1));//ok
					exit;

				}else{
					echo json_encode(array("res" => 3));// problemas actualizando contrasena
					exit;
				}
		}else{
			echo json_encode(array("res" => 2));// correo no encontrado
			exit;
		}
	}

	function generarPass($length=5,$uc=FALSE,$n=FALSE,$sc=FALSE){
		$source = 'abcdefghijklmnopqrstuvwxyz';
		$source = '1234567890';
		if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if($n==1) $source .= '1234567890';
		if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
		if($length>0){
			$rstr = "";
			$source = str_split($source,1);
			for($i=1; $i<=$length; $i++){
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,count($source));
				$rstr .= $source[$num-1];
			}

		}
	return $rstr;
	}

}

