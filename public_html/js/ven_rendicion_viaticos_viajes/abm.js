$(document).ready(function() {

    //##### ELIMINAR EN GASTOS DE LOS VIATICOS #########
    $("body").on("click", ".del_gasto", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto_del = clickedID[1];
        var id_tabla_proc_solicitud = $("input.id_tabla_proc_solicitud").attr('value');
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ven_rendicion_viaticos_viajes/" + id_tabla_proc_solicitud + ".html",
                        dataType: "text",
                        data: {
                            id_gasto_del: id_gasto_del
                        },
                        success:function(response, status, xhr){
                            // $("body").append(response);
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('tr#id_gast-'+id_gasto_del).fadeOut("slow");    
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Gasto de viático eliminado correctamente', 'El Gasto NO pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
        $(".detalle").focus();
        
    });

    //##### EDITAR EN GASTOS DE LOS VIATICOS SOLICITADOS #########
    $("body").on("click", ".edit_gasto", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto = id_gasto_del = clickedID[1];
        var selector = "tr#id_gast-" + id_gasto + " span.referencia";
        var referencia = $(selector).text();
        var ref_ides = $(selector).attr("id").split('-');
        var ref_id = ref_ides[1];
        var selector = "tr#id_gast-" + id_gasto + " span.detalle";
        var detalle = $(selector).text();
        var selector = "tr#id_gast-" + id_gasto + " span.monto";
        var monto = $(selector).text();
        var id_tabla_proc_solicitud = $("input.id_tabla_proc_solicitud").attr('value');
        jQuery.ajax({
                type: "POST", 
                url: "/ven_rendicion_viaticos_viajes/" + id_tabla_proc_solicitud + ".html",
                dataType: "text",
                data: {
                    id_gasto_del: id_gasto_del
                },
                success:function(response){
                    selector = "select.referencias option[value=" + ref_id + "]";
                    $(selector).attr('selected', 'selected');
                    $("input.detalle").val(detalle);
                    $("input.monto_real").val(monto);
                    $("input.detalle").focus();
                    $('tr#id_gast-'+id_gasto).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

});