<?php

if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
	require_once '_php/forms_start_coment.php';
	// TABLA PRINCIPAL
	$get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'ave_campania');
	$tpl->asignar('tabla', $get_tabla);
	$get_tabla_contacto = Process::getTabla('', $id_tabla_proc, 'n', 'ven_cliente_contacto', 'ven_cliente_sucursales', 'ven_cliente');
	$tpl->asignar('tabla_contacto', $get_tabla_contacto);
	// TABLA SECUNDARIA, TEMAS
	$tabla_sec = Process::getTablaSec('', 'temas', $id_tabla_proc, 'n');
	$flash_error = Common::setErrorMessage($tabla_sec); // Si tuviera error, lo carga en $flash_error para mostrar.
	$tpl->asignar('tabla_sec', $tabla_sec);
	require_once '_php/forms_end_coment.php';
	$tpl->obtenerPlantilla();
	unset($flash_error);
	unset($flash_notice);

else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
	header('Location: /menu.html');
	exit();
endif;
