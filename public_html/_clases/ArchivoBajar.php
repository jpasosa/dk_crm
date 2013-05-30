<?php
/**
 * Se utiliza para forzar la bajada de un archivo, sin importar su extención.
 *
 * @category   Clases_Sitios_Web
 * @package    Sitios
 * @copyright  2010 KIRKE
 * @license    GPL
 * @version    Release: 2.0
 * @link       http://kirke.ws
 * @since      Class available since Release 1.0
 * @deprecated
 */

class ArchivoBajar {

    private $_nombreArchivo;
    private $_nombreReal;
    private $_directorio;

    public function nombreArchivo($_nombreArchivo) {

        $this->_nombreArchivo = $_nombreArchivo;

    }

    public function directorio($_directorio) {

        $this->_directorio = $_directorio;

    }

    public function bajar() {

        $url_actual = getcwd();
        chdir ( $this->_directorio );
        $_directorio = getcwd();
        chdir ( $url_actual );

        header("Content-type: application/force-download");
        header("Content-type: application/octet-stream");
        header("Content-type: application/download");
        header('Content-disposition: attachment; filename="'.$this->nombreReal().'"');

        echo @file_get_contents( $_directorio.'/'.$this->_nombreArchivo );

    }

    public function obtenerNombre() {

        $url_actual = getcwd();
        chdir ( $this->_directorio );
        $_directorio = getcwd();
        chdir ( $url_actual );

        return $_directorio.'/'.$this->nombreReal();

    }

    public function nombreReal($nombre=null) {

        if( $nombre==null ){
			$nombre_archivo = $this->_nombreArchivo;
		}else{
			$nombre_archivo = $nombre;
		}
		
		return preg_replace("/^([0-9]+)[_]([0-9]+)[_]/","",$nombre_archivo);

    }

}
