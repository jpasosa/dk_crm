<?php




class bod_mercaderia_mal_estado extends FormCommon
{

	//  IN:     (0->$id_tabla  |  1->$proveedor  |  2->$nombre_trapackinglist  |  3->$fecha_envio_unix  |  4->$fecha_llegada_unix  |  5->$observaciones)
	public  function update_tabla_princ ($valores=NULL) {
		return "
			UPDATE bod_mercaderia_mal_estado
			SET 	informe 	= '$valores[1]',
					observaciones = '$valores[2]'
			WHERE id_bod_mercaderia_mal_estado = $valores[0]
			;
		";
	}

	//  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
	//  IN:     (0->$id_tabla_sec  1->$id_pro_productos  |  2->$nro_caja  |  3->$productos_por_caja  |  4->$aclaracion)
	//  OUT:    null o 1. Hace el update
	public  function update_tabla_sec ($valores=NULL){
		return "
			UPDATE bod_mercaderia_mal_estado_prod
			SET 	id_pro_productos 		= $valores[1],
					nro_caja_bmm			= $valores[2],
					productos_por_caja_bmm = $valores[3],
					aclaracion 				= '$valores[4]',
					activo 					= 1
			WHERE id_bod_mercaderia_mal_estado_prod = $valores[0]
			;
		";
	}



}