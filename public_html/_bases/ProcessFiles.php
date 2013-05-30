<?php

class _ProcessFiles {
    
        //  nos dá la cantidad de archivos que tiene activo en ese proceso (no deberían ser más de 5)
    //  IN:     (0->pr_proceso  |  1->id_tabla_proc)
    //  OUT:    nos devuelve el registro entero con ese id 
    public  function cant_arch ($valores=NULL){
        return "
            SELECT COUNT( * )  AS cant_reg
            FROM $valores[0]_arch
            WHERE id_$valores[0]_proc = $valores[1] AND activo =1
            ;
        ";
    }


    //  IN:     (0->pr_proceso  |  1->id_tabla_proc)
    //  OUT:    me crea un registro, vacio con id_tabla_proc, en tabla_arch
    public  function insert_arch_blanco ($valores=NULL){
        return "
            INSERT
            INTO $valores[0]_arch
                    (id_$valores[0]_proc)
            VALUES
                    ($valores[1])
            ;  
        ";
    }

        //  hace un update para poner el nombre del archivo ya teniendo proceso e id_arch, pone activo en uno.
    //  IN:     (0->pr_proceso  |  1->id_tabla_arch  |  2->nombre del archivo)
    //  OUT:    Hace el update
    public  function insert_archivo ($valores=NULL){
        return "
            UPDATE $valores[0]_arch
            SET activo = 1, archivo = '$valores[2]'
            WHERE id_$valores[0]_arch = $valores[1];
            ;   
        ";
    }


    // Pone el nombre del archivo que subio al servidor en el campo indicado
    //  IN:     (0->pr_proceso  |  1->pr_proceso_sec  |  2->campo  |  3->id_tabla_sec  |  4->nombre_archivo
    //  OUT:    Hace el update correspondiente
    public  function update_archivo ($valores=NULL){
        return "
            UPDATE $valores[0]_$valores[1]
            SET $valores[2] = '$valores[4]'
            WHERE id_$valores[0]_$valores[1] = $valores[3]
            ; 
        ";
    }

    // Pone el nombre del archivo que subio al servidor en el campo indicado.. Trabaja con la tabla principal
    //  IN:     (0->pr_proceso  |   1->campo  |  2->id_tabla  |  3->nombre_archivo
    //  OUT:    Hace el update correspondiente
    public  function update_archivo_princ ($valores=NULL){
        return "
            UPDATE $valores[0]
            SET $valores[1] = '$valores[3]'
            WHERE id_$valores[0] = $valores[2]
            ; 
        ";
    }

    
    // Pone activo en 0 a algún archivo.
    //  IN:     (0->pr_proceso  |  id_tabla_arch)
    //  OUT:    Hace el update correspondiente
    public  function delete_file ($valores=NULL){
        return "
            UPDATE $valores[0]_arch
            SET activo = 0
            WHERE id_$valores[0]_arch = $valores[1]
            ; 
        ";
    }

    // Pone activo en 0 a algún archivo.
    //  IN:     (0->pr_proceso  |  1->campo  |  2->id_tabla)
    //  OUT:    Hace el update correspondiente
    public  function delete_file_princ ($valores=NULL){
        return "
            UPDATE $valores[0]
            SET $valores[1] = NULL
            WHERE id_$valores[0] = $valores[2]
            ; 
        ";
    }


































    
}