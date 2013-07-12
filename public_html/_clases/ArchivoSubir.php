<?php
/**
 * Se utiliza para subir un archivo a un directorio específico del servidor desde el campo de un formulario.
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

class ArchivoSubir {

    private $_nombreCampo;
    private $_directorio;
    private $_componenteId;
    private $_idRegistro;

    public function nombreCampo($nombre_campo) {
        $this->_nombreCampo = $nombre_campo;
    }

    public function directorio($directorio) {
        $this->_directorio = $directorio;
    }

    public function componenteId($componente_id) {
        $this->_componenteId = $componente_id;
    }

    public function idRegistro($id_registro) {
        $this->_idRegistro = $id_registro;
    }

    public function subir() {

        move_uploaded_file( $_FILES[$this->_nombreCampo]['tmp_name'], $this->_directorio.'/'.$this->_componenteId.'_'.$this->_idRegistro.'_'.$_FILES[$this->_nombreCampo]['name'] );

    }

    public function obtenerNombre() {
		if( $_FILES[$this->_nombreCampo]['name'] != '' ){
        	return $this->_componenteId.'_'.$this->_idRegistro.'_'.$_FILES[$this->_nombreCampo]['name'];
		}else{
			return false;
		}
    }

}
