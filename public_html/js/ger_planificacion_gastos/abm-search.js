$(document).ready(function() {
    //##### SEARCH CUENTA -> IMPRIME DESCRIPCION #########
        $("input.cuenta").blur(function(search){
            search.returnValue = false;
            search.preventDefault();
            var cuenta = $("input.cuenta").val();
            if(cuenta != '') {
                jQuery.ajax({
                        type: "POST",
                        url: "/ger_planificacion_gastos.html",
                        dataType: "text",
                        data: {
                            cuenta: cuenta,
                        }, 
                        success:function(response, status, xhr){
                            desc = xhr.getResponseHeader("descripcion");
                            if(desc == null) {
                                $("input.descripcion").val('cuenta no encontrada. . .');
                            }else{
                                $("input.descripcion").val(desc);    
                            }
                            // $("html").append(response);
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
            }
            $("input.descripcion").val('');
    });

    //##### SEARCH DESCRIPCION -> IMPRIME CUENTA #########
        $("input.descripcion").blur(function(search){
            search.returnValue = false;
            search.preventDefault();
            var descripcion = $("input.descripcion").val();
            if(descripcion != '') {
                jQuery.ajax({
                        type: "POST",
                        url: "/ger_planificacion_gastos.html",
                        dataType: "text",
                        data: {
                            descripcion: descripcion,
                        }, 
                        success:function(response, status, xhr){
                            cuenta = xhr.getResponseHeader("cuenta")
                            if(cuenta == null) {
                                $("input.cuenta").val('descripcion no encontrada. . .');
                            }else{
                                $("input.cuenta").val(cuenta);    
                            }
                            // $("html").append(response);
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
            }
            $("input.cuenta").val('');
    });

    //##### ELIMINAR GASTOS DE LA PLANILLA DE GASTOS #########
    $("body").on("click", ".del_gasto", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto_del = clickedID[1];
        // tengo que modificar el monto total también con jquery
        var selector = "tr#id_gastos-" + id_gasto_del + " span.monto";
        var monto_texto = $(selector).text();
        var monto = parseFloat(monto_texto);
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ger_planificacion_gastos.html",
                        dataType: "text",
                        data: {
                            id_gasto_del: id_gasto_del
                        },
                        success:function(response, status, xhr){
                            // borrar el que marque por acá, como en edit.
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Eliminado con éxito', 'El Gasto NO pudo ser eliminado.', false, false)
                            monto_anterior = $("span.monto_total").text();
                            monto_ant = parseFloat(monto_anterior);
                            nuevo_monto = monto_ant - monto;
                            $("span.monto_total").text(nuevo_monto);
                            $('tr#id_gastos-'+id_gasto_del).fadeOut("slow");
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        // location.reload();
        $(".observaciones textarea").focus();
    }
    });

    //##### EDITAR UN ITEM DE LA PLANILLA DE GASTOS #########
    $("body").on("click", ".edit_gasto", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto = id_gasto_edit = clickedID[1];
        var selector = "tr#id_gastos-" + id_gasto + " span.cuenta";
        var cuenta = $(selector).text();
        var selector = "tr#id_gastos-" + id_gasto + " span.descripcion";
        var descripcion = $(selector).text();
        var selector = "tr#id_gastos-" + id_gasto + " span.detalle";
        var detalle = $(selector).text();
        var proveedor = $("tr#id_gastos-" + id_gasto + " td span.proveedor").attr('id');
        var selector_proveedor = "select.proveedor option[value=" + proveedor + "]";
        var selector = "tr#id_gastos-" + id_gasto + " span.mes";
        var mes = $(selector).text();
        var selector = "tr#id_gastos-" + id_gasto + " span.monto";
        var monto = $(selector).text();
        var monto_num = parseFloat(monto);
        jQuery.ajax({
                type: "POST", 
                url: "/ger_planificacion_gastos.html",
                dataType: "text",
                data: {
                    id_gasto_edit: id_gasto_edit
                },
                success:function(response, status, xhr){
                    // $("body").append(response);
                    $("input.cuenta").val(cuenta);
                    $("input.descripcion").val(descripcion);
                    $("input.detalle").val(detalle);
                    $(selector_proveedor).attr('selected','selected');
                    $("input.mes").val(mes);
                    $("input.monto").val(monto);
                    $("input.agregar_gasto").focus();
                    $('tr#id_gastos-'+id_gasto).fadeOut("slow");
                    // modifico el monto total al haber eliminado el registro
                    // monto_anterior = $("span.monto_total").text();
                    // monto_ant = parseFloat(monto_anterior);
                    // nuevo_monto = monto_ant - monto_num;
                    // $("span.monto_total").text(nuevo_monto);
                    // FlashMessFull(xhr.getResponseHeader("success_query"), 'Gasto preparado para ser editado', 'El Gasto que va a editar no se pasó a inactivo. Luego eliminelo de la lista.', false, false)
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

});





