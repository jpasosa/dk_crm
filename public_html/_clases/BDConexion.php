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

class BDConexion {

	static private $conexion = false;

    static public function consulta($base_datos, $servidor, $basedatos, $usuario,$clave) {

        if( self::$conexion == false ) {

			self::$conexion = true;

			$clase_de_bd = 'BD' . ucfirst(VariableGet::sistema('tipo_base')) . 'Conexion';
			eval('$bd = ' . $clase_de_bd . '::conectar($servidor,$basedatos,$usuario,$clave);');
			
			return $bd;

        }else{

			return false;	

		}
    }
}
