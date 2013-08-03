<?php


if($_GET[1] != '' && $_GET[1] > 0)
{
	require_once '_php/forms_start_coment.php';
	// TABLA PRINCIPAL
	$get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'cpr_proveedores');
	$tpl->asignar('tabla', $get_tabla);
	// TABLA SECUNDARIA, PRODUCTOS
	$tabla_sec = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n', 'pro_productos');
	$flash_error = Common::setErrorMessage($tabla_sec);
	$tpl->asignar('tabla_sec', $tabla_sec);
	require_once '_php/forms_end_coment.php';
	$tpl->obtenerPlantilla();
	unset($flash_error);
	unset($flash_notice);

}else{
	header('Location: /menu.html');
	exit();
}
