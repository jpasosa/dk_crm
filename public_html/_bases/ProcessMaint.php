<?php

class _ProcessMaint {
    
    

    // Busca todos los mantenimientos que ya están cerrados
    //  IN:     (0->id_area)
    //  OUT:    me devuelve el nombre del proceso en ['proceso']
    public  function search_mant_cerrados ($valores=NULL){
        return "
            SELECT *
            FROM adm_ytd_mantenimientos
            WHERE id_adm_ytd_amntenientos_proc = 0
            ; 
        ";
    }
}