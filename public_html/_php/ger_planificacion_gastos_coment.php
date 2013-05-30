<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL

$id_tabla_proc = $_GET[1];    
$tpl = new PlantillaReemplazos();
$flash_error = '';
$flash_notice = '';
$id_user = Common::isLogin();
$first_process = Process::isFirstProcess('', $id_tabla_proc);
$tpl->asignar('first_process', $first_process);
$repeat_process = Process::isRepeatProcess('', $id_tabla_proc);
$tpl->asignar('repeat_process', $repeat_process);

// FECHA, NOMBRE  y ÁREA.
$date = date("d/m/Y");
$tpl->asignar('date', $date);
$area = BDConsulta::consulta('user_area', array($id_user), 'n');
$tpl->asignar('area', $area);
$nombre_empleado = BDConsulta::consulta('empleado_nombres', array($id_user), 'n');
$nombres = $nombre_empleado[0]['nombre'] . ', ' . $nombre_empleado[0]['apellido'];
$tpl->asignar('nombre_empleado', $nombres);

// TABLA PRINCIPAL
$get_tabla = Process::getTabla('ger_planificacion_gastos', $id_tabla_proc, 'n');
$flash_error = Common::setErrorMessage($get_tabla); // Si tuviera error, lo carga en $flash_error para mostrar.
$tpl->asignar('tabla', $get_tabla);

// REGISTROS DE TABLA SECUNDARIA
$get_tabla_sec = Process::getTablaSec('ger_planificacion_gastos', 'detalle', $id_tabla_proc, 'n', 'sis_cuentas', 'crp_proveedores');
$flash_error = Common::setErrorMessage($get_tabla_sec); // Si tuviera error, lo carga en $flash_error para mostrar.
$tpl->asignar('tabla_sec', $get_tabla_sec);

// MONTO TOTAL
$monto_total = Process::getTablaSecTotal('ger_planificacion_gastos', 'detalle', $id_tabla_proc, 'monto', 'n');
$flash_error = Common::setErrorMessage($monto_total); // Si tuviera error, lo carga en $flash_error para mostrar.
$tpl->asignar('monto_total', $monto_total['monto_total']);

// COMENTARIOS
$all_comments = ProcessComments::getAll('ger_planificacion_gastos', $id_tabla_proc, 'n');
$flash_error = Common::setErrorMessage($all_comments); // Si tuviera error, lo carga en $flash_error para mostrar.
$tpl->asignar('all_comments', $all_comments);

// Siempre debe ingresar un comentario, para hacer un submit
if(isset($_POST['comentario']) && $_POST['comentario'] == '' &&
    (isset($_POST['aprobar']) || isset($_POST['solicitar_correccion']) ||  isset($_POST['desaprobar']) ) ) { // Envia COMENTARIOS
        $flash_error = 'Debes ingresar un comentario antes de enviar el proceso.';
}

// Envía al siguiete proceso, o rechaza.
if(isset($_POST['comentario']) && $_POST['comentario'] != '' &&
    (isset($_POST['aprobar']) || isset($_POST['solicitar_correccion']) ||  isset($_POST['desaprobar']) ) ) { // Envia COMENTARIOS
    $comment = $_POST['comentario'];
    if(isset($_POST['aprobar'])) {
        $accion = 'aprobar';
    }
    if(isset($_POST['desaprobar'])) {
        $accion = 'desaprobar';
    }
    if(isset($_POST['solicitar_correccion'])) {
        $accion = 'correccion';
    }
    $comentario = ProcessSends::toNextProcess('ger_planificacion_gastos', $id_user, $id_tabla_proc, $comment, $accion, 's');
    if($comentario['error'] == false) {
        header('Location: /enviado.html');
        exit();    
    }
}

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->asignar('id_tabla_proc', $id_tabla_proc);

$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);


else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
    header('Location: /menu.html');
    exit();
endif;
