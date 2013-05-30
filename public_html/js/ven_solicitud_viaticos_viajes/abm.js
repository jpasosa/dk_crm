$(document).ready(function() {

    //##### AGREGAR cliente #########
    $("button#add_client").click(function (e) {
            e.preventDefault();
            var client_suc_id = $("select.client").val();  
            var abroId = $("div.form1").attr('id').split('-');
            var id_proces = abroId[1]; 
            jQuery.ajax({
                    type: "POST",
                    url: "http://sitekirke/form1.html",
                    dataType: "text",
                    data: {
                        client_suc_id: client_suc_id,
                        id_proces: id_proces
                    },
                    success:function(response){
                        // $("form").append(response);
                        location.reload(); 
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
            });
    });


    //##### ELIMINAR cliente #########
    $("body").on("click", ".del_client", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_client = clickedID[1]; 
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/ven_solicitud_viaticos_viajes.html', // TODO: resolver que no tenga que poner el vhost local
                        dataType: "text",
                        data: {
                            id_client: id_client
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('tr#id_cl-'+id_client).fadeOut("slow");    
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Gasto de viático eliminado correctamente', 'El Gasto NO pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });



    //##### ELIMINAR EN GASTOS DE LOS VIATICOS #########
    $("body").on("click", ".del_gasto", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto_del = clickedID[1];
        // var selector = "tr#id_gast-" + id_gasto_del + " span.monto";
        // var monto_texto = $(selector).text();  // monto que seleccionamos para eliminar
        // var monto_texto = monto_texto.replace(',', '.');
        // var monto = parseFloat(monto_texto);
        // var monto_total_texto = $("span.monto_total").text();  // monto total
        // var monto_total_texto = monto_total_texto.replace(',', '.');
        // var monto_total = parseFloat(monto_total_texto);
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ven_solicitud_viaticos_viajes.html",
                        dataType: "text",
                        data: {
                            id_gasto_del: id_gasto_del
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('tr#id_gast-'+id_gasto_del).fadeOut("slow");    
                                // nuevo_monto = monto_total - monto;
                                // $("span.monto_total").text(nuevo_monto);
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
        var id_gasto = id_gasto_edit = clickedID[1];
        var selector = "tr#id_gast-" + id_gasto + " span.referencia";
        var referencia = $(selector).text();
        var ref_ides = $(selector).attr("id").split('-');
        var ref_id = ref_ides[1];
        var referencia = $("tr#id_gast-" + id_gasto + " td span.referencia").attr('id');
        var selector_referencia = "select.referencia option[value=" + referencia + "]";
        var selector = "tr#id_gast-" + id_gasto + " span.detalle";
        var detalle = $(selector).text();
        var selector = "tr#id_gast-" + id_gasto + " span.monto";
        var monto = $(selector).text();
        jQuery.ajax({
                type: "POST", 
                url: "ven_solicitud_viaticos_viajes.html",
                dataType: "text",
                data: {
                    id_gasto_edit: id_gasto_edit
                },
                success:function(response){
                    $(selector_referencia).attr('selected','selected');
                    $("input.detalle").val(detalle);
                    $("input.monto").val(monto);
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