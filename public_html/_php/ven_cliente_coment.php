<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
        require_once '_php/forms_start_coment.php';
        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
        $tpl->asignar('tabla', $get_tabla);
        // TABLA SECUNDARIA (los gastos)
        // echo $get_tabla[0]['id_ven_cliente'];
        $get_tabla_suc = BDConsulta::consulta('get_tabla_suc', array($get_tabla[0]['id_ven_cliente']), 'n');
        $tpl->asignar('tabla_suc', $get_tabla_suc);
        require_once '_php/forms_end_coment.php';
        $tpl->obtenerPlantilla();
        unset($flash_error);
        unset($flash_notice);
else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
