<?php

class listado_de_elementos {

	public  function cantidad_elementos ($valores=NULL){
	
		return "
			SELECT      COUNT(*) AS cantidad
			FROM        adm_valores
			;
		";
	
	}
	
	public  function consulta ($valores=NULL){
	
		return "
			SELECT      id_adm_valores AS id
			,			orden
			,           titulo
			,           texto
			,           fecha_alta
			,           link
			FROM        adm_valores
			ORDER BY	orden
			LIMIT		$valores[0], $valores[1]
			;
		";
	
	}	

}