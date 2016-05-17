<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeModel extends CI_Model {

	public function __construct(){
		parent::__construct();
	
	}
	public function insertarVisita($data){
		if($this->db->insert('visitas', $data)){
			return TRUE;
		}
		return FALSE;
	}
	public function getImagenUsuario($rut){
		$this->db->select('adjuntar_foto');
		$this->db->where('rut', $rut);
		$res=$this->db->get('usuario');
		$row=$res->row_array();
		return $row["adjuntar_foto"];
	}

	public	function meses($mes){
		switch ($mes) {
			case '1':$mes="Enero";break;
			case '2':$mes="Febrero";break;
			case '3':$mes="Marzo";break;
			case '4':$mes="Abril";break;
			case '5':$mes="Mayo";break;
			case '6':$mes="Junio";break;
			case '7':$mes="Julio";break;
			case '8':$mes="Agosto";break;
			case '9':$mes="Septiembre";break;
			case '10':$mes="Octubre";break;
			case '11':$mes="Noviembre";break;
			case '12':$mes="Diciembre";break;
		}
		return $mes;
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
	
	public function getReporteriadata(){
		$mesanterior=date("m", strtotime("-1 months"));	
		$primer_mes=$mesanterior-3;	

		$temp=array();
		$temp[] = array("Mes","Presentes","Ausencias","Permisos"); 
		for ($j=$primer_mes; $j<=$mesanterior; $j++) { 
				
			$res=$this->db->query("select * 
			FROM asistencia AS a
			LEFT JOIN usuario AS u ON a.rut=u.rut
			WHERE mes='".$j."' and anio = '2016' and 
			estado='Activo' and cod_tecnico<>'' and cod_tecnico LIKE 'K%'
			GROUP BY a.rut");

			$presentes=0;$ausencias=0;$permisos=0;
			$contPT=0;$contAV=0;$contAT=0;$contPF=0;$contPC=0;$contPS=0;$contPA=0;
			$contAL=0;$contPP1=0;$contPP2=0;$contPP3=0;
			$cont=0;

			foreach($res->result_array() as $key){
				$cont++;
				if($key["rut"]!="16698307K" and $key["rut"]!="153479496" and $key["rut"]!="136843281" and $key["rut"]!="160444312" and $key["rut"]!="166578884"){
				for ($i=1; $i <31 ; $i++) { 
						if ($key["dia".$i]=="PT") {$contPT++;}	
						if ($key["dia".$i]=="AT") {$contAT++;}
						if ($key["dia".$i]=="AV") {$contAV++;}
						if ($key["dia".$i]=="PF") {$contPF++;}
						if ($key["dia".$i]=="PC") {$contPC++;}
						if ($key["dia".$i]=="PS") {$contPS++;}
						if ($key["dia".$i]=="PA") {$contPA++;}
						if ($key["dia".$i]=="AL") {$contAL++;}
						if ($key["dia".$i]=="PP1") {$contPP1++;}
						if ($key["dia".$i]=="PP2") {$contPP2++;}
						if ($key["dia".$i]=="PP3") {$contPP3++;}
					}
					$p=($contPT+$contPF+$contPC+$contPS+$contPA);
					$a=($contAT+$contAV+$contAL);
					$pe=($contPP1+$contPP2+$contPP3);
				}
			}
			$temp[] = array($this->meses($j),$p,$a,$pe); 
		}   			
		return json_encode($temp);
	}

	public function getAsisTable(){
		$mesanterior=date("m", strtotime("-1 months"));	
		$res=$this->db->query("select * 
		FROM asistencia AS a
		LEFT JOIN usuario AS u ON a.rut=u.rut
		WHERE mes='".$mesanterior."' and anio = '2016' and 
		estado='Activo' and cod_tecnico<>'' and cod_tecnico LIKE 'K%'
		GROUP BY a.rut");

		$presentes=0;$ausencias=0;$permisos=0;
		$contPT=0;$contAV=0;$contAT=0;$contPF=0;$contPC=0;$contPS=0;$contPA=0;
		$contAL=0;$contPP1=0;$contPP2=0;$contPP3=0;
		$cont=0;
		$rows = array();
		$cols = array();
		$rows[]= array("1","2","3");
		foreach($res->result_array() as $key){
			$cont++;
			if($key["rut"]!="16698307K" and $key["rut"]!="153479496" and $key["rut"]!="136843281" and $key["rut"]!="160444312" and $key["rut"]!="166578884"){
			for ($i=1; $i <31 ; $i++) { 
					if ($key["dia".$i]=="PT") {$contPT++;}	
					if ($key["dia".$i]=="AT") {$contAT++;}
					if ($key["dia".$i]=="AV") {$contAV++;}
					if ($key["dia".$i]=="PF") {$contPF++;}
					if ($key["dia".$i]=="PC") {$contPC++;}
					if ($key["dia".$i]=="PS") {$contPS++;}
					if ($key["dia".$i]=="PA") {$contPA++;}
					if ($key["dia".$i]=="AL") {$contAL++;}
					if ($key["dia".$i]=="PP1") {$contPP1++;}
					if ($key["dia".$i]=="PP2") {$contPP2++;}
					if ($key["dia".$i]=="PP3") {$contPP3++;}
				}
				$p=($contPT+$contPF+$contPC+$contPS+$contPA);
				$a=($contAT+$contAV+$contAL);
				$pe=($contPP1+$contPP2+$contPP3);
			}
		}

		    $temp[] = array("Presentes",$p); 
		    $temp[] = array("Ausencias",$a); 
		    $temp[] = array("Permisos",$pe);	    
		   	$rows[] = $temp;			
			$jsonTable = json_encode($rows);
			return $jsonTable;
	}

	public function getInspeccionesdata(){
		$mesanterior=date("m", strtotime("-1 months"));	

		$res=$this->db->query("SELECT * 
		FROM inspeccion_operaciones
		WHERE MONTH(fecha)=".$mesanterior." and
		YEAR(fecha)=".date("Y")."
		");

		$rec_tec=0;$pro_km=0;$rec_vtr=0;$rec_int=0;$perd_esp=0;
		$rec_dan=0;$rec_mal=0;$tra_red=0;$fac_tec=0;
		$cont=0;

		foreach($res->result_array() as $key){
			$cont++;
			if($key["tipo_inspeccion"]=="Reclamo Técnico"){$rec_tec++;}
			if($key["tipo_inspeccion"]=="Proactiva KM"){$pro_km++;}
			if($key["tipo_inspeccion"]=="Reclamo Territorio VTR"){$rec_vtr++;}
			if($key["tipo_inspeccion"]=="Reclamo Integridad persona"){$rec_int++;}
			if($key["tipo_inspeccion"]=="Perdida de especie"){$perd_esp++;}
			if($key["tipo_inspeccion"]=="Reclamo por daño"){$rec_dan++;}
			if($key["tipo_inspeccion"]=="Reclamo mal ingresado"){$rec_mal++;}
			if($key["tipo_inspeccion"]=="Traspaso a Redes"){$tra_red++;}
			if($key["tipo_inspeccion"]=="Factibilidad Técnica"){$fac_tec++;}
		}

	    $temp[] = array("Mes",$this->meses($mesanterior)); 
	    $temp[] = array("Reclamo Técnico",$rec_tec); 
	    $temp[] = array("Proactiva KM",$pro_km); 
	    $temp[] = array("Reclamo Territorio VTR",$rec_vtr); 
	    $temp[] = array("Reclamo Integridad persona",$rec_int); 
	    $temp[] = array("Perdida de especie",$perd_esp); 
	    $temp[] = array("Reclamo por daño",$rec_dan); 
	    $temp[] = array("Reclamo mal ingresado",$rec_mal); 
	    $temp[] = array("Traspaso a Redes",$tra_red); 
	    $temp[] = array("Factibilidad Técnica",$fac_tec); 
	    $rows = $temp;

		return json_encode($rows);
	}
	//montos en proceso vs montos pagados
	public function getPagosmontosdata(){
		$res=$this->db->query("select * from pagos");

		$impagos = 0;$pagados = 0;
		foreach($res->result_array() as $key){			
		
				if($key['estado']=='Proceso'){
					$impagos = $impagos + $key['monto_neto'];
				}
				if($key['estado']=='Pagado'){
					$pagados = $pagados + $key['monto_neto'];
				}			
			}
			$temp[] = array("Estado","Dinero"); 
		    $temp[] = array("Proceso",$impagos); 
		    $temp[] = array("Pagados",$pagados); 	
		    return json_encode($temp);
	}	
//facturados vs no facturados
	public function getPagosproyectosdata(){
		$res=$this->db->query("select * from pagos");

		$facturados = 0;$sinfactura = 0;
		foreach($res->result_array() as $key){			
		
				if($key['numero_factura']!='0'){
					$facturados ++;
				}else{
					$sinfactura ++;
				}				
			}
			$temp[] = array("Estado","Cantidad"); 
		    $temp[] = array("Facturados",$facturados); 
		    $temp[] = array("Sin Facturar",$sinfactura); 	
		    return json_encode($temp);
	}
	public function getCantidadingresosdata(){
			
		$res=$this->db->query("select id,date(fecha) as fechadate from control_acceso_brisas where date(fecha)  >= now() - interval 8 day  and hora_entrada != '' ");

		$dia1=0;$dia2=0;$dia3=0;$dia4=0;$dia5=0;$dia6=0;$dia7=0;$dia8=0;
		//el numero que sige de fecha es cuantos dias se le resta
	
		$fecha7 = strtotime ( '-7 day' , strtotime ( date('Y-m-d') ) ) ;$fecha7 = date ( 'Y-m-d' , $fecha7 );
		$fecha6 = strtotime ( '-6 day' , strtotime ( date('Y-m-d') ) ) ;$fecha6 = date ( 'Y-m-d' , $fecha6 );
		$fecha5 = strtotime ( '-5 day' , strtotime ( date('Y-m-d') ) ) ;$fecha5 = date ( 'Y-m-d' , $fecha5 );
		$fecha4 = strtotime ( '-4 day' , strtotime ( date('Y-m-d') ) ) ;$fecha4 = date ( 'Y-m-d' , $fecha4 );
		$fecha3 = strtotime ( '-3 day' , strtotime ( date('Y-m-d') ) ) ;$fecha3 = date ( 'Y-m-d' , $fecha3 );
		$fecha2 = strtotime ( '-2 day' , strtotime ( date('Y-m-d') ) ) ;$fecha2 = date ( 'Y-m-d' , $fecha2 );
		$fecha1 = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;$fecha1 = date ( 'Y-m-d' , $fecha1 );
	
		foreach($res->result_array() as $key){	
			
			if($key['fechadate'] == $fecha7){ 	$dia7 ++;	}		
			if($key['fechadate'] == $fecha6){ 	$dia6 ++;	}		
			if($key['fechadate'] == $fecha5){ 	$dia5 ++;	}		
			if($key['fechadate'] == $fecha4){ 	$dia4 ++;	}		
			if($key['fechadate'] == $fecha3){ 	$dia3 ++;	}		
			if($key['fechadate'] == $fecha2){ 	$dia2 ++;	}		
			if($key['fechadate'] == $fecha1){ 	$dia1 ++;	}	
		}			

		$fecha7 = $this->diaesp(date ( 'D' ,  strtotime($fecha7)));
		$fecha6 = $this->diaesp(date ( 'D' ,  strtotime($fecha6)));
		$fecha5 = $this->diaesp(date ( 'D' ,  strtotime($fecha5)));
		$fecha4 = $this->diaesp(date ( 'D' ,  strtotime($fecha4)));
		$fecha3 = $this->diaesp(date ( 'D' ,  strtotime($fecha3)));
		$fecha2 = $this->diaesp(date ( 'D' ,  strtotime($fecha2)));
		$fecha1 = $this->diaesp(date ( 'D' ,  strtotime($fecha1)));

		$temp[] = array("Dias","Ingresos");		   
		$temp[] = array($fecha7,$dia7); 
		$temp[] = array($fecha6,$dia6); 
		$temp[] = array($fecha5,$dia5); 
		$temp[] = array($fecha4,$dia4); 
		$temp[] = array($fecha3,$dia3); 
		$temp[] = array($fecha2,$dia2); 
		$temp[] = array($fecha1,$dia1); 

		return json_encode($temp);		
	}
	public function getCantidadsalidasdata(){
			
		$res=$this->db->query("select id,date(fecha) as fechadate from control_acceso_brisas where date(fecha)  >= now() - interval 8 day  and hora_salida != '' ");

		$dia1=0;$dia2=0;$dia3=0;$dia4=0;$dia5=0;$dia6=0;$dia7=0;$dia8=0;
		//el numero que sige de fecha es cuantos dias se le resta
	
		$fecha7 = strtotime ( '-7 day' , strtotime ( date('Y-m-d') ) ) ;$fecha7 = date ( 'Y-m-d' , $fecha7 );
		$fecha6 = strtotime ( '-6 day' , strtotime ( date('Y-m-d') ) ) ;$fecha6 = date ( 'Y-m-d' , $fecha6 );
		$fecha5 = strtotime ( '-5 day' , strtotime ( date('Y-m-d') ) ) ;$fecha5 = date ( 'Y-m-d' , $fecha5 );
		$fecha4 = strtotime ( '-4 day' , strtotime ( date('Y-m-d') ) ) ;$fecha4 = date ( 'Y-m-d' , $fecha4 );
		$fecha3 = strtotime ( '-3 day' , strtotime ( date('Y-m-d') ) ) ;$fecha3 = date ( 'Y-m-d' , $fecha3 );
		$fecha2 = strtotime ( '-2 day' , strtotime ( date('Y-m-d') ) ) ;$fecha2 = date ( 'Y-m-d' , $fecha2 );
		$fecha1 = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;$fecha1 = date ( 'Y-m-d' , $fecha1 );
	
		foreach($res->result_array() as $key){	
			
			if($key['fechadate'] == $fecha7){ 	$dia7 ++;	}		
			if($key['fechadate'] == $fecha6){ 	$dia6 ++;	}		
			if($key['fechadate'] == $fecha5){ 	$dia5 ++;	}		
			if($key['fechadate'] == $fecha4){ 	$dia4 ++;	}		
			if($key['fechadate'] == $fecha3){ 	$dia3 ++;	}		
			if($key['fechadate'] == $fecha2){ 	$dia2 ++;	}		
			if($key['fechadate'] == $fecha1){ 	$dia1 ++;	}	
		}			

		$fecha7 = $this->diaesp(date ( 'D' ,  strtotime($fecha7)));
		$fecha6 = $this->diaesp(date ( 'D' ,  strtotime($fecha6)));
		$fecha5 = $this->diaesp(date ( 'D' ,  strtotime($fecha5)));
		$fecha4 = $this->diaesp(date ( 'D' ,  strtotime($fecha4)));
		$fecha3 = $this->diaesp(date ( 'D' ,  strtotime($fecha3)));
		$fecha2 = $this->diaesp(date ( 'D' ,  strtotime($fecha2)));
		$fecha1 = $this->diaesp(date ( 'D' ,  strtotime($fecha1)));

		$temp[] = array("Dia","Salidas");		   
		$temp[] = array($fecha7,$dia7); 
		$temp[] = array($fecha6,$dia6); 
		$temp[] = array($fecha5,$dia5); 
		$temp[] = array($fecha4,$dia4); 
		$temp[] = array($fecha3,$dia3); 
		$temp[] = array($fecha2,$dia2); 
		$temp[] = array($fecha1,$dia1); 

		return json_encode($temp);		
	}
   	public function diaesp($dia){
			if($dia == 'Mon'){return 'Lun';}
			if($dia == 'Tue'){return 'Mar';}
			if($dia == 'Wed'){return 'Mier';}
			if($dia == 'Thu'){return 'Jue';}
			if($dia == 'Fri'){return 'Vier';}
			if($dia == 'Sat'){return 'Sab';}
			if($dia == 'Sun'){return 'Dom';}
	}
	public function crearDivisa($data){
		$registros = $this->leerDivisa();
		$fechan = $data['fecha'];		
		if(isset($registros['0']['fecha'])){ $fechaa = $registros['0']['fecha']; }else{$fechaa = '';}
		if($fechan == $fechaa){
			//nada						
		}else{
			$this->db->insert('divisas', $data);				
		}		
	}

	public function leerDivisa(){
		$res = $this->db->query('SELECT * FROM divisas ORDER BY id DESC LIMIT 2;'); 
		return $res->result_array();
	}

	public function leerDivisaAyer(){
		$res = $this->db->query('SELECT * FROM divisas where fecha > date(subdate(current_date, 1)) ORDER BY id ASC LIMIT 2;'); 
		return $res->result_array();
	}
	


	public function reporteVisitasMes($mes){
		$res=$this->db->query("SELECT count(*) as visitas 
			FROM visitas 
			WHERE MONTH(fecha)=".$mes."
			AND YEAR(fecha)=".date("Y")."");
		foreach($res->result_array() as $key){
			$visitas=$key["visitas"];
		}
		return $visitas;
	}

	public function reporteVisitasDia($mes,$dia){
		$res=$this->db->query("SELECT count(*) as visitas 
			FROM visitas 
			WHERE DAY(fecha)=".$dia." 
			AND MONTH(fecha)=".$mes."
			AND YEAR(fecha)=".date("Y")."");
		foreach($res->result_array() as $key){
			$visitas=$key["visitas"];
		}
		return $visitas;
	}

	public function reporteUsuariosAct(){
		$res=$this->db->query("SELECT count(*) as usuarios,fecha_ingreso_km
			FROM usuario 
			WHERE MONTH(fecha_ingreso_km)=".date("m")."
			AND YEAR(fecha_ingreso_km)=".date("Y")."");
		if ($res->num_rows()>0) {
			foreach($res->result_array() as $key){
			$usuarios=$key["usuarios"];
		}
		return $usuarios;
		}else{
			return 0;
		}
	}

	public function reporteUsuariosTotal(){
		$res=$this->db->query("SELECT count(*) as usuarios
			FROM usuario");
			foreach($res->result_array() as $key){
			$usuarios=$key["usuarios"];
		}
		return $usuarios;
		
	}

	public function reporteFlotaEstado(){
		$res=$this->db->query("select patente,estado FROM vehiculos");
		$contop=0;
		$contnoop=0;
		foreach($res->result_array() as $key){
			if($key["estado"]=="si"){
				$contop++;
			}
			if($key["estado"]=="no"){
				$contnoop++;
			}
		}

	    $temp[] = array("Estado","Cantidad"); 
	    $temp[] = array("Operativos",$contop); 
	    $temp[] = array("No operativos",$contnoop); 
	    $rows = $temp;
		$jsonTable = json_encode($rows);
		return $jsonTable;
	}

	public function reporteFlotaAsignados(){
		$res=$this->db->query("select DISTINCT rut_usuario,estado FROM vehiculos_asignacion");
		$cont_asignados=0;$cont_noasignados=0;
		foreach($res->result_array() as $key){
			if($key["estado"]==1){
				$cont_asignados++;
			}
			if($key["estado"]==0){
				$cont_noasignados++;
			}
		}

	    $temp[] = array("Estado","Cantidad"); 
	    $temp[] = array("Asignados",$cont_asignados); 
	    $temp[] = array("No asignados",$cont_noasignados); 
	    $rows = $temp;
		$jsonTable = json_encode($rows);
		return $jsonTable;
	}

//montos en proceso vs montos pagados
	public function getNoticias(){
		$this->db->order_by("id","desc");
		$res=$this->db->get("noticias");
		return $res->result_array();
	}

	public function getVisitas(){
		$this->db->order_by("id","desc");
		$this->db->where('usuario !=', "Ricardo Hernandez");
		$this->db->where('usuario !=', "Ricardo Hernández");
		$res=$this->db->get("visitas");
		return $res->result_array();
	}

	public function getComentariosNoticias(){
		$this->db->select('cn.id as id,
				n.titulo as titulo,
				u.primer_nombre as pn,
				u.apellido_paterno as ap,
				cn.fecha as fecha,
				cn.comentario as comentario	
			');	
		$this->db->from('comentarios_noticias as cn');
		$this->db->join('usuario as u', 'u.rut = cn.rut_usuario', 'left');
		$this->db->join('noticias as n', 'n.id = cn.id_noticia', 'left');
		$this->db->order_by("cn.id","desc");
		$res=$this->db->get();
		return $res->result_array();
	}

	public function modComentarioNoticia($id,$data){
		$this->db->where('id', $id);
	    if($this->db->update('comentarios_noticias', $data)){
	    	return TRUE;
	    }else{
	    	return FALSE;
	    }
	}

	public function eliComentarioNoticia($id){
		$this->db->select()->from("comentarios_noticias")->where("id",$id);
		$res=$this->db->get();
		if ($res->num_rows()>0) {
			  $this->db->delete('comentarios_noticias', array('id' => $id));
			  return TRUE;
		}else{
			  return FALSE;
		}	
	}

	public function getComentariosCumpleanios(){
		$this->db->select('nc.id as id,
				u.primer_nombre as pn,
				u.apellido_paterno as ap,
				nc.fecha as fecha,
				nc.comentario as comentario	
			');	
		$this->db->from('comentarios_cumple as nc');
		$this->db->join('usuario as u', 'u.rut = nc.rut_comenta', 'left');
		$this->db->order_by("nc.id","desc");
		$res=$this->db->get();
		return $res->result_array();
	}

	public function modComentarioCumple($id,$data){
		$this->db->where('id', $id);
	    if($this->db->update('comentarios_cumple', $data)){
	    	return TRUE;
	    }else{
	    	return FALSE;
	    }
	}

	public function eliComentarioCumple($id){
		$this->db->select()->from("comentarios_cumple")->where("id",$id);
		$res=$this->db->get();
		if ($res->num_rows()>0) {
			  $this->db->delete('comentarios_cumple', array('id' => $id));
			  return TRUE;
		}else{
			  return FALSE;
		}	
	}


	public function getComentariosIngresos(){
		$this->db->select('ci.id as id,
				u.primer_nombre as pn,
				u.apellido_paterno as ap,
				ci.fecha as fecha,
				ci.comentario as comentario	
			');	
		$this->db->from('comentarios_ingresos as ci');
		$this->db->join('usuario as u', 'u.rut = ci.rut_comenta', 'left');
		$this->db->order_by("ci.id","desc");
		$res=$this->db->get();
		return $res->result_array();
	}

	public function modComentarioIngreso($id,$data){
		$this->db->where('id', $id);
	    if($this->db->update('comentarios_ingresos', $data)){
	    	return TRUE;
	    }else{
	    	return FALSE;
	    }
	}

	public function eliComentarioIngreso($id){
		$this->db->select()->from("comentarios_ingresos")->where("id",$id);
		$res=$this->db->get();
		if ($res->num_rows()>0) {
			  $this->db->delete('comentarios_ingresos', array('id' => $id));
			  return TRUE;
		}else{
			  return FALSE;
		}	
	}

	public function getComentariosNacimientos(){
		$this->db->select('nac.id as id,
				u.primer_nombre as pn,
				u.apellido_paterno as ap,
				nac.fecha as fecha,
				nac.comentario as comentario	
			');	
		$this->db->from('nacimientos_comentarios as nac');
		$this->db->join('usuario as u', 'u.rut = nac.rut_usuario', 'left');
		$this->db->join('nacimientos as n', 'nac.id_nacimiento = n.id', 'left');
		$this->db->order_by("nac.id","desc");
		$res=$this->db->get();
		return $res->result_array();
	}

	public function modComentarioNacimiento($id,$data){
		$this->db->where('id', $id);
	    if($this->db->update('nacimientos_comentarios', $data)){
	    	return TRUE;
	    }else{
	    	return FALSE;
	    }
	}

	public function eliComentarioNacimiento($id){
		$this->db->select()->from("nacimientos_comentarios")->where("id",$id);
		$res=$this->db->get();
		if ($res->num_rows()>0) {
			  $this->db->delete('nacimientos_comentarios', array('id' => $id));
			  return TRUE;
		}else{
			  return FALSE;
		}	
	}



}

/* End of file homeModel.php */
/* Location: ./application/models/front_end/homeModel.php */