<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
        require_once '_php/forms_start_coment.php';
        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
        $flash_error = Common::setErrorMessage($get_tabla); // Si tuviera error, lo carga en $flash_error para mostrar.
        $tpl->asignar('tabla', $get_tabla);
        // PARA EL SELECT de PAIS | CIUDAD
        $pais_ciudad = Process::getValuesSelect('sis_provincia', 'id_sis_provincia', 'provincia', $debug = 'n', 'sis_pais', 'id_sis_pais', 'pais');
        $tpl->asignar('pais_ciudad', $pais_ciudad);
        // REGISTROS DE TABLA SECUNDARIA
        $get_tabla_sec = Process::getTablaSec('', 'opc', $id_tabla_proc, 'n');
        $flash_error = Common::setErrorMessage($get_tabla_sec); // Si tuviera error, lo carga en $flash_error para mostrar.
        $tpl->asignar('tabla_sec', $get_tabla_sec);
        require_once '_php/forms_end_coment.php';
        $tpl->obtenerPlantilla();
        unset($flash_error);
        unset($flash_notice);
else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
