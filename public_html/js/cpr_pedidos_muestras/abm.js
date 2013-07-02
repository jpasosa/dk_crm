$(document).ready(function() {

    //##### ELIMINAR prducto #########
    $("body").on("click", ".del_prod", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_prod = id_prod_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/cpr_pedidos_muestras.html',
                        dataType: "text",
                        data: {
                            id_prod_del: id_prod_del
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('tr#id_prod-' + id_prod).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Producto eliminado correctamente', 'El producto no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });



    //##### EDITAR producto  #########
    $("body").on("click", ".edit_prod", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_prod = id_prod_edit = clickedID[1];
        var selector = "tr#id_prod-" + id_prod + " td span.referencia_de_producto";
        var referencia_de_producto = $(selector).text();
        var selector = "tr#id_prod-" + id_prod + " td span.cantidad";
        var cantidad = $(selector).text();
        jQuery.ajax({
                type: "POST",
                url: "/cpr_pedidos_muestras.html",
                dataType: "text",
                data: {
                    id_prod_edit: id_prod_edit
                },
                success:function(response){
                    $("input.referencia_de_producto").val(referencia_de_producto);
                    $("input.cantidad").val(cantidad);
                    $("input.referencia_de_producto").focus();
                    $('tr#id_prod-'+id_prod).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});