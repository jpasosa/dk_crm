<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
        
        require_once '_php/forms_start_coment.php';
        
        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
        $tpl->asignar('tabla', $get_tabla);
        // NOMBRE DE ARCHIVOS CARGADOS
        $files = Process::getFiles('', $id_tabla_proc);
        $tpl->asignar('files', $files);
        // CLIENTE
        $get_ven_cliente = BDConsulta::consulta('get_ven_cliente', array($get_tabla[0]['id_ven_cliente_contacto']), 'n');
        $ven_cliente = $get_ven_cliente[0]['empresa'];
        $tpl->asignar('ven_cliente', $ven_cliente);
        // CONTACTO
        $get_ven_cliente_contacto = BDConsulta::consulta('get_ven_cliente_contacto', array($get_tabla[0]['id_ven_cliente_contacto']), 'n');
        $contacto = $get_ven_cliente_contacto[0]['apellido'] . ', ' . $get_ven_cliente_contacto[0]['nombre'] . '  |  ' . $get_ven_cliente_contacto[0]['nombre_sucursal'] ;
        $tpl->asignar('contacto', $contacto);
        // PROVEEDOR
        $get_crp_proveedor = BDConsulta::consulta('get_crp_proveedor', array($get_tabla[0]['id_crp_proveedores']), 'n');
        $proveedor = $get_crp_proveedor[0]['nombre'];
        $tpl->asignar('proveedor', $proveedor);
        
        require_once '_php/forms_end_coment.php';
        
        $tpl->obtenerPlantilla();
        unset($flash_error);
        unset($flash_notice);
else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
