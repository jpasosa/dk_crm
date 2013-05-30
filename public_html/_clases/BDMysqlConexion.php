<?php
/**
 * Se utiliza para realizar una conexión MySQL.
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

class BDMysqlConexion {

    static public function conectar($servidor,$basedatos,$usuario,$clave) {

        $charset = "utf8";

        $conexion = @mysql_connect ($servidor,$usuario,$clave);

        @mysql_select_db($basedatos);

        if (!function_exists('mysql_set_charset')) {
            function mysql_set_charset($charset,$conexion) {
                return mysql_query("SET NAMES $charset",$conexion);
            }
        }

        @mysql_set_charset($charset,$conexion);

    }

}
