<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DocumentacionModel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

 	public function getArchivosPrevencion(){
		$this->db->order_by("id","desc");
		$this->db->where('categoria', "prevencion");
		$res=$this->db->get("documentacion");
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	} 

	public function getArchivosOperaciones(){
		$this->db->order_by("id","desc");
		$this->db->where('categoria', "operaciones");
		$res=$this->db->get("documentacion");
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	} 

	public function nuevoArchivoPrevencion($data){
		if($this->db->insert('documentacion', $data)){
			return TRUE;
		}
		return FALSE;
	}

	public function getArchivoData($id){
		$this->db->where('id', $id);
		$res=$this->db->get("documentacion");
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function eliminarArchivoPrevencion($id){
		$this->db->where('id', $id);
		$res=$this->db->get('documentacion');
		if($res->num_rows()>0){
			$this->db->delete('documentacion',array('id' => $id));
			return TRUE;
		}
		return FALSE;
	}


}

/* End of file homeModel.php */
/* Location: ./application/models/front_end/homeModel.php */