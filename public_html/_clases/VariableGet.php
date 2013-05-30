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
class VariableGet extends VariableControl {

    // Variables del sistema

    public static function sistema($variable) {
		return parent::getSistema($variable);
    }

    // Variables globales {$#variable}

    public static function globales($variable) {
		return parent::getGlobales($variable);
    }

    // Variable contenido seccion

    public static function seccion() {
		return parent::getSeccion();
    }

    // Variable nombre marco

    public static function indexMarco() {
        return parent::getIndexMarco();
    }

}
