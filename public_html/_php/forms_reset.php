<?php


$user = Process::getUser($id_user);



if($_SESSION['id_user'] == -100) { // Está logueado un CLIENTE de afuera.
    $select_ven_cliente_contacto = BDConsulta::consulta('select_ven_cliente_contacto', array($_SESSION['id_client_user']), 'n');
    $nombre_cliente = $select_ven_cliente_contacto[0]['apellido'] . ', ' . $select_ven_cliente_contacto[0]['nombre'];
    $tpl->asignar('nombre_cliente', $nombre_cliente);
    $empresa_cliente = $select_ven_cliente_contacto[0]['empresa'];
    $tpl->asignar('empresa_cliente', $empresa_cliente);
    $area = 'CLIENTES';
    $tpl->asignar('area', $area);    
}else{ // Es un EMPLEADO de la empresa.
    $nombres = $user[0]['nombre'] . ', ' . $user[0]['apellido'];
    $tpl->asignar('nombre_empleado', $nombres);
    $tpl->asignar('area', $user[0]['area']);    
}

$pr_proceso = Process::NameProcess();
$tpl->asignar('pr_proceso', $pr_proceso);

if(!isset($id_tabla_proc))                  $id_tabla_proc = -10;
if(!isset($id_tabla))                           $id_tabla = -10;
if(!isset($first_time))                         $first_time = 'true';


$tpl->asignar('id_tabla_proc', $id_tabla_proc);
$tpl->asignar('id_tabla', $id_tabla); // id del tabla_proc
$tpl->asignar('date', date('d/m/Y'));
$tpl->asignar('first_time', $first_time);

