<?php

class cpr_pedidos_muestras extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal cpr_pedidos_muestras
    //  IN:     (0->$id_tabla  |  1->$proveedor  |  2->$direccion  |  3->$provincia  |  4->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE cpr_pedidos_muestras
            SET proveedor = '$valores[1]',
                    direccion = '$valores[2]',
                    id_sis_provincia = $valores[3],
                    observaciones = '$valores[4]'
            WHERE id_cpr_pedidos_muestras = $valores[0]
            ;
        ";
    }

    // $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $fecha_alta), 'n');
    //  Hace el update correspondiente sobre la tabla principal cpr_pedidos_muestras
    //  IN:     (0->$id_tabla_sec  |  1->$referencia  |  2->cantidad)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE cpr_pedidos_muestras_prod
            SET referencia_de_producto = '$valores[1]',
                    cantidad = $valores[2],
                    activo = 1
            WHERE id_cpr_pedidos_muestras_prod = $valores[0]
            ;
        ";
    }


}