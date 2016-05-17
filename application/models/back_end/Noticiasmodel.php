<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NoticiasModel extends CI_Model {

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

	public function getNoticias(){
		$this->db->order_by("id","desc");
		$res=$this->db->get("noticias");
		return $res->result_array();
	}

	
	public function nuevaNoticia($data){
	if ($this->db->insert("noticias",$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function eliminarNoticia($id){
		$res=$this->db->query("select imagen from noticias where id=".$id);
		$row=$res->row_array();
		if (file_exists('./assets/imagenes/noticias/'.$row["imagen"])){
			unlink('./assets/imagenes/noticias/'.$row["imagen"]);
		}
		
		if (file_exists('./assets/imagenes/noticias/min_'.$row["imagen"])){
			unlink('./assets/imagenes/noticias/min_'.$row["imagen"]);
		}
	
		$this->db->select()->from("noticias")->where("id",$id);
		$res=$this->db->get();

		$res2=$this->db->query("select imagen from galeria where id_noticia=".$id);
		
		foreach($res2->result_array() as $galeria){
			@unlink('./assets/imagenes/noticias/'.$galeria["imagen"]);
			@unlink('./assets/imagenes/noticias/min_'.$galeria["imagen"]);
			$this->db->delete('galeria', array('id_noticia' => $id));
		
		}

		if ($res->num_rows()>0) {
			  $this->db->delete('noticias', array('id' => $id));
			  return TRUE;
		}else{
			  return FALSE;
		}	
	}

	public function modificarnoticia($id,$data){
		$this->db->where('id', $id);
	    $this->db->update('noticias', $data); 
	    //echo  $this->db->last_query();
	}

	public function getImagen($id){
		$res = $this->db->get_where('noticias', array('id' => $id));
		return $res->result_array();
	}

	public function not_check($n){
		$this->db->select("titulo");
		$this->db->where("titulo",$n);
		$res=$this->db->get("noticias");
		if ($res->num_rows()>0) {
	        return TRUE;	
	    }else{
			return FALSE;
		}
	}

	public function not_check_mod($n,$id){
		$this->db->where('id <>', $id); 
		$this->db->where('titulo =', $n);
		$res=$this->db->get("noticias");
		if ($res->num_rows()>0) {
	        return TRUE;	
	    }else{
			return FALSE;
		}
	}

	public function getGaleria($id){

		$this->db->select('n.id as id,g.id_noticia as idnoticia,g.id as idgaleria,g.titulo as titulo,g.imagen as imagen');
		$this->db->from('noticias as n');
		$this->db->join('galeria as g', 'n.id = g.id_noticia','inner');
		$this->db->where('g.id_noticia',$id);
		$this->db->order_by("g.id","desc");
		$res = $this->db->get();
	 	return $res->result_array();
	}

	public function getGaleriaImg($id){
		$this->db->select("imagen")->from("galeria")->where("id",$id);
		$res = $this->db->get();
		return $res->result_array();
	}

	public function addGaleria($data){
		if ($this->db->insert("galeria",$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function eliminarGaleriaImg($id){
		if($this->db->delete('galeria', array('id' => $id))){
			return true;
		}else{
			return false;
		}
	}










}

