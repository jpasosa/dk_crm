<?php

class logueo extends FormCommon {

    //  busca user y pass son correctos.
    //  IN:     (0->user 1->pass)
    //  OUT:    nos dice si existe user y pass }
    public  function user_pass ($valores=NULL){
        return "
            SELECT *
            FROM cv_datos_personales
            WHERE usuario = '$valores[0]' AND clave = '$valores[1]'
            ; 
        ";
    }

    //  busca user y pass son correctos.
    //  IN:     (0->user 1->pass)
    //  OUT:    nos dice si existe user y pass }
    public  function user_pass_cliente ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_contacto
            WHERE usuario = '$valores[0]' AND clave = '$valores[1]'
            ; 
        ";
    }
    
    
}