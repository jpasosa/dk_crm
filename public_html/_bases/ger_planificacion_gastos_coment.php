<?php

class ger_planificacion_gastos_coment extends FormCommon {


    // trae las observaciones
    public  function get_observaciones ($valores=NULL){
        return "
            SELECT observaciones
            FROM ger_planificacion_gastos
            WHERE id_ger_planificacion_gastos = $valores[0]
            ;
        ";
    }



    // todos los gastos de una planificacion de gerencia en un proceso dado y que estén activos.
    public  function planificacion_gastos_detalle ($valores=NULL){
        return "
            SELECT gd.id_ger_planificacion_gastos_detalle AS id, c.cuenta AS cuenta, c.descripcion AS descripcion,
                        gd.detalle AS detalle, p.nombre AS proveedor, gd.mes AS mes, gd.monto AS monto
            FROM ger_planificacion_gastos_detalle AS gd
            JOIN sis_cuentas AS c
                ON c.id_sis_cuentas = gd.id_sis_cuentas
            JOIN cpr_proveedores AS p
                ON gd.id_cpr_proveedores = p.id_cpr_proveedores
            WHERE gd.id_ger_planificacion_gastos_proc = $valores[0]
                AND gd.activo =1;
        ";
    }


    // seleccionar los nombres de los proveedores para el select
    public  function proveedores ($valores=NULL){
        return "
            SELECT id_cpr_proveedores AS id, nombre AS nombre
            FROM cpr_proveedores
            ;
        ";
    }

    // suma de los montos de todos los GASTOS
    public  function suma_de_montos ($valores=NULL){
        return "
            SELECT SUM(g.monto) AS MontoTot
            FROM ger_planificacion_gastos_detalle AS g
            WHERE g.id_ger_planificacion_gastos_proc = $valores[0] AND g.activo = 1
            ;
        ";
    }


    // suma de los montos de todos los GASTOS
    public  function select_tabla_proc ($valores=NULL){
        return "
            SELECT *
            FROM ger_planificacion_gastos_proc
            WHERE id_ger_planificacion_gastos_proc = $valores[0]
            ;
        ";
    }










}