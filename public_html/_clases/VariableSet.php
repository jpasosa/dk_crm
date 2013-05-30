<?php

/**
 * Se utiliza para administrar las variables del sistema.
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
class VariableSet extends VariableControl {

    // Variables del sistema

    public static function sistema($variable, $valor) {
		parent::setSistema($variable, $valor);
    }

    // Variables globales {$#variable}

    public static function globales($variable, $valor, $sitio_nombre_inicio=NULL) {
		parent::setGlobales($variable, $valor, $sitio_nombre_inicio);
    }

    // Variable contenido seccion

    public static function seccion($valor) {
		parent::setSeccion($valor);
    }

    // Variable nombre marco

    public static function indexMarco($valor) {
        parent::setIndexMarco($valor);
    }

}
