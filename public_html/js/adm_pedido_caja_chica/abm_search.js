$(document).ready(function() {

    //##### ELIMINAR archivo #########
    $("body").on("click", ".del_file", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_file = clickedID[1]; 
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/adm_pedido_caja_chica.html', // TODO: resolver que no tenga que poner el vhost local
                        dataType: "text",
                        data: {
                            id_file: id_file
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('a#file-'+id_file).fadeOut("slow");
                                $('a#file_name-'+id_file).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Archivo eliminado correctamente', 'El archivo no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });

    //##### SEARCH CUENTA -> IMPRIME DESCRIPCION #########
        $("input.cuenta").blur(function(search){
            search.returnValue = false;
            search.preventDefault();
            var cuenta = $("input.cuenta").val();
            if(cuenta != '') {
                jQuery.ajax({
                        type: "POST",
                        url: "/adm_pedido_caja_chica.html",
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
                        url: "/adm_pedido_caja_chica.html",
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

    //##### ELIMINAR EN GASTOS  #########
    $("body").on("click", ".del_gasto", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/adm_pedido_caja_chica.html",
                        dataType: "text",
                        data: {
                            id_gasto_del: id_gasto_del
                        },
                        success:function(response, status, xhr){
                            $('tr#id_gastos-'+id_gasto_del).fadeOut("slow");
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'El Gasto fue eliminado con éxito', 'El Gasto NO pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
        // location.reload();
        $("input.hotel").focus();
    });

    
    //##### EDITAR EN GASTOS  #########
    $("body").on("click", ".edit_gasto", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto = id_gasto_edit = clickedID[1];
        var selector = "tr#id_gastos-" + id_gasto + " td span.cuenta";
        var cuenta = $(selector).text();
        var selector = "tr#id_gastos-" + id_gasto + " td span.descripcion";
        var descripcion = $(selector).text();
        var selector = "tr#id_gastos-" + id_gasto + " td span.detalle";
        var detalle = $(selector).text();
        var proveedor = $("tr#id_gastos-" + id_gasto + " td span.proveedor").attr('id');
        var selector = "tr#id_gastos-" + id_gasto + " td span.factura";
        var factura = $(selector).text();
        var area = $("tr#id_gastos-" + id_gasto + " td span.area").attr('id');
        var selector = "tr#id_gastos-" + id_gasto + " td span.monto";
        var monto = $(selector).text();
        var selector_area = "select.area option[value=" + area + "]";
        var selector_proveedor = "select.proveedor option[value=" + proveedor + "]";
        jQuery.ajax({
                type: "POST", 
                url: "/adm_pedido_caja_chica.html",
                dataType: "text",
                data: {
                    id_gasto_edit: id_gasto_edit,
                    area: area,
                    proveedor: proveedor
                },
                success:function(response){
                    $("input.cuenta").val(cuenta);
                    $("input.descripcion").val(descripcion);
                    $("input.detalle").val(detalle);
                    $("input.factura").val(factura);
                    $("input.monto").val(monto);
                    $(selector_area).attr('selected','selected');
                    $(selector_proveedor).attr('selected','selected');
                    $("input.cuenta").focus();
                    $('tr#id_gastos-'+id_gasto_edit).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});