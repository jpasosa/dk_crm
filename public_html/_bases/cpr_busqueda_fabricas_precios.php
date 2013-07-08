<?php

class cpr_busqueda_fabricas_precios extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal cpr_busqueda_fabricas_precios
    //  IN:     (0->$id_tabla  |  1->$proveedor  |  2->$pais_ciudad  |  3->$direccion  |  4->$contacto  |  5->$telefono  |  6->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE cpr_busqueda_fabricas_precios
            SET proveedor = '$valores[1]',
                    id_sis_provincia = $valores[2],
                    direccion = '$valores[3]',
                    contacto = '$valores[4]',
                    telefono = '$valores[5]',
                    observaciones = '$valores[6]'
            WHERE id_cpr_busqueda_fabricas_precios = $valores[0]
            ;
        ";
    }

    //  Hace el update correspondiente
    //  IN:     (0->$id_tabla_sec  |  1->$producto  |  2->$detalle  |  3->$precio  |  4->$cantidad_min)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE cpr_busqueda_fabricas_precios_prod
            SET producto =' $valores[1]',
                    detalle = '$valores[2]',
                    precio = $valores[3],
                    cantidad_min = $valores[4],
                    activo = 1
            WHERE id_cpr_busqueda_fabricas_precios_prod = $valores[0]
            ;
        ";
    }

}