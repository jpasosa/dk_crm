$(document).ready(function() {


     //##### SEARCH PRODUCTO -> TRAE REFERENCIA Y PRECIO #########
        $("select.producto").blur(function(search){
            search.returnValue = false;
            search.preventDefault();
            var producto = $("select.producto").val();
            var selector_referencia = "select.referencia option[value=" + producto + "]";
            if(producto != '') {
                jQuery.ajax({
                        type: "POST",
                        url: "/ven_orden_pedidos.html",
                        dataType: "text",
                        data: {
                            producto: producto,
                        }, 
                        success:function(response, status, xhr){
                            precio = xhr.getResponseHeader("precio")
                            if(precio == null) {
                                $("input.precio").val(0);
                            }else{
                                $("input.precio").val(precio);    
                            }
                            $(selector_referencia).attr('selected','selected');
                            // $("html").append(response);
                            // var max = parseFloat(precio) * 1.05;
                            // var min = parseFloat(precio) * 0.95;
                            // $("input.min").val(min.toString());    
                            // $("input.max").val(max.toString());    
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
            }
    });

    //##### SEARCH REFERENCIA -> TRAE PRODUCTO Y PRECIO #########
        $("select.referencia").blur(function(search){
            search.returnValue = false;
            search.preventDefault();
            var referencia = $("select.referencia").val();
            var selector_producto = "select.producto option[value=" + referencia + "]";
            if(referencia != '') {
                jQuery.ajax({
                        type: "POST",
                        url: "/ven_orden_pedidos.html",
                        dataType: "text",
                        data: {
                            referencia: referencia,
                        }, 
                        success:function(response, status, xhr){
                            precio = xhr.getResponseHeader("precio")
                            if(precio == null) {
                                $("input.precio").val(0);
                            }else{
                                $("input.precio").val(precio);    
                            }
                            $(selector_producto).attr('selected','selected');
                            // $("html").append(response);
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
            }
    });

    //##### ELIMINAR PRODUCTOS #########
    $("body").on("click", ".del_prod", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_prod = id_prod_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ven_store_check.html",
                        dataType: "text",
                        data: {
                            id_prod_del: id_prod_del
                        },
                        success:function(response, status, xhr){
                            // borrar el que marque por acá, como en edit.
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Eliminado con éxito', 'El Producto NO pudo ser eliminado.', false, false)
                            $('tr#id_prod-' + id_prod_del).fadeOut("slow");
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        // location.reload();
        // $(".observaciones textarea").focus();
    }
    });

    //##### EDITAR item tabla secundaria #########
    $("body").on("click", ".edit_prod", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_prod = id_prod_edit = clickedID[1];
        var selector = "tr#id_prod-" + id_prod + " span.cantidad";
        var cantidad = $(selector).text();
        var selector = "tr#id_prod-" + id_prod + " span.precio";
        var precio = $(selector).text();
        var selector = "tr#id_prod-" + id_prod + " span.cantidad";
        var cantidad = $(selector).text();
        var referencia = $("tr#id_prod-" + id_prod + " td span.referencia").attr('id');
        var selector_referencia = "select.referencia option[value=" + referencia + "]";
        var selector_producto = "select.producto option[value=" + referencia + "]";
        jQuery.ajax({
                type: "POST", 
                url: "/ven_store_check.html",
                dataType: "text",
                data: {
                    id_prod_edit: id_prod_edit
                },
                success:function(response, status, xhr){
                    // $("body").append(response);
                    $("input.cantidad").val(cantidad);
                    $("input.precio").val(precio);
                    $(selector_referencia).attr('selected','selected');
                    $(selector_producto).attr('selected','selected');
                    $("input.cantidad").focus();
                    $('tr#id_prod-' + id_prod).fadeOut("slow");
                    // FlashMessFull(xhr.getResponseHeader("success_query"), 'Gasto preparado para ser editado', 'El Gasto que va a editar no se pasó a inactivo. Luego eliminelo de la lista.', false, false)
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

});





