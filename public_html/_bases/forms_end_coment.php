<?php

class forms_end_coment extends FormCommon {
    
    //  Cierra el mantenimiento ya cargado, poniendo el campo activo en 1.
    //  IN:     (0->id_tabla)
    public  function update_cierre ($valores=NULL){
        return "
            UPDATE adm_ytd_mantenimiento_recordatorio
            SET activo = 1
            WHERE id_adm_ytd_mantenimiento_recordatorio = $valores[0];
        ";
    }

}