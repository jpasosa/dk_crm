<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
        require_once '_php/forms_start_coment.php';
        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'ave_campania');
        $tpl->asignar('tabla', $get_tabla);

// [id_ven_llamadas] => 8
        //     [orden] => 0
        //     [id_ave_campania] => 11
        //     [id_ven_cliente_contacto] => 12
        //     [tipo_llamada] => S
        //     [prioridad] => MB
        //     [fecha] => 1370401200
        //     [hora] => la horrrr
        //     [observaciones] => las observaciones
        //     [pedido_muestras] =>
        //     [orden_pedidos] =>
        //     [propuestas_com_presup] =>
        //     [alta_liente] =>
        //     [pedidos_arios_cliente] =>
        //     [recordar_temas_pendientes_d] =>
        //     [id_ven_llamadas_proc] => 9
        //     [campania] => 17/06/2013 - 17:12 - nom asist ventas, apell asist ventas
        //     [motivo] => motivoooo
        //     [fecha_inicio] => 1370401200
        //     [mlg_fecha_inicio] => 1371610800
        //     [mlg_asunto] => ,mail asunto
        //     [mlg_texto] => textooosadasd
        //     [mlg_plantilla] => _11_correccionesNuevas.zip
        //     [id_ave_campania_proc] => 0



        $get_tabla_contacto = Process::getTabla('', $id_tabla_proc, 'n', 'ven_cliente_contacto', 'ven_cliente_sucursales', 'ven_cliente');
        $tpl->asignar('tabla_contacto', $get_tabla_contacto);


 // [id_ven_llamadas] => 8
 //            [orden] => 2
 //            [id_ave_campania] => 11
 //            [id_ven_cliente_contacto] => 4
 //            [tipo_llamada] => S
 //            [prioridad] => MB
 //            [fecha] => 1370401200
 //            [hora] => 12:00
 //            [observaciones] =>
 //            [pedido_muestras] =>
 //            [orden_pedidos] =>
 //            [propuestas_com_presup] =>
 //            [alta_liente] =>
 //            [pedidos_arios_cliente] =>
 //            [recordar_temas_pendientes_d] =>
 //            [id_ven_llamadas_proc] => 9
 //            [nombre] => pepepepep
 //            [apellido] => apellidododod
 //            [id_ven_cliente_sucursales] => 1
 //            [mail] =>
 //            [telefono] =>
 //            [celular] =>
 //            [sector] =>
 //            [puesto] =>
 //            [usuario] => juampa
 //            [clave] =>
 //            [activo] => 1
 //            [id_ven_cliente] => 2
 //            [nombre_sucursal] => buenos aires sucursal
 //            [direccion] => Bulnes 6563
 //            [empresa] => pepe SA
 //            [sitio_web] =>
 //            [identificacion_tributaria] =>
 //            [id_sis_provincia] => 3
 //            [mail_solicitante] => jsjs@pepe.com
 //            [habilitado] => 1
 //            [id_ven_lista_precios] =>
 //            [comentario] =>
 //            [id_ven_cliente_proc] =>




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
