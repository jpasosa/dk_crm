<?php
if($_GET[1] != '' && $_GET[1] > 0):

        require_once '_php/forms_start_coment.php';

        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'sis_provincia', 'sis_pais');
        $flash_error = Common::setErrorMessage($get_tabla); // Si tuviera error, lo carga en $flash_error para mostrar.
        $tpl->asignar('tabla', $get_tabla);
        // TABLA SECUNDARIA (los productos)
        $get_tabla_sec_prod = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n');
        $tpl->asignar('tabla_sec', $get_tabla_sec_prod);

        require_once '_php/forms_end_coment.php';

        $tpl->obtenerPlantilla();
        unset($flash_error);
        unset($flash_notice);
else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
