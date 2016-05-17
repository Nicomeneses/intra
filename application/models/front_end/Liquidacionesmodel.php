<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LiquidacionesModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Santiago");  
	}

	public function insertarVisita($data){
		if($this->db->insert('visitas', $data)){
			return TRUE;
		}
		return FALSE;
	}
	
	public function ingresarLiquidacion($data){
		if($this->db->insert('lsp_rrhh', $data)){
			return TRUE;
		}
		return FALSE;
	} 

	public function actualizarLiquidacion($id,$data){
		$this->db->where('id', $id);
	    if($this->db->update('lsp_rrhh', $data)){
	    	return TRUE;
	    }
	    return FALSE;
	}

	public function existeLiqu($archivo){
		$this->db->select('id');	
		$this->db->from('lsp_rrhh');
		$this->db->where('nombre_archivo_PDF_jefe_seccion', $archivo);
		$res=$this->db->get();
		if($res->num_rows()>0){
			$row=$res->row_array();
			return $row["id"];
		}
		return FALSE;
	}

	public function getLiquidaciones(){
		$this->db->select('
				u.primer_nombre as pn,u.segundo_nombre as sn,u.apellido_paterno as ap,
				us.primer_nombre as pne,us.segundo_nombre as sne,us.apellido_paterno as ape,
				u.rut as rut_usuario,
				l.periodo as periodo,
				l.nombre_carpeta_jefe_seccion as carpeta,
				l.archivo_PDF_emitido_jefe_seccion as archivo,
				c.cargo as cargo,
				a.nivel_acceso as nivel_acceso,
				a.perfil_web as perfil_web
				');
		$this->db->from('lsp_rrhh as l');	
		$this->db->join('usuario as u', 'l.rut_usuario = u.rut', 'left');
		$this->db->join('usuario as us', 'l.rut_jefe_seccion = us.rut', 'left');
		$this->db->join('acceso as a', 'a.rut_usuario_acceso = u.rut', 'left');	
		$this->db->join('mantenedor_cargo as c', 'c.id = u.id_cargo', 'left');		
		$this->db->order_by('l.id', 'desc');
		///$this->db->group_by('rut');
		$res=$this->db->get();
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}


	
	public function getMisLiquidaciones($rut){
		$this->db->select('l.id as id,
			l.nombre_archivo_PDF_jefe_seccion as archivo,
			l.nombre_carpeta_jefe_seccion as carpeta,
			l.periodo as periodo');	
		$this->db->from('lsp_rrhh as l');
		$this->db->where('rut_usuario', $rut);
		$this->db->order_by('id', 'desc');
		$res=$this->db->get();
		if($res->num_rows()>0){
			return $res->result_array();
		}
	}

	public function getLiquidacionesJefe($rut){
		$this->db->select('id')->from("mantenedor_nombrejefatura")->where("rut_jefatura",$rut);
		$res=$this->db->get();

		if ($res->num_rows()>0) {
			foreach ($res->result_array() as $key) {
				$id=$key["id"];
			}
		}else{
			return FALSE;
		}

		$this->db->select('
				u.primer_nombre as pn,u.segundo_nombre as sn,u.apellido_paterno as ap,
				u.rut as rut_usuario,
				l.periodo as periodo,
				l.nombre_carpeta_jefe_seccion as carpeta,
				l.archivo_PDF_emitido_jefe_seccion as archivo,
				c.cargo as cargo,
				a.nivel_acceso as nivel_acceso,
				a.perfil_web as perfil_web,
				j.nombre_jefe as jefe
				');
		
		
		$this->db->from('usuario as u');	
		$this->db->join('lsp_rrhh as l', 'l.rut_usuario = u.rut', 'left');
		$this->db->join('acceso as a', 'a.rut_usuario_acceso = u.rut', 'left');	
		$this->db->join('mantenedor_nombrejefatura as j', 'j.id = u.nombre_jefatura', 'left');	
		$this->db->join('mantenedor_cargo as c', 'c.id = u.id_cargo', 'left');		
		$this->db->order_by('l.id', 'desc');
		$this->db->where('u.nombre_jefatura', $id);
		$this->db->where('u.estado', "Activo");
		$this->db->order_by('l.id', 'desc');
		$res=$this->db->get();
		return $res->result_array();
	}

	public function getPersonalPorUsuario($rut){
		$this->db->select('id')->from("mantenedor_nombrejefatura")->where("rut_jefatura",$rut);
		$res=$this->db->get();

		if ($res->num_rows()>0) {
			foreach ($res->result_array() as $key) {
				$id=$key["id"];
			}
		}else{
			return false;
		}

		$this->db->select('
				u.primer_nombre as pn,u.segundo_nombre as sn,u.apellido_paterno as ap,
				u.rut as rut_usuario,
				l.periodo as periodo,
				l.nombre_carpeta_jefe_seccion as carpeta,
				l.archivo_PDF_emitido_jefe_seccion as archivo,
				c.cargo as cargo,
				a.nivel_acceso as nivel_acceso,
				a.perfil_web as perfil_web,
				j.nombre_jefe as jefe
				');

		$this->db->from('usuario as u');	
		$this->db->join('lsp_rrhh as l', 'l.rut_usuario = u.rut', 'left');
		$this->db->join('acceso as a', 'a.rut_usuario_acceso = u.rut', 'left');	
		$this->db->join('mantenedor_nombrejefatura as j', 'j.id = u.nombre_jefatura', 'left');	
		$this->db->join('mantenedor_cargo as c', 'c.id = u.id_cargo', 'left');		
		$this->db->order_by('l.id', 'desc');
		$this->db->where('u.nombre_jefatura', $id);
		$this->db->where('u.estado', "Activo");
		///$this->db->group_by('rut');
		$res=$this->db->get();	
		//return $res->num_rows();exit;
		//return $this->db->last_query();
		return $res->result_array();
	}

	public function datalist($nombre){
		$blanco = " ' ' ";	
		$res=$this->db->query('select CONCAT(primer_nombre,'.$blanco.',segundo_nombre,'.$blanco.',apellido_paterno,'.$blanco.',apellido_materno) as nombre_completo 
			FROM usuario 
			WHERE estado="Activo" and CONCAT(primer_nombre,'.$blanco.',segundo_nombre,'.$blanco.',apellido_paterno,'.$blanco.',apellido_materno)
			LIKE "%'.$nombre.'%"');
		return $res->result_array();
	}

	public function getDataDatalist($nombre){
		$blanco = " ' ' ";	
		$res=$this->db->query('select u.rut,a.area_km as area
		FROM usuario as u
		LEFT JOIN mantenedor_areakm as a ON u.id_areakm=a.id
		WHERE u.estado="Activo" and CONCAT(u.primer_nombre,'.$blanco.',u.segundo_nombre,'.$blanco.',u.apellido_paterno,'.$blanco.',u.apellido_materno) ="'.$nombre.'"');
		return $res->result_array();
	}


	public function getNombreByRut($rut){
		$this->db->select('primer_nombre,segundo_nombre,apellido_paterno,apellido_materno');
		$this->db->where('rut', $rut);
		$res=$this->db->get('usuario');
		foreach($res->result_array() as $key){
			$nombre=$key["primer_nombre"]." ".$key["segundo_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"];
		}
		return $nombre;
	}

}
