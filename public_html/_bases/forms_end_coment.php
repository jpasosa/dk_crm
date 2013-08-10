<?php

class forms_end_coment extends FormCommon
{


	//  Cierra el mantenimiento ya cargado, poniendo el campo activo en 1.
	//  IN:     (0->id_tabla)
	public  function update_cierre ($valores=NULL) {
		return "
		UPDATE adm_ytd_mantenimiento_recordatorio
		SET activo = 1
		WHERE id_adm_ytd_mantenimiento_recordatorio = $valores[0];
		";
	}

	//  Hace el update sobre pro_productos, cuando cierra ultimo paso de bod_entrada_mercaderia. . . .
	//  IN:     (0->$prod['id_pro_productos']  |  1->$prod['id_pro_marca']  |  2->$prod['id_pro_subfamilia']  |  3->$prod['productos_por_caja_bem']  |  4->$prod['alto_bem']
	// 			5->$prod['ancho_bem']  |  6->$prod['fondo_bem']  |  7->$prod['volumen_bem']  |  8->$prod['peso_bem']  |  9->$prod['precio_bem']  |  10->$prod['foto_bem'])
	public  function update_productos ($valores=NULL) {
		return "
		UPDATE pro_productos
		SET 	id_pro_marca 		= $valores[1],
			 	id_pro_subfamilia 	= $valores[2],
			 	productos_por_caja = $valores[3],
			 	alto 				= $valores[4],
			 	ancho 				= $valores[5],
			 	fondo 				= $valores[6],
			 	volumen 			= $valores[7],
			 	peso 				= $valores[8],
			 	precio 				= $valores[9],
			 	archivo 				= '$valores[10]'
		WHERE id_pro_productos = $valores[0]
		;
		";
	}


}