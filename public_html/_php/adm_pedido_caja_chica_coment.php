<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
        require_once '_php/forms_start_coment.php';
        // TABLA PRINCIPAL
        // $get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
        // $flash_error = Common::setErrorMessage($get_tabla); // Si tuviera error, lo carga en $flash_error para mostrar.
        // $tpl->asignar('tabla', $get_tabla);
        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
        $tpl->asignar('tabla', $get_tabla);
        // // NOMBRE DE ARCHIVOS CARGADOS
        // $files = BDConsulta::consulta('get_file', array($id_tabla), 'n');
        // $file = $files[0]['archivo'];
        // $tpl->asignar('file', $file);
        // MONTO TOTAL
        $monto_total = Process::getTablaSecTotal('', 'detalle', $id_tabla_proc, 'monto');
        if(isset($monto_total['error']) && $monto_total['error'] == true) {
            $monto_total = 0.00;
        }else{
            $monto_total = $monto_total['monto_total'];    
        }
        $tpl->asignar('monto_total', $monto_total);
        // REGISTROS DE TABLA SECUNDARIA
        // $get_tabla_sec = Process::getTablaSec('', 'detalle', $id_tabla_proc, 'n');
        // $flash_error = Common::setErrorMessage($get_tabla_sec); // Si tuviera error, lo carga en $flash_error para mostrar.
        // $tpl->asignar('tabla_sec', $get_tabla_sec);
        // TABLA SECUNDARIA (los gastos)
        $gast_detalles = Process::getTablaSec('', 'detalle', $id_tabla_proc, 'n', 'sis_cuentas', 'crp_proveedores', 'sis_areas');
        $flash_error = Common::setErrorMessage($gast_detalles); // Si tuviera error, lo carga en $flash_error para mostrar.
        $tpl->asignar('tabla_sec', $gast_detalles);
        require_once '_php/forms_end_coment.php';
        $tpl->obtenerPlantilla();
        unset($flash_error);
        unset($flash_notice);
else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
