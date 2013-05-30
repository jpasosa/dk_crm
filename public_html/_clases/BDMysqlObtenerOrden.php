<?php

/**
 * Se utiliza para realizar una conexión con una base MySQL.
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
class BDMysqlObtenerOrden {

    static public function consulta($tabla) {

        $consulta = '
            SELECT      MAX(orden) AS orden
            FROM        '.$tabla.'
            ;
        ';

        $resultado = mysql_query($consulta);
		
		$resultado_matriz = mysql_fetch_array($resultado,MYSQL_ASSOC);
		
        return ($resultado_matriz['orden'] + 1);

    }

}
