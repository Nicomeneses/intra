<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NacimientosModel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getImagenUsuario($rut){
		$this->db->select('adjuntar_foto');
		$this->db->where('rut', $rut);
		$res=$this->db->get('usuario');
		$row=$res->row_array();
		return $row["adjuntar_foto"];
	}

	public function getNacimientos(){
		$this->db->select("u.primer_nombre as nombres,
			u.apellido_materno as apellidos,
			n.id as id,
			n.rut_usuario as rut,
			n.esposa as esposa,
			n.hijo as hijo,
			n.fecha as fecha,
			n.imagen as imagen,
			n.comentarios as comentario");
		$this->db->from("nacimientos as n");
		$this->db->join("usuario as u","u.rut = n.rut_usuario","left");
		$this->db->order_by("n.id","desc");
		$res=$this->db->get();
		if ($res->num_rows()>0) {
			return $res->result_array();
		}
		return false;
	}

	public function nuevoNacimiento($data){
		if ($this->db->insert("nacimientos",$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function eliminanacimiento($id){
		$res=$this->db->query("select imagen from nacimientos where id=".$id);
		$row=$res->row_array();
		if (file_exists('./assets/imagenes/nacimientos/'.$row["imagen"])){
			unlink('./assets/imagenes/nacimientos/'.$row["imagen"]);
		}
		
		if (file_exists('./assets/imagenes/nacimientos/min_'.$row["imagen"])){
			unlink('./assets/imagenes/nacimientos/min_'.$row["imagen"]);
		}
	
		$this->db->select()->from("nacimientos")->where("id",$id);
		$res=$this->db->get();

		if ($res->num_rows()>0) {
			  $this->db->delete('nacimientos', array('id' => $id));
			  return TRUE;
		}else{
			  return FALSE;
		}	
	}

	public function getImagen($id){
		$res = $this->db->get_where('nacimientos', array('id' => $id));
		return $res->result_array();
	}

	public function modificarnacimiento($id,$data){
		$this->db->where('id', $id);
	    if($this->db->update('nacimientos', $data)){
	    	return TRUE;
	    }else{
	    	return FALSE;
	    }
	}


}
