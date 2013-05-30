<?php

class tabla {
	
	public  function consulta_general ($valores=NULL){
	
		return "
			SELECT      id_adm_valores AS id
			,           orden
			,           titulo
			,           texto
			,           fecha_alta
			,           link
			FROM        adm_valores
			;
		";
	
	}	

}