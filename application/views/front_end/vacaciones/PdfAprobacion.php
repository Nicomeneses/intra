<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>COMPROBANTE DE FERIADO</title>
<style type="text/css">
body{
	font-family: Arial,Helvetica Neue,Helvetica,sans-serif; 
	font-size: 14px;
}
.container{
	width: 550px;
	margin: 0 auto;
}
h4{
	font-size: 15px;
	margin-top: 20px!important;
}
.fecha_solicitud{
	display: block;
	margin-left: 400px;
	font-weight: bold;
	font-size: 13px;
}
.firmaemp{
position: absolute;
}
.firmatra{
position: absolute;
margin-left: 410px; 
}
</style>
</head>

<body>
<?php

foreach($data as $dato){
$date1 = new DateTime($dato["fecha_inicio"]);
$date2 = new DateTime($dato["fecha_termino"]);
$days = $date1->diff($date2, true)->days;
$interval = $date1->diff($date2);
$diff=$interval->days;
$domingos = intval($days / 7) + ($date1->format('N') + $days % 7 >= 7);
$sabados = count(getDiasEntreFechas($dato["fecha_inicio"], $dato["fecha_termino"],6));
$dias_finde=(int)$sabados+(int)$domingos;
$vacaciones=$diff+1-$dias_finde;
$total_dias=(int)$dias_finde+(int)$vacaciones;
?>
<div class="container">
  <img style="margin-bottom:30px;" src="./assets/imagenes/logopdf.png" width="170px" height="52px">
	<center><h4>COMPROBANTE DE FERIADO</h4></center>
	<span class="fecha_solicitud"><?php echo date_to_str_full($dato["fecha_solicitud"]);?></span>

	<p>En cumplimiento a las disposiciones legales vigentes se deja constancia que a contar</p>

	<p>del d&iacute;a <b><?php echo date_to_str_full($dato["fecha_inicio"]);?></b> hasta el <b><?php echo date_to_str_full($dato["fecha_termino"]);?></b>, </p>

	<p><b><?php echo ucfirst(utf8_encode($dato["nombre"]));?></b> har&aacute; uso de su feriado anual con remuneraci&oacute;n integra.</p>
	<br>

	<table border="0" width="90%">
		<tr><td width="40%">Vacaciones</td><td width="60%"><?php echo $vacaciones;?></td></tr>
		<tr><td width="40%">Sabados y Domingos</td><td width="60%"><?php echo $dias_finde;?></td></tr>
		<tr><td width="40%">Total d&iacute;as</td><td width="60%"><?php echo $total_dias;?></td></tr>
	</table>
<!-- 	<p>Vacaciones &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <?php echo $vacaciones;?></p>
	<p>Sabados y Domingos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<?php echo $dias_finde;?></p>
	<p>Vacaciones progresivas &nbsp;&nbsp;&nbsp;&nbsp; 
	</p>
	<p>Total d&iacute;as &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $total_dias;?></p> -->

	<br><br><br>
	<div class="firmaemp">
		<p>____________________</p>
		<p style="margin-left:23px;">Firma Empleador</p>
	</div>
    
    <div class="firmatra">
		<p>____________________</p>
		<p style="margin-left:23px;">Firma Trabajador</p>
	</div>

	<?php
	}
	?>
</div>
</body>
</html>