<?php




class tra_ytd_entrada_coment extends FormCommon {


	// Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
	public  function select_tabla_sec ($valores=NULL){
		return "
			 SELECT * FROM tra_ytd_entrada_prod AS princ
			 	JOIN pro_productos AS rel
			 		ON princ.id_pro_productos=rel.id_pro_productos
			 	JOIN sis_problemas AS rel_uno
			 		ON princ.id_sis_problemas=rel_uno.id_sis_problemas
			 	JOIN pro_marca AS rel_dos
			 		ON princ.id_pro_marca=rel_dos.id_pro_marca
			 	JOIN pro_subfamilia AS pro_subfamilia
			 		ON princ.id_pro_subfamilia=pro_subfamilia.id_pro_subfamilia
			 	JOIN pro_familia AS fam
			 		ON pro_subfamilia.id_pro_familia=fam.id_pro_familia
			 WHERE princ.id_tra_ytd_entrada_proc = $valores[0];
		";
	}


}