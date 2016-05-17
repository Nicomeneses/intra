<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VacacionesModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Santiago");  
	}

	public function solicitarVacaciones($data){
		if($this->db->insert('solicitudes_vacaciones', $data)){
			return TRUE;
		}
		return FALSE;
	}

	public function verificarVacaciones($usuario){
		$this->db->where('rut_usuario', $usuario);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$res=$this->db->get('solicitudes_vacaciones');
		if ($res->num_rows()>0) {
			return $res->result_array();
		}
		return FALSE;
	}

	public function getUserData($usuario){
		$this->db->where('rut', $usuario);
		$res=$this->db->get('usuario');
		if ($res->num_rows()>0) {
			return $res->result_array();
		}
		return FALSE;
	}

	public function getSolicitudData($id){
		$array=array();
		$this->db->where('id', $id);
		$res=$this->db->get('solicitudes_vacaciones');
		if($res->num_rows()>0){
			foreach($res->result_array() as $key){
	    		$this->db->select('primer_nombre, apellido_paterno,apellido_materno,correo');
	    		$this->db->from('usuario');
	    		$this->db->where('rut', $key["rut_usuario"]);
	    		$res2=$this->db->get();
	    		foreach ($res2->result_array() as $key2) {
	    			$temp = array();
		    		$temp["rut"] =$key["rut_usuario"];
		    		$temp["fecha_solicitud"] =$key["fecha_solicitud"];
		    		$temp["fecha_inicio"] =$key["fecha_inicio"];
		    		$temp["fecha_termino"] =$key["fecha_termino"];
		    		$temp["fecha_aprobacion"] =$key["fecha_aprobacion"];
		    		$temp["estado"] =$key["estado"];
	    			$temp["correo"] =$key2["correo"];
    				$temp["nombre"] =$key2["primer_nombre"]." ".$key2["apellido_paterno"]." ".$key2["apellido_materno"];
    				$array[] = $temp;	
	    		}
			}
			return $array;
		}
		return FALSE;
	}

	public function getJefeCorreo($usuario){
		$array=array();
		$this->db->select('nombre_jefatura');
		$this->db->from('usuario');
		$this->db->where('rut', $usuario);
		$res=$this->db->get();
		foreach($res->result_array() as $key){

		$this->db->select('rut_jefatura');
		$this->db->from('mantenedor_nombrejefatura');
		$this->db->where('id', $key["nombre_jefatura"]);
		$res2=$this->db->get();

			foreach($res2->result_array() as $key2){
				$temp = array();
				$this->db->select('correo');
				$this->db->from('usuario');
				$this->db->where('rut', $key2["rut_jefatura"]);
				$res3=$this->db->get();
				$row=$res3->row_array();
				return $row["correo"];
			}
		}
	}

	public function getJefe($usuario){
		$this->db->select('mj.nombre_jefe as jefe');
		$this->db->from('usuario as u');
		$this->db->join('mantenedor_nombrejefatura as mj', 'u.nombre_jefatura = mj.id', 'left');
		$this->db->where('u.rut', $usuario);
		$res=$this->db->get();
		if ($res->num_rows()>0) {
			return $res->result_array();
		}
		return false;
	}

	public function getSolicitudesJefe(){
		$array=array();
		//pendiente 1- aprobada 2-no aprobada-3
		$this->db->select('id');
		$this->db->from('mantenedor_nombrejefatura');
		$this->db->where('rut_jefatura', $this->session->userdata('rutUsuario'));
		$res=$this->db->get();

		foreach($res->result_array() as $key){
		$id_jefe=$key["id"];
		$this->db->select('rut');
		$this->db->from('usuario');
		$this->db->where('nombre_jefatura', $id_jefe);
		$res2=$this->db->get();

		foreach($res2->result_array() as $key2){
			$temp = array();
			$this->db->select('s.id as id,
				u.primer_nombre as primer_nombre,
				u.segundo_nombre as segundo_nombre,
				u.apellido_paterno as apellido_paterno,
				u.apellido_materno as apellido_materno,
				s.rut_usuario as rut_usuario,
				s.fecha_inicio as fecha_inicio,
				s.fecha_termino as fecha_termino,
				s.fecha_solicitud as fecha_solicitud,
				s.fecha_aprobacion as fecha_respuesta,
				s.estado as estado,
				s.enviada as enviada,
				s.archivo_aprobacion as archivo');
			$this->db->from('solicitudes_vacaciones as s');
			$this->db->join('usuario as u', 's.rut_usuario = u.rut', 'left');
			$this->db->where('s.rut_usuario',$key2["rut"]);
			$this->db->order_by('s.estado', 'asc');
			$this->db->order_by('s.fecha_solicitud', 'asc');
			$res3=$this->db->get();		
			foreach($res3->result_array() as $key3){
				$temp = array();
    			$temp["id"] =$key3["id"];
    			$temp["usuario"] =$key3["primer_nombre"]." ".$key3["apellido_paterno"]." ".$key3["apellido_materno"];
    			$temp["rut_usuario"] =$key3["rut_usuario"];
    			$temp["fecha_inicio"] =$key3["fecha_inicio"];
    			$temp["fecha_termino"] =$key3["fecha_termino"];
    			$temp["fecha_solicitud"] =$key3["fecha_solicitud"];
    			$temp["fecha_respuesta"] =$key3["fecha_respuesta"];
    			$temp["estado"] =$key3["estado"];
    			$temp["enviada"] =$key3["enviada"];
    			$temp["archivo"] =$key3["archivo"];
    			$array[] = $temp;	
			}	
		 }
	   }
	   return $array;
	}

	public function getSolicitudesIndividual($usuario){
		$this->db->select('s.id as id,
			u.primer_nombre as primer_nombre,
			u.segundo_nombre as segundo_nombre,
			u.apellido_paterno as apellido_paterno,
			u.apellido_materno as apellido_materno,
			s.rut_usuario as rut_usuario,
			s.fecha_inicio as fecha_inicio,
			s.fecha_termino as fecha_termino,
			s.fecha_solicitud as fecha_solicitud,
			s.estado as estado');
		$this->db->from('solicitudes_vacaciones as s');
		$this->db->join('usuario as u', 's.rut_usuario = u.rut', 'left');
		$this->db->where('s.rut_usuario',$usuario);
		$this->db->where('s.estado',2);
		$this->db->order_by('s.fecha_solicitud', 'asc');
		$res=$this->db->get();		
		if ($res->num_rows()>0) {
			return $res->result_array();
		}
		return FALSE;
	}
	
	public function reporteUsuarios(){
		$this->db->select('s.id as id,
			u.primer_nombre as primer_nombre,
			u.segundo_nombre as segundo_nombre,
			u.apellido_paterno as apellido_paterno,
			u.apellido_materno as apellido_materno,
			s.rut_usuario as rut_usuario,
			s.fecha_inicio as fecha_inicio,
			s.fecha_termino as fecha_termino,
			s.fecha_solicitud as fecha_solicitud,
			s.fecha_aprobacion as fecha_respuesta,
			s.estado as estado');
		$this->db->from('solicitudes_vacaciones as s');
		$this->db->join('usuario as u', 's.rut_usuario = u.rut', 'left');
		$this->db->where('s.estado',2);
		$this->db->order_by('s.fecha_solicitud', 'asc');
		$res=$this->db->get();		
		if ($res->num_rows()>0) {
			return $res->result_array();
		}
		return FALSE;
	}


	public function actualizarEstadoSolicitud($id,$data){
		$this->db->where('id', $id);
	    if($this->db->update('solicitudes_vacaciones', $data)){
	    	return TRUE;
	    }
	    return FALSE;
	}
	
}
