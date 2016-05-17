<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NoticiasModel extends CI_Model {

	public function __construct(){
		parent::__construct();
	
	}

	public function getNoticia($n){
		$this->db->from("noticias");
		$this->db->where("url",$n);
		$this->db->order_by("id","desc");
		$res=$this->db->get();
		return $res->result_array();
	}

	public function getGaleria($id){
		$this->db->where("id_noticia",$id);
		$this->db->order_by("id","desc");
		$res=$this->db->get("galeria");
		return $res->result_array();
	}

	public function getNoticiaId($n){
		$this->db->select("id");
		$this->db->where("url",$n);
		$res=$this->db->get("noticias");
		foreach ($res->result() as $row){
		   return $row->id;
		}
	}

}
