<?php
/**
 * Se utiliza para cambiar el tamaño de una imagen.
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

class ImagenCambiarTamano {

    private $_imagenTipoNueva;

    function ingresarDatos($datos) {

        $imagen      = $datos['imagen'];
        $ancho_final = $datos['ancho_final'];
        $alto_final  = $datos['alto_final'];

        if( $imagen!='' ) {

            // se obtiene informacion de la imagen orginal
            list($ancho, $alto, $tipo) = getimagesize($imagen);
            // tipos de archivos 1=GIF, 2=JPG, 3=PNG

            switch ($tipo) {
                case 1:  $imagen_temporal = imagecreatefromgif($imagen);
                    break;
                case 2:  $imagen_temporal = imagecreatefromjpeg($imagen);
                    break;
                case 3:  $imagen_temporal = imagecreatefrompng($imagen);
                    break;
				default:
					return false;
            }

            list($corte_ancho,$corte_alto,$margen_alto_cortar,$margen_ancho_cortar) = $this->recorteSobrante($ancho,$alto,$ancho_final,$alto_final);

            // creo la imagen de destino y le cargo la imagen temporal
            $imagen_destino = imagecreatetruecolor( $ancho_final, $alto_final );
            imagecopyresampled( $imagen_destino, $imagen_temporal, 0, 0, $margen_ancho_cortar, $margen_alto_cortar, $ancho_final, $alto_final, $corte_ancho, $corte_alto );

            switch ($tipo) {
                case 1:  imagegif($imagen_destino,$imagen);
                    break;
                case 2:  imagejpeg($imagen_destino,$imagen);
                    break;
                case 3:  imagepng($imagen_destino,$imagen);
                    break;
            }

            // destruyo las imagenes innecesarias
            ImageDestroy($imagen_temporal);
            ImageDestroy($imagen_destino);

            $this->_imagenTipoNueva['imagen']  = $imagen;
            $this->_imagenTipoNueva['tipo']    = $tipo;

        }

    }

    public function obtenerImagen() {

        return $this->_imagenTipoNueva;

    }

    private function recorteSobrante($ancho, $alto, $ancho_final, $alto_final) {
        // verifico si relacionada con el original proporcionalmente
        // es mas alto o ancho
        $ancho_orig = $ancho / $ancho_final;
        $alto_orig  = $alto  / $alto_final;

        // calculo el corte del sobrante
        if( $alto_orig >= $ancho_orig ) {
            $corte_ancho         = $ancho;
            $corte_alto          = $ancho_orig * $alto_final;
            $margen_alto_cortar  = ( $alto - $corte_alto ) / 2;
            $margen_ancho_cortar = 0;
        }else {
            $corte_ancho         = $alto_orig * $ancho_final;
            $corte_alto          = $alto;
            $margen_alto_cortar  = 0;
            $margen_ancho_cortar = ( $ancho - $corte_ancho ) / 2;
        }
        return array($corte_ancho, $corte_alto, $margen_alto_cortar, $margen_ancho_cortar);
    }
}
