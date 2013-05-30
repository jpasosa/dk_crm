<?php

class ven_solicitud_viaticos_viajes extends FormCommon {
    
    // Nombre y apellido del empleado logueado
    public  function empleado_nombres ($valores=NULL){
        return "
            SELECT nombre, apellido
            FROM cv_datos_personales
            WHERE id_cv_datos_personales = $valores[0]
            ; 
        ";
    }   

    // último id de la tabla principal: ven_solicitud_viaticos_viajes
    // public  function lastId_ven_solicitud_viaticos_viajes ($valores=NULL){
    //     return "
    //         SELECT id_ven_solicitud_viaticos_viajes AS id, id_solicitud_viaticos_viajes_proc AS id_proc
    //         FROM ven_solicitud_viaticos_viajes
    //         ORDER BY id_ven_solicitud_viaticos_viajes
    //         DESC LIMIT 1
    //         ; 
    //     ";
    // }

    // Clientes habilitados. Devuelve para mostrar en el select
    // TODO: en el show no debe mostrar los clientes que ya están seleccionados en ese
    public  function clientes_habilitados_show ($valores=NULL){
        return " 
            SELECT  s.id_ven_cliente_sucursales AS id_suc,
                        c.id_ven_cliente AS id_cli,
                        @user:=c.usuario AS usuario,
                        @suc:=s.nombre_sucursal AS sucursal,
                        @emp:=c.empresa AS empresa,
                        concat_ws(' / ', @user, @suc, @emp) AS cliente
                        
            FROM ven_cliente_sucursales s
            JOIN ven_cliente c ON s.id_ven_cliente=c.id_ven_cliente
            WHERE c.habilitado=1
            ORDER BY c.usuario, s.nombre_sucursal
            ; 
        ";
    }



    // obtiene el id_cleinte pasando la sucursal a la que pertenece, Hay q pasar los clientes act dentro del proceso.
    //public  function cliente ($valores=NULL){
    //    return "
    //        SELECT *
    //        FROM ven_cliente_sucursales s
    //        WHERE s.id_ven_cliente_sucursales = $valores[0]            
    //        ; 
    //    ";
    //}

        // obtiene el id_cleinte pasando la sucursal a la que pertenece, Hay q pasar los clientes act dentro del proceso.
    // public  function provincia_cliente ($valores=NULL){
    //     return "
    //         SELECT *
    //         FROM ven_cliente c
    //         JOIN sis_provincia p ON c.id_sis_provincia=p.id_sis_provincia
    //         WHERE c.id_ven_cliente = $valores[0]            
    //         ; 
    //     ";
    // }

    // obtiene el pais
    // public  function pais_cliente ($valores=NULL){
    //     return "
    //         SELECT *
    //         FROM sis_provincia prov
    //         JOIN sis_pais pais ON prov.id_sis_pais = pais.id_sis_pais
    //         WHERE prov.id_sis_provincia = $valores[0]             
    //         ; 
    //     ";
    // }

    // todos los clientes relacionados con un proceso
    public  function clientes_en_proceso_full ($valores=NULL){
        return "
            SELECT cl.id_ven_solicitud_viaticos_viajes_clientes AS solicit_cliente,
                        cl.id_ven_cliente_sucursales AS suc_cl,
                        suc.id_ven_cliente AS id_cliente,
                        suc.nombre_sucursal AS nombre_sucursal,
                        cliente.empresa AS empresa,
                        cliente.usuario AS usuario,
                        prov.provincia AS provincia,
                        pais.pais AS pais
            FROM ven_solicitud_viaticos_viajes_clientes AS cl
                JOIN ven_cliente_sucursales AS suc
                ON cl.id_ven_cliente_sucursales=suc.id_ven_cliente_sucursales
                JOIN ven_cliente AS cliente
                ON suc.id_ven_cliente=cliente.id_ven_cliente
                JOIN sis_provincia AS prov
                ON cliente.id_sis_provincia=prov.id_sis_provincia
                JOIN sis_pais AS pais
                ON prov.id_sis_pais=pais.id_sis_pais
                    WHERE cl.id_ven_solicitud_viaticos_viajes_proc = $valores[0] AND cl.activo = 1          
            ; 
        ";
    }



    // eliminar clientes gastos
    // public  function elim_cliente_gastos ($valores=NULL){
    //     die('pepe');
    //     return "
    //         SELECT *
    //         FROM ven_solicitud_viaticos_viajes_gastos AS gastos
    //         JOIN sis_gastos_viajes AS ref
    //         ON gastos.id_sis_gastos_viajes=ref.id_sis_gastos_viajes
    //         WHERE gastos.id_ven_solicitud_viaticos_viajes_proc = $valores[0] AND gastos.activo = 1          
    //         ; 
    //     ";
    // }

