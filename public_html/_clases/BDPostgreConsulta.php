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

class BDPostgreConsulta {

    static public function consulta($consulta, $control=NULL) {

		$tipo = '';

        if( $control == 's' ) {
            echo 'Consulta : '.$consulta.'<br />';
        }

        $resultado      = pg_query($_SESSION['kk_sistema']['kk_pg_conexion'], $consulta);

		if( strtoupper(trim(substr(trim($consulta), 0, 7))) == 'INSERT' ){

			//$id_insert = mysql_insert_id();
			//$tipo = 'insert';
			// agregar en la consulta " RETURNING id_tabla"

		}elseif( strtoupper(trim(substr(trim($consulta), 0, 7))) == 'UPDATE' ){

			if(pg_affected_rows() != 0){
				$num_lineas = pg_affected_rows();
			}else{
				$num_lineas = false;
			}

			$tipo = 'update';

		}


        if (!$resultado) {

            if( $control == 's' ) {
                echo 'Error en consulta : '.pg_result_error().'<br /><br />';
            }

        }else{

			if( $tipo == 'insert' ){
				
				return $id_insert;
				
			}elseif( $tipo == 'update' ){
				
				return $num_lineas;
			
			}elseif( @pg_num_rows($resultado) ) {
                while($linea  = pg_fetch_array($resultado,MYSQL_ASSOC)) {
                    $resultado_matriz[] = $linea;
                }

                return $resultado_matriz;
            }
        }
    }

}
