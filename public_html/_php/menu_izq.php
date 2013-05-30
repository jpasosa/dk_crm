<?php

$tpl = new PlantillaReemplazos();

$flash_error = '';
$flash_notice = '';

// unset($_SESSION['id_tabla']);
// unset($_SESSION['id_tabla_proc']);
// unset($_SESSION['primer_proceso_creado']);unset($_SESSION['first_time']);

$id_user = Common::isLogin();

$nombre_empleado= BDConsulta::consulta('empleado_nombres', array($id_user), 'n');
$nombres             = $nombre_empleado[0]['nombre'] . ', ' . $nombre_empleado[0]['apellido'];
$tpl->asignar('nombre_empleado', $nombres); // nombre y apellido del empleado logueado


$id_areac = BDConsulta::consulta('user_area', array($id_user), 'n');
$id_area = $id_areac[0]['id_sis_areas'];
$id_area_nombre = $id_areac[0]['area'];
$tpl->asignar('id_area_nombre', $id_area_nombre);

$new_forms = BDConsulta::consulta('new_forms', array($id_area), 'n'); // nos dá los formularios que puede comenzar según su área.

// $all_proc= Process::AllProcessOpen($id_user, 'n');
// $tpl->asignar('all_proc', $all_proc);




// $id_proccess = 1; // HARCKODEADO
// $tpl->asignar('id_proccess', $id_proccess); // por ahora pruebo con el id_proccess 1, este debe ser el proceso actual del formulario


$tpl->asignar('new_forms', $new_forms);
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);

$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);
