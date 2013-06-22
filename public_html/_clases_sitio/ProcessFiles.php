<?php



class ProcessFiles {


    // Hace la subida del archivo, y carga en tabla_arch el nombre
    public static function FileUpload($pr_proceso, $id_tabla_proc, $file, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = Process::NameProcess();
        }
        do {
            if($file['name'] == '') { // No se seleccionó ningún archivo
                $error = true;
                $notice_error = 'No seleccionaste ningún archivo.';
                break;
            }
            if($file['error'] == 1) { // Excede el tamaño permitido por el servidor
                $error = true;
                $notice_error = 'El archivo que intentas subir excede el tamañoi permitido.';
                break;
            }
            if($file['error'] == 4) { // No pudo ser subido al server
                $error = true;
                $notice_error = 'El archivo que intentas subir no pudo ser cargado correctamente.';
                break;
            }
            $cant_arch = BDConsulta::consulta('cant_arch', array($pr_proceso, $id_tabla_proc), $deb);
            if(is_null($cant_arch)) {
                $error = true;
                $notice_error = 'No pudo contar la cantidad de archivos subidos.';
                break;
            }
            $cant_arch = $cant_arch[0]['cant_reg'] + 0;
            if($cant_arch == 5) {
                $error = true;
                $notice_error = 'Ya existen 5 archivos para este proceso. No se pueden subir más.';
                break;
            }
            $fileup = new ArchivoSubir;
            $fileup->nombreCampo( 'archivo' );
            $fileup->directorio( 'upload_archivos/' . $pr_proceso . '/' ); // defino carpeta para $fileup
            // $fileup->directorio( '../upload_files/' . $pr_proceso . '/' ); // defino carpeta para $fileup
            $insert_bl = BDConsulta::consulta('insert_arch_blanco', array($pr_proceso, $id_tabla_proc), $deb);
            if(is_null($insert_bl)) {
                $error = true;
                $notice_error = 'No pudo crear el registro para subir el archivo.';
                break;
            }
            $fileup->idRegistro($insert_bl);
            // $ruta = '../upload_files/' . $pr_proceso . '/';
            $ruta = 'upload_archivos/' . $pr_proceso . '/';
            if(file_exists($ruta . $fileup->obtenerNombre())) {
                $error = true;
                $notice_error = 'El archivo que intenta subir ya existe en el servidor.';
                break;
            }
            $fileup->subir();
            if(!file_exists($ruta . $fileup->obtenerNombre())) {
                $error = true;
                $notice_error = 'No pudo subir el archivo al servidor.';
                break;
            }
            $insert_archivo = BDConsulta::consulta('insert_archivo', array($pr_proceso, $insert_bl, $fileup->obtenerNombre()), $deb);
            if(is_null($insert_archivo)) {
                $error = true;
                $notice_error = 'No pudo subir el archivo al servidor.';
                break;
            }
            $notice_success = 'Archivo subido correctamente';
        }while(0);

