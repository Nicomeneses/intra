<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = "";

/*BACK END*/

$route['admin_webkm/home_admin'] = "back_end/home/index";
$route['admin_webkm/dashboard'] = "back_end/home/index";
$route['admin_webkm/visitas'] = "back_end/home/visitas";
$route['admin_webkm/getUserData'] = "back_end/home/getUserData";
$route['admin_webkm/users'] = "back_end/home/users";


$route['admin_webkm/comentarios'] = "back_end/home/comentarios";
$route['admin_webkm/modComentarioNoticia'] = "back_end/home/modComentarioNoticia";
$route['admin_webkm/eliComentarioNoticia'] = "back_end/home/eliComentarioNoticia";
$route['admin_webkm/modComentarioCumple'] = "back_end/home/modComentarioCumple";
$route['admin_webkm/eliComentarioCumple'] = "back_end/home/eliComentarioCumple";
$route['admin_webkm/modComentarioIngreso'] = "back_end/home/modComentarioIngreso";
$route['admin_webkm/eliComentarioIngreso'] = "back_end/home/eliComentarioIngreso";
$route['admin_webkm/modComentarioNacimiento'] = "back_end/home/modComentarioNacimiento";
$route['admin_webkm/eliComentarioNacimiento'] = "back_end/home/eliComentarioNacimiento";

$route['admin_webkm'] = "back_end/home/index";
$route['admin_webkm/noticias'] = "back_end/noticias/index";
$route['admin_webkm/nuevanoticia'] = "back_end/noticias/nuevanoticia";
$route['admin_webkm/eliminaNoticia'] = "back_end/noticias/eliminaNoticia";
$route['admin_webkm/modificarnoticia'] = "back_end/noticias/modificarnoticia";

$route['admin_webkm/galeria/(:num)'] = "back_end/galeria/index/$1";
$route['admin_webkm/eliminaimagengaleria'] = "back_end/galeria/eliminaimagengaleria";
$route['admin_webkm/cargaimagenes'] = "back_end/galeria/cargaimagenes";
$route['admin_webkm/galeria/getGaleria/(:num)'] = "back_end/galeria/getGaleria/$1";

$route['admin_webkm/nacimientos'] = "back_end/nacimientos/index";
$route['admin_webkm/nuevonacimiento'] = "back_end/nacimientos/nuevonacimiento";
$route['admin_webkm/eliminanacimiento'] = "back_end/nacimientos/eliminanacimiento";
$route['admin_webkm/modificarnacimiento'] = "back_end/nacimientos/modificarnacimiento";

$route['admin_webkm/reporteFlotaEstado'] = "back_end/home/reporteFlotaEstado";
$route['admin_webkm/reporteFlotaAsignados'] = "back_end/home/reporteFlotaAsignados";
$route['admin_webkm/reporteVisitasMes'] = "back_end/home/reporteVisitasMes";
$route['admin_webkm/reporteVisitasDia'] = "back_end/home/reporteVisitasDia";
$route['admin_webkm/reporteUsuariosAct'] = "back_end/home/reporteUsuariosAct";
$route['admin_webkm/reporteUsuariosTotal'] = "back_end/home/reporteUsuariosTotal";
$route['admin_webkm/getReporteriadata'] = "back_end/home/getReporteriadata";
$route['admin_webkm/getAsisTable'] = "back_end/home/getAsisTable";
$route['admin_webkm/getInspeccionesdata'] = "back_end/home/getInspeccionesdata";

$route['admin_webkm/getPagosmontosdata'] = "back_end/home/getPagosmontosdata";
$route['admin_webkm/getPagosproyectosdata'] = "back_end/home/getPagosproyectosdata";
$route['admin_webkm/getCantidadingresosdata'] = "back_end/home/getCantidadingresosdata";
$route['admin_webkm/getCantidadingresosdata'] = "back_end/home/getCantidadingresosdata";
$route['admin_webkm/getCantidadsalidasdata'] = "back_end/home/getCantidadsalidasdata";
$route['admin_webkm/getPagosDashboard'] = "back_end/home/getPagosDashboard";
$route['admin_webkm/getBolsaValores'] = "back_end/home/getBolsaValores";

/*FRONT END*/

