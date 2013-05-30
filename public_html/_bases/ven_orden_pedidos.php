<?php

class ven_orden_pedidos extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal ven_orden_pedidos
    //  IN:     (0->$id_tabla  |  1->$id_ven_cliente_sucursales  |  2->observacion  |  3->id_cv_datos_personales)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_orden_pedidos
            SET id_ven_cliente_sucursales = $valores[1],
                    id_cv_datos_personales = $valores[3],
                    observacion = '$valores[2]',
                    habilitado = 1
            WHERE id_ven_orden_pedidos = $valores[0]
            ; 
        ";
    }

    // $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $fecha_alta), 'n');
    //  Hace el update correspondiente sobre la tabla principal ven_orden_pedidos
    //  IN:     (0->$id_tabla_sec  |  1->$producto  |  2->cantidad  |  3->precio  |  4->fecha_alta)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ven_orden_pedidos_prod
            SET id_pro_productos = $valores[1],
                    cantidad = $valores[2],
                    precio = $valores[3],
                    fecha_alta = $valores[4],
                    habilitado = 1,
                    activo = 1
            WHERE id_ven_orden_pedidos_prod = $valores[0]
            ; 
        ";
    }

    //  Selecciona los valores para hacer un select combinado, con 
    //  IN:     (0->xxxxxxx  |  1->xxxxxxx)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function clientes_direcciones ($valores=NULL){
        return "
            SELECT *, vcs.direccion AS direccion_vc
            FROM ven_cliente_sucursales AS vcs
            JOIN ven_cliente AS vc
                ON vcs.id_ven_cliente=vc.id_ven_cliente
            ;
        ";
    }

    // busca el producto según la referencia
    // Lo uso con AJAX para seleccionar
    public  function search_precio ($valores=NULL){
        return "
            SELECT id_pro_productos, precio
            FROM pro_productos
            WHERE id_pro_productos = $valores[0]          
            ; 
        ";
    }


}