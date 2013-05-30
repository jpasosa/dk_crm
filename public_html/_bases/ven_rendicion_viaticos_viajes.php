<?php

class ven_rendicion_viaticos_viajes extends FormCommon {
    
    // Nombre y apellido del empleado logueado
    public  function empleado_nombres ($valores=NULL){
        return "
            SELECT nombre, apellido
            FROM cv_datos_personales
            WHERE id_cv_datos_personales = $valores[0]
            ; 
        ";
    }   

    // suma de los montos de todos los GASTOS
    public  function suma_de_montos ($valores=NULL){
        return "
            SELECT SUM(g.monto) AS MontoTot
            FROM ven_rendicion_viaticos_viajes_gast AS g
            WHERE g.id_ven_rendicion_viaticos_viajes_proc = $valores[0] AND g.activo = 1          
            ; 
        ";
    }



    //  Hace un update de ven_rendicion_viaticos_viajes
    //  IN:     (0->id_tabla  |  1->fecha_inicio  |  2->fecha_fin  |  3->observaciones)
    //  OUT:    Hace el update
    public  function update_tabla ($valores=NULL){
        return "
            UPDATE ven_rendicion_viaticos_viajes
            SET fecha_inicio = $valores[1],
                    fecha_fin = $valores[2],
                    observaciones = '$valores[3]'
            WHERE id_ven_rendicion_viaticos_viajes = $valores[0]
            ;
        ";
    }

    //  Inserta en ven_rendicion_viaticos_viajes_gast
    //  IN:     (0->id_tabla_proc  |  1->detalle  |  2->monto  |  3->id_sis_gastos_viajes)
    //  OUT:    Hace un INSERT
    public  function insert_tabla_gastos ($valores=NULL){
        return "
            INSERT
            INTO ven_rendicion_viaticos_viajes_gast
                    (id_ven_rendicion_viaticos_viajes_proc, activo, detalle, monto, id_sis_gastos_viajes)
            VALUES
                    ($valores[0], '1', '$valores[1]', $valores[2], $valores[3])
            ; 
        ";
    }

    //  Inserta en ven_rendicion_viaticos_viajes_clientes
    //  IN:     (0->id_tabla_proc  |  1->id_ven_cliente_sucursales)
    //  OUT:    Hace un INSERT
    public  function insert_tabla_clientes ($valores=NULL){
        return "
            INSERT
            INTO ven_rendicion_viaticos_viajes_clientes
                    (id_ven_rendicion_viaticos_viajes_proc, activo, id_ven_cliente_sucursales)
            VALUES
                    ($valores[0], '1', $valores[1])
            ; 
        ";
    }

    //  Hace un update de ven_rendicion_viaticos_gast del monto_real
    //  IN:     (0->id_tabla_gast  |  1->monto_real)
    //  OUT:    Hace el update
    public  function update_monto_real ($valores=NULL){
        return "
            UPDATE ven_rendicion_viaticos_viajes_gast
            SET monto_real = $valores[1]
            WHERE id_ven_rendicion_viaticos_viajes_gast = $valores[0]
            ;
        ";
    }

    //  Hace un update en ven_rendicion_viaticos_viajes_gast
    //  IN:     (0->$id_tabla_sec |  1->$referencia  |  2->$detalle  |  3-> $monto)
    //  OUT:    Hace el update
    public  function update_gasto ($valores=NULL){
        return "
            UPDATE ven_rendicion_viaticos_viajes_gast
            SET id_sis_gastos_viajes = $valores[1], detalle = '$valores[2]', monto_real = $valores[3]
            WHERE id_ven_rendicion_viaticos_viajes_gast = $valores[0]
            ; 
        ";
    }





}