$route['loginval'] = "login/loginval";
$route['unlogin'] = "login/unlogin";
$route['changepass'] = "login/changepass";
$route['changepassproc'] = "login/changepassproc";
$route['recuperarpass'] = "login/recuperarpass";

$route['prevencionderiesgos'] = "front_end/documentacion/indexPrevencion";
$route['formprevencionderiesgos'] = "front_end/documentacion/formprevencionderiesgos";
$route['eliminarArchivo'] = "front_end/documentacion/eliminarArchivoPrevencion";

$route['operacionestecnicas'] = "front_end/documentacion/indexOperaciones";
$route['formoperacionestecnicas'] = "front_end/documentacion/formoperacionestecnicas";
$route['eliminarArchivooperaciones'] = "front_end/documentacion/eliminarArchivooperaciones";
$route['inicio'] = "front_end/home/inicio";

$route['login/(:any)'] = "login";
$route['users'] = "front_end/home/users";
$route['getUserData'] = "front_end/home/getUserData";
$route['loadMore'] = "front_end/home/loadMore";
$route['noticias/(:any)'] = "front_end/noticias/index";

$route['liquidaciones'] = "front_end/liquidaciones/index";
$route['existeLiqu'] = "front_end/liquidaciones/existeLiqu";
$route['formIngresarLiquidacion'] = "front_end/liquidaciones/formIngresarLiquidacion";
$route['ingresarLiquidacion'] = "front_end/liquidaciones/ingresarLiquidacion";
$route['listadoLiquidaciones'] = "front_end/liquidaciones/listadoLiquidaciones";
$route['datalistnombreliqu'] = "front_end/liquidaciones/datalistnombreliqu";
$route['getDataDatalist'] = "front_end/liquidaciones/getDataDatalist";

$route['misLiquidaciones'] = "front_end/liquidaciones/misLiquidaciones";
$route['liquidacionesPersonal'] = "front_end/liquidaciones/liquidacionesPersonal";
$route['getPersonal'] = "front_end/liquidaciones/getPersonal";
$route['getPersonalPorUsuario'] = "front_end/liquidaciones/getPersonalPorUsuario";


/*$route['liquidaciones'] = "front_end/liquidaciones/index";
$route['getLiquidaciones'] = "front_end/liquidaciones/getLiquidaciones";
$route['liquidacion'] = "front_end/liquidaciones/liquidacion";
$route['liquidacionesJefe'] = "front_end/liquidaciones/liquidacionesJefe";*/

$route['enviar_comentario_not'] = "front_end/home/enviar_comentario_not";
$route['getComentarios_not'] = "front_end/home/getComentarios_not";
$route['eliminar_comentario_not'] = "front_end/home/eliminar_comentario_not";

$route['getComentarios'] = "front_end/home/getComentarios";
$route['enviar_comentario'] = "front_end/home/enviar_comentario";
$route['eliminar_comentario_nac'] = "front_end/home/eliminar_comentario_nac";

$route['getComentarios_ing'] = "front_end/home/getComentarios_ing";
$route['enviar_comentario_ing'] = "front_end/home/enviar_comentario_ing";
$route['eliminar_comentario_ing'] = "front_end/home/eliminar_comentario_ing";

$route['getComentarios_cumple'] = "front_end/home/getComentarios_cumple";
$route['enviar_comentario_cumple'] = "front_end/home/enviar_comentario_cumple";
$route['eliminar_comentario_cumple'] = "front_end/home/eliminar_comentario_cumple";

$route['vacaciones'] = "front_end/vacaciones/index";
$route['solicitudVacaciones'] = "front_end/vacaciones/solicitudVacaciones";
$route['getSolicitud'] = "front_end/vacaciones/getSolicitud";
$route['getSolicitudesJefe'] = "front_end/vacaciones/getSolicitudesJefe";
$route['actualizarEstadoSolicitud'] = "front_end/vacaciones/actualizarEstadoSolicitud";
$route['getListadoSolicitudesJefe'] = "front_end/vacaciones/getListadoSolicitudesJefe";
$route['reporteIndividual'] = "front_end/vacaciones/reporteIndividual";
$route['reporteUsuarios'] = "front_end/vacaciones/reporteUsuarios";

/* End of file routes.php */
/* Location: ./application/config/routes.php */