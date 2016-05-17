<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeModel extends CI_Model {

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
	
	public function getNoticias(){
		$this->db->order_by("id","desc");
		$res=$this->db->get("noticias",3);
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function getUsers(){
		$this->db->select('rut,primer_nombre,segundo_nombre,apellido_paterno,apellido_materno');
		$this->db->where('estado', "Activo");
		$this->db->order_by('primer_nombre', 'asc');
		$res=$this->db->get("usuario");
		if($res->num_rows()>0){
			$array=array();
			foreach($res->result_array() as $key){
				$temp=array();
				$temp["id"]=$key["rut"];
				$temp["text"]=$key["primer_nombre"]." ".$key["segundo_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"];
				$array[]=$temp;
			}
			return json_encode($array);
		}
		return FALSE;
	}

	public function getUserData($rut){
		$this->db->select('a.area_km as area,s.nombre as sucursal,u.correo,u.fono_celular,u.fono_domicilio,u.celular_empresa');
		$this->db->from('usuario as u');
		$this->db->join('mantenedor_areakm as a', 'a.id = u.id_areakm', 'left');
		$this->db->join('sucursales as s', 's.id = u.id_sucursal', 'left');
		$this->db->where('u.rut', $rut);
		$res=$this->db->get();
		if ($res->num_rows()>0) {
			return $res->result_array();
		}
		return FALSE;
	}

	public function cargarMasNoticias($ultimo){
		$this->db->where('id <',$ultimo);
		$this->db->order_by('id','desc');
		$res = $this->db->get('noticias', 3);
		if($res->num_rows()>0){
			return $res->result_array();
		}	
		return false;
	}

	public function getAnioCumpleanios(){
		$this->db->query("select fecha_nacimiento from usuario");
		return $res->result_array();
	}

	public function getCumpleaniosMes(){
		$fecha_actual=date("Y-m-d");
		$start=date('m-d', strtotime($fecha_actual. ' - 7 days'));
		$end=date('m-d', strtotime($fecha_actual. ' + 20 days'));

		$sql="select u.rut as rut,
			u.primer_nombre as primer_nombre,
			u.apellido_paterno as apellido_paterno,
			u.apellido_materno as apellido_materno,
			u.fecha_nacimiento as fecha_nacimiento,
			u.adjuntar_foto as adjuntar_foto,
			suc.nombre as ciudad,
			mc.cargo as cargo,
			ma.area_km as area_km,
			pr.proyecto as proyecto,
			mj.nombre_jefe as jefe
			from usuario as u
			left join mantenedor_cargo as mc ON u.id_cargo = mc.id	
			left join sucursales as suc ON u.id_sucursal = suc.id	
			left join mantenedor_nombrejefatura as mj ON u.nombre_jefatura = mj.id	
			left join mantenedor_areakm as ma ON u.id_areakm = ma.id	
			left join mantenedor_proyecto as pr ON u.id_proyecto = pr.id	
			where estado='Activo' 
			and SUBSTRING(u.fecha_nacimiento,6,10) between '".$start."' and '".$end."'
		    order by SUBSTRING(u.fecha_nacimiento,6,10) asc";
		$res=$this->db->query($sql);
		return $res->result_array();
	}	

	public function getContratos(){
		$this->db->select("
			u.rut as rut,
			u.primer_nombre as primer_nombre,
			u.apellido_paterno as apellido_paterno,
			u.apellido_materno as apellido_materno,
			u.fecha_ingreso_km as fecha_ingreso_km,
			u.adjuntar_foto as adjuntar_foto,
			u.fecha_ingreso_km as fecha_ingreso_km,
			suc.nombre as ciudad,
			mj.nombre_jefe as jefe,
			mc.cargo as cargo,
			ma.area_km as area_km,
			pr.proyecto as proyecto");			

		$this->db->from('usuario as u');
		$this->db->join('mantenedor_cargo as mc', 'u.id_cargo = mc.id', 'left');
		$this->db->join('sucursales as suc', 'u.id_sucursal = suc.id', 'left');
		$this->db->join('mantenedor_nombrejefatura as mj', 'u.nombre_jefatura = mj.id', 'left');
		$this->db->join('mantenedor_areakm as ma', 'u.id_areakm = ma.id', 'left');
		$this->db->join('mantenedor_proyecto as pr', 'u.id_proyecto = pr.id', 'left');
		$this->db->where("u.estado","Activo");
		$this->db->where("u.fecha_ingreso_km !=","NULL");
		$this->db->where("u.fecha_ingreso_km !=","0000-00-00");
		$this->db->order_by('u.fecha_ingreso_km','desc');
		$this->db->distinct();
		$res = $this->db->get('usuario',15);
		//echo $this->db->last_query();exit;
		if($res->num_rows()>0){
			return $res->result_array();
		}	
		return false;
	}

	public function getNacimientos(){
		$this->db->select("n.rut_usuario as rut,n.id as id,
			n.esposa as esposa,
			n.hijo as hijo,
			n.fecha as fecha,
			n.imagen as imagen,
			n.comentarios as comentarios,
			u.primer_nombre  as primer_nombre,
			u.apellido_paterno as apellido_paterno,
			u.apellido_materno as apellido_materno,
			u.adjuntar_foto as foto,
			mc.cargo as cargo,
			ma.area_km as area,
			pr.proyecto as proyecto
			");
		$this->db->from("nacimientos as n");
		$this->db->join("usuario as u","u.rut = n.rut_usuario","left");
		$this->db->join('mantenedor_cargo as mc', 'u.id_cargo = mc.id', 'left');
		$this->db->join('mantenedor_areakm as ma', 'u.id_areakm = ma.id', 'left');
		$this->db->join('mantenedor_proyecto as pr', 'u.id_proyecto = pr.id', 'left');
		$this->db->where('estado', 'Activo');
		$this->db->order_by("n.id","desc");
		$this->db->limit(20);
		$this->db->distinct();
		$res=$this->db->get();
		return $res->result_array();
	}

	public function enviar_comentario_not($data){
		if($this->db->insert('comentarios_noticias', $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function getComentarios_not($id){
		$this->db->select('not.id as id,
			not.id_noticia as id_noticia,
			not.rut_usuario as rut_usuario,
			not.fecha as fecha,
			not.comentario as comentario,
			u.primer_nombre as pn,u.apellido_paterno as app,
			u.adjuntar_foto as imagen
			');
		$this->db->from('comentarios_noticias as not');
		$this->db->join('noticias as n', 'n.id = not.id_noticia', 'left');
		$this->db->join('usuario as u', 'u.rut = not.rut_usuario', 'left');
		$this->db->where("id_noticia", $id);
		$this->db->order_by('fecha', 'desc');
		$res=$this->db->get();
		//return $this->db->last_query();
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function eliminar_comentario_not($id){
		$this->db->select("id");
		$this->db->where('id', $id);
		$res=$this->db->get('comentarios_noticias');
		if($res->num_rows()>0){
			$this->db->delete('comentarios_noticias',array('id' => $id));
			return TRUE;
		}
		return FALSE;
	}

	public function getComentarios_cumple($rut){
		$this->db->select('cu.id as id,
			cu.rut_cumple as rut_cumple,
			cu.rut_comenta as rut_comenta,
			cu.fecha as fecha,
			cu.comentario as comentario,
			u.primer_nombre as pn,u.apellido_paterno as app,
			u.adjuntar_foto as imagen
			');
		$this->db->from('comentarios_cumple as cu');
		$this->db->join('usuario as u', 'u.rut = cu.rut_comenta', 'left');
		$this->db->where("rut_cumple", $rut);
		$this->db->order_by('fecha', 'desc');
		$res=$this->db->get();
		//return $this->db->last_query();
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function enviar_comentario_cumple($data){
		if($this->db->insert('comentarios_cumple', $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

    public function eliminar_comentario_cumple($id){
		$this->db->select("id");
		$this->db->where('id', $id);
		$res=$this->db->get('comentarios_cumple');
		if($res->num_rows()>0){
			$this->db->delete('comentarios_cumple',array('id' => $id));
			//return TRUE;
		}
		return FALSE;
	}

	public function getComentarios_ing($rut){
		$this->db->select('ci.id as id,
			ci.rut_ing as rut_ing,
			ci.rut_comenta as rut_comenta,
			ci.fecha as fecha,
			ci.comentario as comentario,
			u.primer_nombre as pn,u.apellido_paterno as app,
			u.adjuntar_foto as imagen
			');
		$this->db->from('comentarios_ingresos as ci');
		$this->db->join('usuario as u', 'u.rut = ci.rut_comenta', 'left');
		$this->db->where("rut_ing", $rut);
		$this->db->order_by('fecha', 'desc');
		$res=$this->db->get();
		//return $this->db->last_query();
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function enviar_comentario_ing($data){
		if($this->db->insert('comentarios_ingresos', $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function eliminar_comentario_ing($id){
		$this->db->select("id");
		$this->db->where('id', $id);
		$res=$this->db->get('comentarios_ingresos');
		if($res->num_rows()>0){
			$this->db->delete('comentarios_ingresos',array('id' => $id));
			return TRUE;
		}
		return FALSE;
	}
	
	public function getComentariosNacimientos($id){
		$this->db->select('nc.id as idnac_com,
			nc.id_nacimiento as id_nacimiento,
			nc.rut_usuario as rut_usuario,
			nc.fecha as fecha,
			nc.comentario as comentario,
			u.primer_nombre as pn,u.apellido_paterno as app,
			u.adjuntar_foto as imagen
			');
		$this->db->from('nacimientos_comentarios as nc');
		$this->db->join('nacimientos as n', 'n.id = nc.id_nacimiento', 'left');
		$this->db->join('usuario as u', 'u.rut = nc.rut_usuario', 'left');
		$this->db->where("id_nacimiento", $id);
		$this->db->order_by('fecha', 'desc');
		$res=$this->db->get();
		//return $this->db->last_query();
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function enviar_comentario($data){
		if($this->db->insert('nacimientos_comentarios', $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function eliminar_comentario_nac($id){
		$this->db->select("id");
		$this->db->where('id', $id);
		$res=$this->db->get('nacimientos_comentarios');
		if($res->num_rows()>0){
			$this->db->delete('nacimientos_comentarios',array('id' => $id));
			return TRUE;
		}
		return FALSE;
	}

	
	public function login($user,$pass){
		$this->db->select("rut");
		$this->db->where("rut",$user);
		$this->db->where("estado","Activo");
		$resuser=$this->db->get("usuario");
		
		if($resuser->num_rows()>0){
			$this->db->select("primer_nombre,apellido_paterno,rut,correo,contrasena");		
			$this->db->where("rut",$user);
			$this->db->where("contrasena",$pass);
			$resuserpass=$this->db->get("usuario");
			$rowusuario=$resuserpass->row();

				if($resuserpass->num_rows()>0){

					$this->db->select("nivel_acceso,perfil_web");
					$this->db->where("rut_usuario_acceso",$user);
					$resperfil=$this->db->get("acceso");
					$rowperfil=$resperfil->row();	

					$this->session->set_userdata("nombresUsuario",$rowusuario->primer_nombre);	
					$this->session->set_userdata("apellidosUsuario",$rowusuario->apellido_paterno);	
					$this->session->set_userdata("rutUsuario",$rowusuario->rut);	
					$this->session->set_userdata("correo",$rowusuario->correo);
					$this->session->set_userdata("tipo",$rowperfil->nivel_acceso);	
					$this->session->set_userdata("perfil",$rowperfil->perfil_web);	
					$this->session->set_userdata("ultimoacceso",date("Y-n-j H:i:s"));	

                    $dataInsert=array("usuario"=>$rowusuario->primer_nombre." ".$rowusuario->apellido_paterno,
                    	"fecha"=>date("Y-m-d G:i:s"),
                    	"navegador"=>"navegador :".$this->agent->browser()."\nversion :".$this->agent->version()."\nos :".$this->agent-> platform()."\nmovil :".$this->agent->mobile(),
                    	"ip"=>$this->input->ip_address(),
                    	"pagina"=> $this->uri->segment("1")
                    	);
                    $this->db->insert("visitas",$dataInsert);
				 return 1;//OK
				}else{
					return 3;//contrasena incorrecta
				}
		}else{
			return 2;//usuario no existe
		}
	}


	public function getUserPass($rut){
		$this->db->select("contrasena");
		$this->db->where("rut",$rut);
		$this->db->where("estado","Activo");
		$res=$this->db->get("usuario");
		return $res->row_array();
	}

	public function updatePass($rut,$data){
		$this->db->where('rut', $rut);
	    if($this->db->update('usuario', $data)){
	    	return TRUE;
	    }else{
	    	return FALSE;
	    }
	}

	public function getCorreo($r){
		$this->db->select("correo");
		$this->db->where("rut",$r);
		$this->db->where("estado","Activo");
		$res=$this->db->get("usuario");
		foreach($res->result_array() as $row){
			return $row["correo"];
		}
	}

	public function getRut($r){
		$this->db->select("rut");
		$this->db->where("rut",$r);
		$this->db->where("estado","Activo");
		$res=$this->db->get("usuario");
		foreach($res->result_array() as $row){
			return $row["rut"];
		}
	}

	public function recuperarpass($rut,$data){
		$this->db->where('rut', $rut);
	    if($this->db->update('usuario', $data)){
	    	return TRUE;
	    }else{
	    	return FALSE;
	    }
	}

	/*public function l(){
		$res=$this->db->query("select primer_nombre,apellido_paterno,rut from usuario2");
		foreach($res->result_array() as $key){
			//echo $key["primer_nombre"]."<br>";
			$n=explode(" ",$key["primer_nombre"]);
			$n1=$n[0];$n2=$n[1];

			$a=explode(" ",$key["apellido_paterno"]);
			$a1=$a[0];$a2=$a[1];

			if ($a[0]!=null and $a[1]!=null and $n1[0]!=null and $n1[1]!=null) {
			$sql="update usuario2 set primer_nombre='".$n1."', segundo_nombre='".$n2."',apellido_paterno='".$a1."', apellido_materno='".$a2."' where rut='119752949'";
			$res=$this->db->query($sql);
			echo $sql."<br>";
			}
		}
	}*/
}

/* End of file homeModel.php */
/* Location: ./application/models/front_end/homeModel.php */