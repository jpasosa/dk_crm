<?php




class tra_packing_list extends FormCommon
{

	//  IN:     (0->$id_tabla  |  1->$proveedor  |  2->$nombre_trapackinglist  |  3->$fecha_envio_unix  |  4->$fecha_llegada_unix  |  5->$observaciones)
	public  function update_tabla_princ ($valores=NULL) {
		return "
			UPDATE tra_packing_list
			SET 	id_cpr_proveedores 		= $valores[1],
					nombre_trapackinglist	= $valores[2],
					fecha_envio 			= $valores[3],
					fecha_llegada 			= $valores[4],
					observaciones 			= '$valores[5]'
			WHERE id_tra_packing_list = $valores[0]
			;
		";
	}

	//  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
	//  IN:     (0->$id_tabla_sec  |  1->$id_pro_productos  |  2->$nro_caja  |  3->$productos_por_caja  |  4->$alto  |  5->$ancho  |  6->$fondo  |  7->$peso  |  8->$volumen)
	//  OUT:    null o 1. Hace el update
	public  function update_tabla_sec ($valores=NULL){
		return "
			UPDATE tra_packing_list_prod
			SET 	id_pro_productos = $valores[1],
					nro_caja_tpl		= $valores[2],
					productos_por_caja_tpl = $valores[3],
					alto_tpl 			= $valores[4],
					ancho_tpl		= $valores[5],
					fondo_tpl		= $valores[6],
					peso_tpl		= $valores[7],
					volumen_tpl		= $valores[8],
					activo 			= 1
			WHERE id_tra_packing_list_prod = $valores[0]
			;
		";
	}


	//  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
	//  IN:     (0->$id_tabla)
	//  OUT:    null o 1. Hace el update
	public  function get_file ($valores=NULL){
		return "
			SELECT archivo
			FROM tra_packing_list
			WHERE id_tra_packing_list = $valores[0]
			;
		";
	}

	// busca la descripcion en tabla sis_cuentas
	public  function search_descripcion ($valores=NULL){
		return "
			SELECT descripcion
			FROM sis_cuentas
			WHERE cuenta = $valores[0]
			;
		";
	}

	// busca la descripcion en tabla sis_cuentas
	public  function search_cuenta ($valores=NULL){
		return "
			SELECT cuenta
			FROM sis_cuentas
			WHERE descripcion = '$valores[0]'
			;
		";
	}

}