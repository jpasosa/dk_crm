<?php

//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////

// Eliminar cliente
if(isset($_POST['id_client']) && $_POST['id_client'] > 0)
    {
    BDConsulta::consulta('elim_cliente', array($_POST['id_client']), 'n');
    }

// Agregar clientes
if(isset($_POST['client_suc_id']) && $_POST['client_suc_id'] > 0 && isset($_POST['id_proces']) && $_POST['id_proces'] > 0)
    {
    $existClient = BDConsulta::consulta('comprobar_cliente', array($_POST['id_proces'], $_POST['client_suc_id']), 'n'); // debe comprobar que dicho cliente no esté ya agregado en el proceso actual
    if(is_null($existClient))
        { // si no existe lo agrega
        BDConsulta::consulta('insert_cliente', array($_POST['id_proces'], $_POST['client_suc_id']), 'n');        
        }
    }

// Eliminar gastos
if(isset($_POST['id_gasto_del']) && $_POST['id_gasto_del'] > 0)
    {
    BDConsulta::consulta('elim_cliente_gasto', array($_POST['id_gasto_del']), 'n');
    }

// Agregar gastos, referencias, x pedido de Viaticos x AJAX
if(isset($_POST['id_reference']) && $_POST['id_reference'] > 0 && isset($_POST['id_proc']) && $_POST['id_proc'] > 0
    && isset($_POST['detalle']) && isset($_POST['monto']) )
    {
    BDConsulta::consulta('insert_gasto', array($_POST['id_proc'], $_POST['id_reference'], $_POST['detalle'], $_POST['monto'] ), 's');
    }

////////////////////////////////////////////////////////////////////////////////////    FIN AJAX   ///////////////////////////






$tpl = new PlantillaReemplazos();

// TODO: aqui debo poner el id del usuario que está logueado
$nombre_empleado = BDConsulta::consulta('empleado_nombres', array('100002'), 'n');

$nombre = $nombre_empleado[0]['nombre'];

$apellido = $nombre_empleado[0]['apellido'];
$nombres = $nombre . ', ' . $apellido;

$tpl->asignar('nombre_empleado', $nombres); // nombre y apellido del empleado logueado

$tpl->asignar('fecha_actual', date('d/m/Y'));
$last_id = BDConsulta::consulta('lastId_ven_solicitud_viaticos_viajes', '', 'n');
$id_ven_solicitud_viaticos_viajes = $last_id[0]['id']; // tengo ultimo id de ven_solicitud_viaticos_viajes

// ultimo id de los procesos
$id_proces = $id_ven_solicitud_viaticos_viajes_proc = $last_id[0]['id_proc'];
$tpl->asignar('id_proces', $id_proces);



// SELECCION DE LOS CLIENTES EN LA SOLICITUD DE VIATICOS PARA VIAJES

 // clientes para ir seleccionando, devuelve para mostrar en el select
$clientes_show = BDConsulta::consulta('clientes_habilitados_show', '', 'n');
$tpl->asignar('clientes_show', $clientes_show);
// son todos los clientes del proceso. . 
$clientes = BDConsulta::consulta('clientes_en_proceso_full', array($id_proces), 'n'); // clientes en el proceso
$tpl->asignar('clientes', $clientes); 

// suma de los montos
$suma_de_montos = BDConsulta::consulta('suma_de_montos', array($id_proces), 'n'); // clientes en el proceso
$tpl->asignar('suma_de_montos', $suma_de_montos);






// SELECCION DE LOS GASTOS EN LA SOLICITUD DE VIATICOS PARA VIAJES

// referencias para el show
$referencias = BDConsulta::consulta('referencias_show', '', 'n'); 
$tpl->asignar('referencias', $referencias);
// gastos de los clientes en el proceso
$clientes_gastos = BDConsulta::consulta('clientes_gastos', array($id_proces), 'n'); // clientes en el proceso
$tpl->asignar('clientes_gastos', $clientes_gastos);




$tpl->obtenerPlantilla();





