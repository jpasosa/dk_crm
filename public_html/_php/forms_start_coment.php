<?php

// Obtengo el archivo de donde fue llamado.
$exception = new Exception; 
$trace = $exception->getTrace();
$file = $trace[0]['file'];
$file = explode('/', $file);
$file = end($file);
$file = explode('.', $file);
$pr_proceso = $file[0];
if(!stristr($pr_proceso, '_coment') === FALSE) { // si tiene _coment, debe eliminarlo, para escribir bien el proceso.
    $pr_proceso = str_replace('_coment', '', $pr_proceso);
}
if(!stristr($pr_proceso, '_recordatorio') === FALSE) { // si tiene _recordatorio, debe eliminarlo, para escribir bien el proceso.
    $pr_proceso = str_replace('_recordatorio', '', $pr_proceso);
}


$id_tabla_proc = $_GET[1];    
$tpl = new PlantillaReemplazos();
$flash_error = '';$flash_notice = '';
$id_user = Common::isLogin();
$first_process = Process::isFirstProcess($pr_proceso, $id_tabla_proc);
$tpl->asignar('first_process', $first_process);
$repeat_process = Process::isRepeatProcess($pr_proceso, $id_tabla_proc);
$tpl->asignar('repeat_process', $repeat_process);

// FECHA, NOMBRE  y ÁREA.
$date = date("d/m/Y");
$tpl->asignar('date', $date);
if($pr_proceso == 'ven_pedidos_varios_clientes' || $pr_proceso == 'ven_propuestas_comerciales'  || $pr_proceso == 'ger_otros_pedidos' || $pr_proceso == 'tra_aprob_consolidaciones'):
        // Voy a tener que extraer la empresa y el nombre del cliente, por que el primer paso de estos procesos los inicia un CLIENTE.
        $get_tabla = Process::getTabla($pr_proceso, $id_tabla_proc, 'n');
        $id_ven_cliente_contacto = $get_tabla[0]['id_ven_cliente_contacto'];
        $clientes = BDConsulta::consulta('select_clientes', array($id_ven_cliente_contacto), 'n');
        $nombre_cliente = $clientes[0]['apellido'] . ', ' . $clientes[0]['nombre'];
        $empresa_cliente = $clientes[0]['empresa'];
        $telefono_cliente = $clientes[0]['telefono_ven_cliente_contacto'];
        $tpl->asignar('nombre_cliente', $nombre_cliente);    
        $tpl->asignar('empresa_cliente', $empresa_cliente);    
        $tpl->asignar('telefono_cliente', $telefono_cliente);    
endif;

$area = BDConsulta::consulta('user_area', array($id_user), 'n');
$area_empleado = $area[0]['area'];
$tpl->asignar('area_empleado', $area_empleado);
$nombre_empleado = BDConsulta::consulta('empleado_nombres', array($id_user), 'n');
$nombres = $nombre_empleado[0]['nombre'] . ', ' . $nombre_empleado[0]['apellido'];
$tpl->asignar('nombre_empleado', $nombres);

// Inicio del TRAMITE (el empleado que lo comenzó)
$proceso_inicio = Process::getAllTablaProc($pr_proceso, $id_tabla_proc, 'n');
$fecha_inicio = $proceso_inicio[0]['fecha_alta'];
$area_inicio = $proceso_inicio[0]['area'];
$nombre_inicio = BDConsulta::consulta('empleado_nombres', array($proceso_inicio[0]['id_user']), 'n');
$nombre_inicio = $nombre_inicio[0]['apellido'] . ', ' . $nombre_inicio[0]['nombre'];
$tpl->asignar('fecha_inicio', $fecha_inicio);
$tpl->asignar('area_inicio', $area_inicio);
$tpl->asignar('nombre_inicio', $nombre_inicio);

