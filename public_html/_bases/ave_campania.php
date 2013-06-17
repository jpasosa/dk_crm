<?php

class ave_campania extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal ave_campania
    //  IN:     (0->$id_tabla  |  1->$campania  |  2->$motivo  |  3->$fecha_inicio_unix  |  4-> $hora  |  5->$mlg_fecha_inicio_unix  |  6->$mlg_asunto  |  7->$mlg_texto)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ave_campania
            SET campania = '$valores[1]',
                    motivo = '$valores[2]',
                    fecha_inicio = $valores[3],
                    hora = '$valores[4]',
                    mlg_fecha_inicio = $valores[5],
                    mlg_asunto = '$valores[6]',
                    mlg_texto = '$valores[7]'
            WHERE id_ave_campania = $valores[0]
            ; 
        ";
    }

    // $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $fecha_alta), 'n');
    //  Hace el update correspondiente sobre la tabla principal ave_campania
    //  IN:     (0->$id_tabla_sec  |  1->$id_ven_cliente_contacto  |  2->hora)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ave_campania_clientes
            SET id_ven_cliente_contacto = $valores[1],
                    hora = '$valores[2]',
                    activo = 1
            WHERE id_ave_campania_clientes = $valores[0]
            ; 
        ";
    }

    //  Selecciona los valores para hacer un select combinado, con 
    //  IN:     (0->xxxxxxx  |  1->xxxxxxx)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function ven_cliente_contacto ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_contacto
            WHERE id_ven_cliente_sucursales = $valores[0]
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