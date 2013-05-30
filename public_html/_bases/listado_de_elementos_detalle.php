<?php

class listado_de_elementos_detalle {

	public  function consulta_detalle ($valores=NULL){
	
		return "
			SELECT      orden
			,           titulo
			,           texto
			,           fecha_alta
			,           link
			FROM        adm_valores
			WHERE		id_adm_valores = $valores[0]
			;
		";
	
	}	

}