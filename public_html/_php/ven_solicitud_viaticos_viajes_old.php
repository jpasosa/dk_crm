<?php

require_once '_funciones/validations.php';
require_once '_funciones/common.php';

$tpl = new PlantillaReemplazos();

$flash_error = '';
$flash_notice = '';
$detalle = '';
$reload = false;

//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
// Eliminar cliente
if(isset($_POST['id_client']) && $_POST['id_client'] > 0)  {
    $elim_cliente = BDConsulta::consulta('elim_cliente', array($_POST['id_client']), 'n');
    FormCommon::queryRespHeader($elim_cliente);  // verifica si fue hecha correctamente la consulta
}



// Agregar clientes
// if(isset($_POST['client_suc_id']) && $_POST['client_suc_id'] > 0 && isset($_POST['id_proces']) && $_POST['id_proces'] > 0)
//     {
//     $existClient = BDConsulta::consulta('comprobar_cliente', array($_POST['id_proces'], $_POST['client_suc_id']), 'n'); // debe comprobar que dicho cliente no esté ya agregado en el proceso actual
//     if(is_null($existClient))
//         { // si no existe lo agrega
//         BDConsulta::consulta('insert_cliente', array($_POST['id_proces'], $_POST['client_suc_id']), 'n');        
//         }
//     }

// Eliminar gastos
if(isset($_POST['id_gasto_del']) && $_POST['id_gasto_del'] > 0)
    {
    $elim_gasto = BDConsulta::consulta('elim_cliente_gasto', array($_POST['id_gasto_del']), 'n');
    FormCommon::queryRespHeader($elim_gasto);  // verifica si fue hecha correctamente la consulta
    }

////////////////////////////////////////////////////////////////////////////////////    FIN AJAX   ///////////////////////////



///////////////////////////////// AGREGAR REFERENCIAS  Por POST, del FORM. 
if(isset($_POST['agregar_ref'])) {
    $id_tabla_proc = $_POST['id_tabla_proc'];         
    $referencia = $_POST['referencia'];                           
    $detalle = trim($_POST['detalle']);     
    $monto = Common::PutDot($_POST['monto']);
    $validate = true;
    if($referencia != '' && $detalle != '' && $monto != '' && $monto != '0.00' ) {
        $insert_gasto = BDConsulta::consulta('insert_gasto', array($id_process, $referencia, $detalle, $monto), 'n');
        if(!is_null($insert_gasto)) {
            $flash_notice = 'Se agregó la referencia con éxito';
            $referencia = ''; $detalle = ''; $monto = '';
        }else {
            $flash_error = 'No puedo insertar la referencia en la base de datos. Vuelva a intentarlo.';
        }
    }else{
        $flash_error = 'Debe completar todos los campos, para poder agregar la referencia';
    }
    $tpl->asignar('referencia', $referencia);
    $tpl->asignar('detalle', $detalle);
    $tpl->asignar('monto', $monto);
}



///////////////////////////////// AGREGAR Fecha Inicio, Fin, y observaciones. Por POST, del FORM.
if(isset($_POST['agregar_fechas'])) {
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_ven_solicitud_viaticos_viajes = $_POST['id_ven_solicitud_viaticos_viajes'];
    $fecha_inicio = trim($_POST['fecha_inicio']);                        
    $fecha_fin = trim($_POST['fecha_fin']);     
    $observaciones = trim($_POST['observaciones']);
    $validate = true;

    if(Validations::IsCorrectDate($fecha_inicio) && Validations::IsCorrectDate($fecha_fin)) {
        if($observaciones != '') {
            $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
            $fecha_fin_unix = Dates::ConvertToUnix($fecha_fin);
            $update_fechas = BDConsulta::consulta('update_fechas', array($id_tabla_proc, $id_ven_solicitud_viaticos_viajes, $fecha_inicio_unix, $fecha_fin_unix, $observaciones), 'n');

            $flash_notice = 'Fechas y/o Observaciones modificadas correctamente';
        }else{
            $flash_error = 'Debe completar el campo Observaciones.';
        }  
    }else{
        $flash_error = 'Fecha/s Incorrecta/s';
    }
    $tpl->asignar('fecha_inicio', $fecha_inicio);
    $tpl->asignar('fecha_fin', $fecha_fin);
    $tpl->asignar('observaciones', $observaciones);
}