    // eliminar viaticos_viajes_clientes
    // public  function elim_cliente ($valores=NULL){
    //     return "
    //         UPDATE ven_solicitud_viaticos_viajes_clientes
    //         SET activo = 0
    //         WHERE id_ven_solicitud_viaticos_viajes_clientes = $valores[0]
    //         ; 
    //     ";
    // }

    // antes de insertar debe comprobar si existe el cliente
    // valores[0] -> id_proces, valores[1] -> id_suc 
    public  function comprobar_cliente ($valores=NULL){
        return "
            SELECT *
            FROM ven_solicitud_viaticos_viajes_clientes
            WHERE id_ven_cliente_sucursales = $valores[1]
                        AND id_ven_solicitud_viaticos_viajes_proc = $valores[0]
                        AND activo = 1
            ; 
        ";
    }

    // inserto un cliente en un proceso dado
    public  function insert_cliente ($valores=NULL){
        return "
            INSERT
            INTO ven_solicitud_viaticos_viajes_clientes
                    (activo, id_ven_cliente_sucursales, id_ven_solicitud_viaticos_viajes_proc)
            VALUES
                    ('1', $valores[1], $valores[0])
            ; 
        ";
    }

    //
    // CONSULTAS PARA LOS GASTOS DE LOS VIAJES
    //

    // las referencias para el select
    public  function referencias_show ($valores=NULL){
        return "
            SELECT id_sis_gastos_viajes AS id, referencia AS ref
            FROM sis_gastos_viajes
            ; 
        ";
    }

    // todos los gastos de un proceso
    public  function clientes_gastos ($valores=NULL){
        return "
            SELECT g.id_ven_solicitud_viaticos_viajes_gastos AS id,
                        ref.referencia,
                        g.detalle,
                        g.monto,
                        ref.id_sis_gastos_viajes AS id_ref
            FROM ven_solicitud_viaticos_viajes_gastos AS g
            JOIN sis_gastos_viajes AS ref
            ON g.id_sis_gastos_viajes=ref.id_sis_gastos_viajes
            WHERE g.id_ven_solicitud_viaticos_viajes_proc = $valores[0] AND g.activo = 1          
            ; 
        ";
    }

    // Eliminar gastos, de los clientes_gastos. Lo usamos con ajax.
    // public  function elim_cliente_gasto ($valores=NULL){
    //     return "
    //         UPDATE ven_solicitud_viaticos_viajes_gastos
    //         SET activo = 0
    //         WHERE id_ven_solicitud_viaticos_viajes_gastos = $valores[0]
    //         ; 
    //     ";
    // }

    //  Hace un update en ven_solicitud_viaticos_viajes_gastos
    //  IN:     (0->$id_tabla_sec |  1->$referencia  |  2->$detalle  |  3-> $monto)
    //  OUT:    Hace el update
    public  function update_gasto ($valores=NULL){
        return "
            UPDATE ven_solicitud_viaticos_viajes_gastos
            SET id_sis_gastos_viajes = $valores[1], detalle = '$valores[2]', monto = $valores[3]
            WHERE id_ven_solicitud_viaticos_viajes_gastos = $valores[0]
            ; 
        ";
    }

    // suma de los montos de todos los GASTOS
    public  function suma_de_montos ($valores=NULL){
        return "
            SELECT SUM(g.monto) AS MontoTot
            FROM ven_solicitud_viaticos_viajes_gastos AS g
            WHERE g.id_ven_solicitud_viaticos_viajes_proc = $valores[0] AND g.activo = 1          
            ; 
        ";
    }

    //  Hace un update en ven_solicitut_viaticos_viajes, definiendo fecha_inicio, fecha_fin, observaciones.
    //  IN:     (0->$id_process, 1->$id_ven_solcitud_viaticos_viajes, 2->fecha_inicio, 3->fecha_fin, 4->observaciones)
    //  OUT:    NULL o int(1)
    public  function update_fechas ($valores=NULL){
        return "
            UPDATE ven_solicitud_viaticos_viajes
            SET fecha_inicio = $valores[2], fecha_fin = $valores[3], observaciones = '$valores[4]' 
            WHERE id_ven_solicitud_viaticos_viajes = $valores[1] AND id_ven_solicitud_viaticos_viajes_proc = $valores[0]
            ; 
        ";
    }

    //  Select de ven_solicitud_viaticos_viajes.
    //  IN:     ($id_ven_solicitud_viaticos_viajes)
    //  OUT:    fecha_inicio, fecha_fin, observaciones
    // public  function select_fechas_oberv ($valores=NULL){
    //     return "
    //         SELECT FROM_UNIXTIME(fecha_inicio, '%d/%m/%Y') AS fecha_inicio,
    //                     FROM_UNIXTIME(fecha_fin, '%d/%m/%Y') AS fecha_fin, observaciones
    //         FROM ven_solicitud_viaticos_viajes
    //         WHERE id_ven_solicitud_viaticos_viajes = $valores[0]
    //         ; 
    //     ";
    // }

    // 






}