        $resp = array(
                         'error' => $error,
                         'notice_error' => $notice_error,
                          'notice_success' => $notice_success
                         );
        return $resp;

    }

    // Sube solo un archivo, y lo carga en campo "archivo" de la tabla que le pase
    public static function FileUploadOne($pr_proceso, $pr_proceso_sec, $campo, $id_tabla_sec, $file, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = Process::NameProcess();
        }
        do {
            if($file['name'] == '') { // No se seleccionó ningún archivo
                $error = true;
                $notice_error = 'No seleccionaste ningún archivo.';
                break;
            }
            if($file['error'] == 1) { // Excede el tamaño permitido por el servidor
                $error = true;
                $notice_error = 'El archivo que intentas subir excede el tamañoi permitido.';
                break;
            }
            if($file['error'] == 4) { // No pudo ser subido al server
                $error = true;
                $notice_error = 'El archivo que intentas subir no pudo ser cargado correctamente.';
                break;
            }
            $fileup = new ArchivoSubir;
            $fileup->nombreCampo( 'archivo' );
            $fileup->directorio( 'upload_archivos/' . $pr_proceso . '/' ); // defino carpeta para $fileup
            $fileup->idRegistro($id_tabla_sec);
            $ruta = 'upload_archivos/' . $pr_proceso . '/';
            if(file_exists($ruta . $fileup->obtenerNombre())) {
                $error = true;
                $notice_error = 'El archivo que intenta subir ya existe en el servidor.';
                break;
            }
            $fileup->subir();
            if(!file_exists($ruta . $fileup->obtenerNombre())) {
                $error = true;
                $notice_error = 'No pudo subir el archivo al servidor1.';
                break;
            }
            $update_archivo = BDConsulta::consulta('update_archivo', array($pr_proceso, $pr_proceso_sec, $campo, $id_tabla_sec, $fileup->obtenerNombre()), $deb);
            if(is_null($update_archivo)) {
                $error = true;
                $notice_error = 'No pudo subir el archivo al servidor2.';
                break;
            }
            $notice_success = 'Archivo subido correctamente';



        }while(0);

        $resp = array(
                         'error' => $error,
                         'notice_error' => $notice_error,
                          'notice_success' => $notice_success
                         );
        return $resp;

    }

    // Sube solo un archivo, y lo carga en campo "archivo" de la tabla principal
    public static function FileUploadOnePrinc($pr_proceso, $campo, $id_tabla, $file, $debug = 'n', $replace = false, $archivo = 'archivo') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = Process::NameProcess();
        }
        do {
            if($file['name'] == '') { // No se seleccionó ningún archivo
                $error = true;
                $notice_error = 'No seleccionaste ningún archivo.';
                break;
            }
            if($file['error'] == 1) { // Excede el tamaño permitido por el servidor
                $error = true;
                $notice_error = 'El archivo que intentas subir excede el tamañoi permitido.';
                break;
            }
            if($file['error'] == 4) { // No pudo ser subido al server
                $error = true;
                $notice_error = 'El archivo que intentas subir no pudo ser cargado correctamente.';
                break;
            }
            $fileup = new ArchivoSubir;
            $fileup->nombreCampo($archivo);
            $fileup->directorio( 'upload_archivos/' . $pr_proceso . '/' ); // defino carpeta para $fileup
            $fileup->idRegistro($id_tabla);
            $ruta = 'upload_archivos/' . $pr_proceso . '/';
            if(!$replace) {
                if(file_exists($ruta . $fileup->obtenerNombre())) {
                    $error = true;
                    $notice_error = 'El archivo que intenta subir ya existe en el servidor.';
                    break;
                }
            }
            $fileup->subir();
            if(!file_exists($ruta . $fileup->obtenerNombre())) {
                $error = true;
                $notice_error = 'No pudo subir el archivo al servidor1.';
                break;
            }
            $update_archivo = BDConsulta::consulta('update_archivo_princ', array($pr_proceso, $campo, $id_tabla, $fileup->obtenerNombre()), $deb);
            if(is_null($update_archivo)) {
                $error = true;
                $notice_error = 'No pudo subir el archivo al servidor2.';
                break;
            }
            $notice_success = 'Archivo subido correctamente';
        }while(0);
        $resp = array(
                         'error' => $error,
                         'notice_error' => $notice_error,
                          'notice_success' => $notice_success
                         );
        return $resp;
    }

    // pone en xxx_arch el campo activo en 0.
    public static function DeleteFile($pr_proceso, $id_tabla_arch, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = Process::NameProcess();
        }
        do {
            $del_file = BDConsulta::consulta('delete_file', array($pr_proceso, $id_tabla_arch), $deb);
            if(is_null($del_file)){
                // no pudo borrar
                break;
            }

        }while(0);
        return true;
    }

    // en tabla principal, en el campo indicado, lo vuelve a poner en null, era donde estaba el archivo.
    public static function DeleteFilePrinc($pr_proceso, $campo, $id_tabla, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = Process::NameProcess();
        }
        do {
            $del_file = BDConsulta::consulta('delete_file_princ', array($pr_proceso, $campo, $id_tabla), $deb);
            if(is_null($del_file)){
                $error = true;
                $notice_error = 'no pudo eliminar archivo';
                break;
            }
            $notice_success = 'Archivo eliminado con éxito';
        }while(0);
        $resp = array(
                         'error' => $error,
                         'notice_error' => $notice_error,
                          'notice_success' => $notice_success
                         );
        return $resp;
    }





}