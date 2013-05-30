<?php

class bd_consulta {
	
	public  function consulta_general ($valores=NULL){
	
		return "
			SELECT      id_adm_bdconsulta   AS id
			,           orden
			,           texto
			FROM        adm_bdconsulta
			;
		";
	
	}	

	public  function sin_valores ($valores=NULL){
	
		return "
			SELECT      id_adm_sin_valores  AS id
			,           orden
			,           titulo
			FROM        adm_sin_valores
			;
		";
	
	}	


	public  function html_checkboxes ($valores=NULL){
	
		return "
			SELECT     
			           texto               AS etiqueta
			FROM        adm_bdconsulta
			;
		";
	
	}	


}