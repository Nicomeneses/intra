<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>

<table border="0" width="90%">

<tr><td colspan="2">
<img src="<?php echo base_url()?>assets/imagenes/logopdf.png" width="220px" height="68px" align="left">
</td></tr>


<tr><td colspan="2">
<h2 style="float:left;font:bold 1.6em/1.2em Arial;color: #000;margin-top:10px;">Respuesta a solicitud de vacaciones de "<?php echo $nombre;?>"</h2></td>
</tr>
<tr><td colspan="2">
<p style="float:left;font:bold 1.1em/1.2em Arial;color: #999;margin-top:5px;"> 
<?php 
echo $msg;
?>
</p></td></tr>

<tr><td width="20%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
Fecha Solicitud </p></td><td width="80%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
<?php echo revierte_fecha($fecha_solicitud)?>
</p></td>
</td></tr>

<tr><td width="20%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
Fecha Inicio </p></td><td width="80%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
<?php echo revierte_fecha($fecha_inicio)?>
</p></td>
</td></tr>

<tr><td width="20%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
Fecha T&eacute;rmino </p></td><td width="80%">
<p style="font:bold 1.1em/1.2em Arial;color: #999;">
<?php echo revierte_fecha($fecha_termino)?>
</p></td>
</td></tr>


</table>

</body>
</html>	


