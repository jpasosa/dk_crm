<?php

/**
 * Se utiliza para realizar una conexión con una base de datos determinada.
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
class BDObtenerOrden {

    static public function consulta($tabla) {

		$clase_de_bd = 'BD' . ucfirst(VariableGet::sistema('tipo_base')) . 'ObtenerOrden';
		eval('$bd = ' . $clase_de_bd . '::consulta($tabla);');
		
		return $bd;

    }

}
