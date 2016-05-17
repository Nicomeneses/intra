<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function meses($mes){
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

function getDiasEntreFechas($startDate, $endDate, $weekdayNumber){
    $startDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    $dateArr = array();
    do
    {
        if(date("w", $startDate) != $weekdayNumber)
        {
            $startDate += (24 * 3600); // add 1 day
        }
    } while(date("w", $startDate) != $weekdayNumber);


    while($startDate <= $endDate)
    {
        $dateArr[] = date('Y-m-d', $startDate);
        $startDate += (7 * 24 * 3600); // add 7 days
    }
    return($dateArr);
}

function revierte_fecha($f){
	$f1=explode("-", $f);
	$f2=$f1[2]."-".$f1[1]."-".$f1[0];
	return $f2;
}

function fecha_to_str($fecha){
	$fecha=explode(' ',$fecha);
	$fecha2=$fecha[0];  
	$hora=$fecha[1];  
	$fecha3=explode('-', $fecha2);
	$anio=$fecha3[0];$mes=$fecha3[1];$dia=$fecha3[2];
	return "Creado el ".$dia." de ".meses($mes)." del ".$anio." a las ".$hora;
}

function date_to_str($fecha){
	$fecha=explode('-',$fecha);
	$anio=$fecha[0];
	$mes=$fecha[1]; 
	$dia=$fecha[2]; 
	return $dia." de ".meses($mes);
}

function date_to_str_full($fecha){
	$fecha=explode('-',$fecha);
	$anio=$fecha[0];
	$mes=$fecha[1]; 
	$dia=$fecha[2]; 
	return $dia." de ".meses($mes)." del ".$anio;
}

 function anio($name=FALSE,$class=FALSE){
	 $date=date("Y");	
	 $año='<select name="'.$name.'" class="'.$class.'">';
		$año.='<option value="">Año</option>';
	 	$año.='<option value='.$date.'>'. $date.'</option>';
		$año.='<option value="2013">2013</option>';
	 $año.='</select>';
	 return $año;
}



 function generaMeses($name=FALSE,$class=FALSE){
	 $fecha='<select name="'.$name.'" class="'.$class.'">';	 
	 	$fecha.='<option value="">Mes</option>';
	 for ($i=1; $i <=12 ; $i++) { 
	 	$fecha.='<option value='.$i.'>'.meses($i).'</option>';
	 }
	 $fecha.='</select>';
	 return $fecha;
 }

/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */