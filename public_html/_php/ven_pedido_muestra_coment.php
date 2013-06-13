<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
        require_once '_php/forms_start_coment.php';
        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'ven_cliente');
        $tpl->asignar('tabla', $get_tabla);
        // TABLA PRINCIPAL
        $get_tabla_sec = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n', 'pro_productos');
        $tpl->asignar('tabla_sec', $get_tabla_sec);
        require_once '_php/forms_end_coment.php';
        $tpl->obtenerPlantilla();
        unset($flash_error);
        unset($flash_notice);
else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
