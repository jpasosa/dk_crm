<?php
/**
 * Se utiliza para realizar una conexión con una base de datos determinada.
 *
 * @category   Clases_Sitios_Web
 * @package    Sitios
 * @copyright  2012 KIRKE
 * @license    GPL
 * @version    Release: 2.0
 * @link       http://kirke.ws
 * @since      Class available since Release 1.0
 * @deprecated
 */

class ReporteErrores {

    static public function error($tipo, $error0, $error1=null, $error2=null, $error3=null) {

		if( VariableGet::sistema('mostrar_errores') === true ) {
			
			switch ($tipo) {
				case 'archivo':
					$error = '[No se puede obtener el siguiente archivo : <strong>' . $error0 . '</strong> (".php" o ".tpl") ]'."\n";
					break;
				case 'base':
					$error = '[Exceso en ejecución de consulta : ( ' . $error0 . ' / ' . $error1 . ' ) <strong>tiempo : ' . $error3 . '</strong> | ' . $error2 . "]\n";
					break;
			}
			
			if( VariableGet::sistema('mostrar_errores') === true){
				echo $error;
			}

		}

    }
}
