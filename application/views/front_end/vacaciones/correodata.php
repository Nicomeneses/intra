<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<table border="0" width="70%">

<tr><td colspan="2">
<img src="<?php echo base_url()?>assets/imagenes/logopdf.png" width="220px" height="68px" align="left">
</td></tr>

<tr><td colspan="2">
<h2 style="font:bold 1.6em/1.2em Arial;color: #999;margin-top:10px;">
Solicitud de vacaciones de <?php echo $nombre;?>
</h2>
</td></tr>
	
<tr><td width="30%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
Fecha Solicitud </p></td><td width="70%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
<?php echo revierte_fecha($fecha_solicitud)?>
</p></td>
</td></tr>

<tr><td width="30%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
Fecha Inicio </p></td><td width="70%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
<?php echo revierte_fecha($fecha_inicio)?>
</p></td>
</td></tr>

<tr><td width="30%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
Fecha T&eacute;rmino </p></td><td width="70%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
<?php echo revierte_fecha($fecha_termino)?>
</p></td>
</td></tr>

<tr><td colspan="2">
<h4 style="font:bold 1.4em/1.6em Arial;color: #999;margin-top:20px;">
 Gestionar en
<a href="http://intranet.km-telecomunicaciones.cl/login/vacaciones#solicitudes_jefe">Intranet  KM
</a></h4>
</td></tr>

</table>
</body>
</html>	
