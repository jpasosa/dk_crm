<?php

// Obtengo el archivo de donde fue llamado.
$exception = new Exception; 
$trace = $exception->getTrace();
$file = $trace[0]['file'];
$file = explode('/', $file);
$file = end($file);
$file = explode('.', $file);
$pr_proceso = $file[0];
if(!stristr($pr_proceso, '_coment') === FALSE) { // si tiene _coment, debe eliminarlo, para escribir bien el proceso.
    $pr_proceso = str_replace('_coment', '', $pr_proceso);
}

if(!stristr($pr_proceso, '_recordatorio') === FALSE) { // si tiene _recordatorio, debe eliminarlo, para escribir bien el proceso.
    $pr_proceso = str_replace('_recordatorio', '', $pr_proceso);
    $no_comments = true;
}



// COMENTARIOS
if(isset($no_comments) && !$no_comments) {
    $all_comments = ProcessComments::getAll($pr_proceso, $id_tabla_proc, 'n');
    $flash_error = Common::setErrorMessage($all_comments); // Si tuviera error, lo carga en $flash_error para mostrar.
    $tpl->asignar('all_comments', $all_comments);    
}


// Siempre debe ingresar un comentario, para hacer un submit
if(isset($_POST['comentario']) && $_POST['comentario'] == '' &&
    (isset($_POST['aprobar']) || isset($_POST['solicitar_correccion']) ||  isset($_POST['desaprobar']) ) ) { // Envia COMENTARIOS
        $flash_error = 'Debes ingresar un comentario antes de enviar el proceso.';
}

// Envía al siguiete proceso, o rechaza.
if(isset($_POST['comentario']) && $_POST['comentario'] != '' &&
    (isset($_POST['aprobar']) || isset($_POST['solicitar_correccion']) ||  isset($_POST['desaprobar']) ) ) { // Envia COMENTARIOS
    $comment = $_POST['comentario'];
    if(isset($_POST['aprobar'])) {
        $accion = 'aprobar';
    }
    if(isset($_POST['desaprobar'])) {
        $accion = 'desaprobar';
    }
    if(isset($_POST['solicitar_correccion'])) {
        $accion = 'correccion';
    }
    $comentario = ProcessSends::toNextProcess($pr_proceso, $id_user, $id_tabla_proc, $comment, $accion, 's');
    if($comentario['error'] == false) {
        header('Location: /enviado.html');
        exit();
    }
}

// Cierro un mantenimiento (caso especial en los recordatorios de los mantenimientos)
if(isset($_POST['cerrar_mant'])) {
    // cierra el mantenimiento
    header('Location: /mant_cerrado.html');
    exit();  
}

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->asignar('id_tabla_proc', $id_tabla_proc);
