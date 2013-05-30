<?php

class ger_planificacion_gastos extends FormCommon {
    

    // trae las observaciones
    // public  function get_observaciones ($valores=NULL){
    //     return "
    //         SELECT observaciones
    //         FROM ger_planificacion_gastos
    //         WHERE id_ger_planificacion_gastos = $valores[0]          
    //         ; 
    //     ";
    // }
    
    // setea las observaciones
    // public  function seteo_observaciones ($valores=NULL){
    //     return "
    //         UPDATE ger_planificacion_gastos
    //         SET observaciones = '$valores[1]'
    //         WHERE id_ger_planificacion_gastos = $valores[0]
    //         ; 
    //     ";
    // }

    // // todos los gastos de una planificacion de gerencia en un proceso dado y que estén activos.
    // public  function planificacion_gastos_detalle ($valores=NULL){
    //     return "
    //         SELECT gd.id_ger_planificacion_gastos_detalle AS id, c.cuenta AS cuenta, c.descripcion AS descripcion,
    //                     gd.detalle AS detalle, p.nombre AS proveedor, gd.mes AS mes, gd.monto AS monto 
    //         FROM ger_planificacion_gastos_detalle AS gd
    //         JOIN sis_cuentas AS c
    //             ON c.id_sis_cuentas = gd.id_sis_cuentas
    //         JOIN crp_proveedores AS p
    //             ON gd.id_crp_proveedores = p.id_crp_proveedores
    //         WHERE gd.id_ger_planificacion_gastos_proc = $valores[0]
    //             AND gd.activo =1; 
    //     ";
    // }

    // busca la descripcion en tabla sis_cuentas
    public  function search_descripcion ($valores=NULL){
        return "
            SELECT descripcion
            FROM sis_cuentas
            WHERE cuenta = $valores[0]          
            ; 
        ";
    }

    // busca la descripcion en tabla sis_cuentas
    public  function search_cuenta ($valores=NULL){
        return "
            SELECT cuenta
            FROM sis_cuentas
            WHERE descripcion = '$valores[0]'          
            ; 
        ";
    }

    // eliminar detalles de los gastos
    // public  function elim_detalle ($valores=NULL){
    //     return "
    //         UPDATE ger_planificacion_gastos_detalle
    //         SET activo = 0
    //         WHERE id_ger_planificacion_gastos_detalle = $valores[0]
    //         ; 
    //     ";
    // }

    // eliminar detalles de los gastos
    // public  function edit_detalle ($valores=NULL){
    //     return "
    //         insert into ger_planificacion_gastos_detalle (orden) values (3);
    //     ";
    // }

    // update detalles de los gastos, en la planificacion de gastos
    //  IN:     (0->id_tabla_sec 1->id_cuenta  2->detalle 3->mes 4->monto 5->proveedor
    //  OUT:    registro entero a duplicar puesto en tabla temporal    
    public  function update_detalle ($valores=NULL){
        return "
            UPDATE ger_planificacion_gastos_detalle
            SET id_sis_cuentas = $valores[1], detalle = '$valores[2]', mes = $valores[3], monto = $valores[4], id_crp_proveedores = $valores[5]
            WHERE id_ger_planificacion_gastos_detalle = $valores[0]
            ; 
        ";
    }

    // seleccionar los nombres de los proveedores para el select
    // public  function proveedores ($valores=NULL){
    //     return "
    //         SELECT id_crp_proveedores AS id, nombre AS nombre
    //         FROM crp_proveedores
    //         ; 
    //     ";
    // }

    // suma de los montos de todos los GASTOS
    // public  function suma_de_montos ($valores=NULL){
    //     return "
    //         SELECT SUM(g.monto) AS MontoTot
    //         FROM ger_planificacion_gastos_detalle AS g
    //         WHERE g.id_ger_planificacion_gastos_proc = $valores[0] AND g.activo = 1          
    //         ; 
    //     ";
    // }

















    
    // todas las opciones de los hoteles en un proceso dado. . . .
    // public  function hoteles_opc ($valores=NULL){
    //     return "
    //         SELECT *
    //         FROM ave_comparacion_hoteles_opc
    //         WHERE id_ave_comparacion_hoteles_proc = $valores[0]
    //             AND activo = 1
    //         ; 
    //     ";
    // }

    // INSERTO hotel, descripcion, monto en un proceso. Lo usamos con ajax.
    // 0->proceso / 1->hotel / 2->comentario / 3->costo  
    // public  function insert_gasto ($valores=NULL){
    //     return "
    //         INSERT
    //         INTO ave_comparacion_hoteles_opc
    //                 (id_ave_comparacion_hoteles_proc, activo, hotel, comentario, costo)
    //         VALUES
    //                 ($valores[0], 1, '$valores[1]', '$valores[2]', $valores[3])
    //         ; 
    //     ";
    // }

    // eliminar gastos de hotel
    // public  function elim_gasto_hotel ($valores=NULL){
    //     return "
    //         UPDATE ave_comparacion_hoteles_opc
    //         SET activo = 0
    //         WHERE id_ave_comparacion_hoteles_opc = $valores[0]
    //         ; 
    //     ";
    // }

    // insertar el nombre del archivo
    // public  function insertar_archivo ($valores=NULL){
    //     return "
    //         UPDATE ave_comparacion_hoteles_opc
    //         SET archivo = '$valores[1]'
    //         WHERE id_ave_comparacion_hoteles_opc = $valores[0]
    //         ; 
    //     ";
    // }







}