///////////////////////////////// AGREGAR Clientes. Por POST, del FORM.
// Agregar clientes
if(isset($_POST['agregar_cliente']) && $_POST['cliente']) {
    $id_tabla_proc = $_POST['id_process'];
    $client_suc_id = $_POST['cliente'];
    $validate = true;
    echo $id_tabla_proc , $client_suc_id;die();
    $existClient = BDConsulta::consulta('comprobar_cliente', array($id_tabla_proc, $client_suc_id), 'n'); // debe comprobar que dicho cliente no esté ya agregado en el proceso actual
    if(is_null($existClient)) { // si no existe lo agrega
        echo 'id process: ' , $id_tabla_proc , ' client_suc_id: ' , $client_suc_id;
        $insert_cliente = BDConsulta::consulta('insert_cliente', array($id_tabla_proc, $client_suc_id), 'n');

        
        if(!is_null($insert_cliente)) {
            $flash_notice = "El cliente fue agregado correctamente.";
        }else{
            $flash_error = "El cliente no pudo ser agregado.";
        }
    }else{
            $flash_error = "El cliente seleccionado ya está agregado.";
    }
}















// TODO: aqui debo poner el id del usuario que está logueado
$nombre_empleado = BDConsulta::consulta('empleado_nombres', array('100002'), 'n');

$nombre = $nombre_empleado[0]['nombre'];

$apellido = $nombre_empleado[0]['apellido'];
$nombres = $nombre . ', ' . $apellido;

$tpl->asignar('nombre_empleado', $nombres); // nombre y apellido del empleado logueado

$tpl->asignar('fecha_actual', date('d/m/Y'));
$last_id = BDConsulta::consulta('lastId_ven_solicitud_viaticos_viajes', '', 'n');
$id_ven_solicitud_viaticos_viajes = $last_id[0]['id']; // tengo ultimo id de ven_solicitud_viaticos_viajes
$tpl->asignar('id_ven_solicitud_viaticos_viajes', $id_ven_solicitud_viaticos_viajes);
// ultimo id de los procesos
$id_tabla_proc = $id_ven_solicitud_viaticos_viajes_proc = $last_id[0]['id_proc'];
$tpl->asignar('id_tabla_proc', $id_tabla_proc);

$select_fechas_observ = BDConsulta::consulta('select_fechas_oberv', array($id_ven_solicitud_viaticos_viajes), 'n');
$tpl->asignar('fechas_ob', $select_fechas_observ);



// SELECCION DE LOS CLIENTES EN LA SOLICITUD DE VIATICOS PARA VIAJES

 // clientes para ir seleccionando, devuelve para mostrar en el select
$clientes_show = BDConsulta::consulta('clientes_habilitados_show', '', 'n');
$tpl->asignar('clientes_show', $clientes_show);
// son todos los clientes del proceso. . 
$clientes = BDConsulta::consulta('clientes_en_proceso_full', array($id_tabla_proc), 'n'); // clientes en el proceso
$tpl->asignar('clientes', $clientes); 

// suma de los montos
$suma_de_montos = BDConsulta::consulta('suma_de_montos', array($id_tabla_proc), 'n'); // clientes en el proceso
$tpl->asignar('suma_de_montos', $suma_de_montos);






// SELECCION DE LOS GASTOS EN LA SOLICITUD DE VIATICOS PARA VIAJES

// referencias para el show
$referencias = BDConsulta::consulta('referencias_show', '', 'n'); 
$tpl->asignar('referencias', $referencias);
// gastos de los clientes en el proceso
$clientes_gastos = BDConsulta::consulta('clientes_gastos', array($id_tabla_proc), 'n'); // clientes en el proceso
$tpl->asignar('clientes_gastos', $clientes_gastos);



$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




