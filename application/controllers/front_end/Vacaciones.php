<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vacaciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("front_end/vacacionesmodel");
		$this->load->helper(array("fechas","str"));
		//$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata("rutUsuario")){
			redirect("login");
		}

		if ($this->uri->segment(1)=="") {
			redirect("inicio");
		} 	
	}

	public function index(){	
	    $datos = array(
          'titulo' => "Vacaciones",
	       'contenido' => "vacaciones/vacaciones_inicio",
		    'header'=>"index",
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

	public function getSolicitud(){
 		$datos = array("solicitud"=>$this->vacacionesmodel->verificarVacaciones($this->session->userdata('rutUsuario')));  
		$this->load->view('front_end/vacaciones/vacaciones_solicitud',$datos);
	}

   public function reporteIndividual(){
      $usuario=$this->session->userdata('rutUsuario');
      $solicitudes=$this->vacacionesmodel->getSolicitudesIndividual($usuario);
      $datos = array("solicitudes" => $solicitudes);  
      $this->load->view('front_end/vacaciones/reporte_vacaciones_usuario',$datos);
   }

   public function reporteUsuarios(){
      $solicitudes=$this->vacacionesmodel->reporteUsuarios();
      $datos = array("solicitudes" => $solicitudes);  
      $this->load->view('front_end/vacaciones/reporte_vacaciones',$datos);
   }


   public function solicitudVacaciones(){   	
   	$usuario=$this->session->userdata('rutUsuario');
   	$verifica=$this->vacacionesmodel->verificarVacaciones($usuario);
   	   $jefe=$this->vacacionesmodel->getJefe($usuario);
   	   foreach($jefe as $j){
   	   	$jefe=$j["jefe"];
   	   }

   	if($verifica!=FALSE){
      	foreach($verifica as $key){
       	  if($key["estado"]==1){
      		echo json_encode(array('res'=>'error', 'msg' =>"Su &uacute;ltima solicitud esta pendiente, contacte a su jefatura <b>".$jefe."</b>."));exit;
       	  }
      	}
      }
   	$fecha_inicio=$this->security->xss_clean(strip_tags($this->input->post("fecha_inicio")));
   	$fecha_termino=$this->security->xss_clean(strip_tags($this->input->post("fecha_termino")));
   	if(empty($fecha_inicio) or empty($fecha_termino)){
   		echo json_encode(array('res'=>'error', 'msg' =>"Debe ingresar las fechas requeridas."));exit;
   	}
   	$fecha_solicitud=date("Y-m-d");
   	$data=array("rut_usuario" => $usuario,
   		"fecha_inicio" => $fecha_inicio,
   		"fecha_termino" => $fecha_termino,
   		"fecha_solicitud" => $fecha_solicitud,
   		"estado" => 1);

      if ($this->enviaMail($usuario,$this->vacacionesmodel->getJefeCorreo($usuario),$data,$estado=0)) {
            if($this->vacacionesmodel->solicitarVacaciones($data)){
               echo json_encode(array('res'=>'ok', 'msg' =>"Solicitud enviada correctamente"));exit;
            }else{
               echo json_encode(array('res'=>'error', 'msg' =>"Problemas guardando la solicitud, intente nuevamente."));exit;
            }
      }else{
         echo json_encode(array('res'=>'error', 'msg' =>"Problemas enviando el correo, intente nuevamente."));exit;
      }
   }


   public function enviaMail($usuario,$jefe,$data,$estado){
      foreach($this->vacacionesmodel->getUserData($usuario) as $key){
      $data["nombre"]=$key["primer_nombre"]." ".$key["apellido_paterno"];
      $data["fecha_termino"]=$data["fecha_termino"];
      $data["fecha_termino"]=$data["fecha_termino"];
      $data["fecha_solicitud"]=$data["fecha_solicitud"];
      $datos = array(
         'fecha_inicio' => $data["fecha_inicio"],
         'fecha_termino' => $data["fecha_termino"],
         'fecha_solicitud' => $data["fecha_solicitud"],
         'nombre' => $data["nombre"]
      );  
      $html=$this->load->view('front_end/vacaciones/correodata',$datos,TRUE);

       $this->load->library('email');
       $config = array (
          'mailtype' => 'html',
          'charset'  => 'utf-8',
          'priority' => '1',
          'wordwrap' => TRUE
           );
      $this->email->initialize($config);
      $this->email->reply_to($key["correo"], $key["primer_nombre"]." ".$key["apellido_paterno"]);
      $this->email->from($key["correo"], $key["primer_nombre"]." ".$key["apellido_paterno"]);
      //$this->email->to("ricardo.hernandez.esp@gmail.com");
      $this->email->to($jefe);
      $this->email->subject("Solicitud de vacaciones de ".$key["primer_nombre"]." ".$key["apellido_paterno"]);
      $this->email->message($html); 
      $resp=$this->email->send();
      if ($resp) {
         return $resp;
      }else{
         return FALSE;
      }            
   }
   }

     public function enviaMailAprobacion($usuario,$correo,$data,$estado){
        $data["jefecorreo"]=$correo;

     
        foreach($data as $dato){

         $msg="";
         if ($estado==2) {
           $msg="Su solicitud de feriado legal a sido pre aprobada,
para terminar el proceso sirvase dirigirse con su jefatura para gestionar 
su firma en el documento de aprobaci&oacute;n final de autorizaci&oacute;n de feriado legal.";
         }elseif ($estado==3) {
           $msg="Su solicitud de feriado legal a sido rechazada,
para consultar sobre el proceso sirvase dirigirse con su jefatura.";
         }
         $datos = array(
            'nombre' =>$dato["nombre"],
            'msg'=>$msg,
            'fecha_inicio' => $dato["fecha_inicio"],
            'fecha_termino' => $dato["fecha_termino"],
            'fecha_solicitud' => $dato["fecha_solicitud"],
            'nombre' => $dato["nombre"]
         );  
         $html=$this->load->view('front_end/vacaciones/correodataaprobacion',$datos,TRUE);
         $this->load->library('email');
         $config =array(
             'mailtype' => 'html',
             'charset'  => 'utf-8',
             'priority' => '1',
             'wordwrap' => TRUE);
         $this->email->initialize($config);
         $this->email->reply_to($correo);
         $this->email->from($correo,  $correo);
         //$this->email->to("ricardo.hernandez.esp@gmail.com");
         $this->email->to($dato["correo"]);
         $this->email->subject("Respuesta a solicitud de ".$dato["nombre"]);
         $this->email->message($html); 
         $resp=$this->email->send();
         if ($resp) {
            return $resp;
         }else{
            return FALSE;
         }            
     }
  }


   public function actualizarEstadoSolicitud(){
      $id=$this->security->xss_clean(strip_tags($this->input->post("id")));
      foreach($this->vacacionesmodel->getSolicitudData($id) as $key){
        $usuario=$key["rut"];
      }
      $estado=$this->security->xss_clean(strip_tags($this->input->post("estado")));
      $data=array("estado" => $estado,"enviada"=>"si","fecha_aprobacion"=>date("y-m-d"));
      $datacorreo=$this->vacacionesmodel->getSolicitudData($id);
      $correo=$this->vacacionesmodel->getJefeCorreo($usuario);
      if ($this->enviaMailAprobacion($usuario,$correo,$datacorreo,$estado)) {
         if($this->vacacionesmodel->actualizarEstadoSolicitud($id,$data)){
            if ($estado==2) {
               $this->generarPdfAprobacion($id);
            }
            echo json_encode(array('res'=>'ok', 'msg' =>"Solicitud actualizada correctamente."));exit;
         }else{
            echo json_encode(array('res'=>'error', 'msg' =>"Problemas actualizando la solicitud, intente nuevamente."));exit;
         }
      }else{
            echo json_encode(array('res'=>'error', 'msg' =>"Problemas enviando el correo, intente nuevamente."));exit;
      }
   }


   public function getSolicitudesJefe(){
	   $usuario=$this->session->userdata('rutUsuario');
	   $solicitudes=$this->vacacionesmodel->getSolicitudesJefe($usuario);
	   $datos = array("contenido" => "vacaciones/vacaciones_inicio","solicitudes" => $solicitudes);  
	   $this->load->view('front_end/vacaciones/vacaciones_solicitudes_jefe',$datos);
   }

   public function getListadoSolicitudesJefe(){  
      $usuario=$this->session->userdata('rutUsuario');
      $solicitudes=$this->vacacionesmodel->getSolicitudesJefe($usuario);
      $datos = array("solicitudes" => $solicitudes);  
      $this->load->view('front_end/vacaciones/listado_solicitudes_jefe',$datos);
   }


   public function generarPdfAprobacion($id){
      $data=$this->vacacionesmodel->getSolicitudData($id);
      foreach($data as $dato){
          $nombre=mb_strtolower(url_title(convert_accented_characters($dato["nombre"]."_".$dato["fecha_solicitud"], '_', TRUE))).".pdf";
          $data2=array("archivo_aprobacion" => "aprobaciones/".$nombre);
          $this->vacacionesmodel->actualizarEstadoSolicitud($id,$data2);
               
           $this->load->library('html2pdf');
           $this->createFolder();
           $this->html2pdf->folder('./aprobaciones/');
           $this->html2pdf->filename($nombre);
           $this->html2pdf->paper('a4', 'portrait');
           $data = array(
             'data'=>$data,
             'fecha'=>date("Y-m-d"),
           );
           $this->html2pdf->html(utf8_decode($this->load->view('front_end/vacaciones/PdfAprobacion', $data, true)));        
           $route = base_url("aprobaciones/".$nombre); 
           if($this->html2pdf->create('save')) {
             return TRUE;
           }else{
             return FALSE;
           }          
       }
   }

   private function createFolder(){
        if(!is_dir("./aprobaciones")) {
            mkdir("./aprobaciones", 0777);
        }
    }


}
