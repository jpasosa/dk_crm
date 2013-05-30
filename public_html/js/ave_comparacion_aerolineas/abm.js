$(document).ready(function() {

    //##### ELIMINAR EN GASTOS DE LA AEROLINEA #########
    $("body").on("click", ".del_hotel", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ave_comparacion_aerolineas.html",
                        dataType: "text",
                        data: {
                            id_gasto_del: id_gasto_del
                        },
                        success:function(response, status, xhr){
                            // alert('pepe');
                            $('tr#id_hotel-'+id_gasto_del).fadeOut("slow");
                            // borrar el que marque por acá, como en edit.
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'La aerolínea fue eliminada con éxito', 'La aerolínea NO pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
        // location.reload();
        $("input.hotel").focus();
    });

    
    //##### EDITAR EN GASTOS DE LAS AEROLINEAS #########
    $("body").on("click", ".edit_hotel", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_hotel = id_gasto_edit = clickedID[1];
        var selector = "tr#id_hotel-" + id_hotel + " td span.hotel";
        var hotel = $(selector).text();
        var selector = "tr#id_hotel-" + id_hotel + " td span.comentario";
        var comentario = $(selector).text();
        var selector = "tr#id_hotel-" + id_hotel + " td span.costo";
        var costo = $(selector).text();
        var selector = "tr#id_hotel-" + id_hotel + " td span.archivo";
        var archivo = $(selector).text();
        jQuery.ajax({
                type: "POST", 
                url: "/ave_comparacion_aerolineas.html",
                dataType: "text",
                data: {
                    id_gasto_edit: id_gasto_edit
                },
                success:function(response){
                    $("input.hotel").val(hotel);
                    $("input.comentario").val(comentario);
                    $("input.costo").val(costo);
                    $("input.nombre_archivo").val(archivo);
                    $("div.archivo label.archivo").append(' (' + archivo + ')');
                    $("input.comentario").focus();
                    $('tr#id_hotel-'+id_gasto_edit).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

    //##### ELIMINAR archivo #########
    $("body").on("click", ".del_file", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_file = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/ave_comparacion_aerolineas.html',
                        dataType: "text",
                        data: {
                            id_file: id_file
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                var selector = "td#" + id_file + " a span";
                                $(selector).fadeOut("slow");
                                var selector = "td#" + id_file + " a img";
                                $(selector).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Archivo eliminado correctamente', 'El archivo no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });

});





















