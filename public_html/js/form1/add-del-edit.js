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
                        url: 'http://sitekirke/form1.html', // TODO: resolver que no tenga que poner el vhost local
                        dataType: "text",
                        data: {
                            id_client: id_client
                        },
                        success:function(response){
                            $('tr#id_cl-'+id_client).fadeOut("slow");
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });



    //##### AGREGAR EN GASTOS DE LOS VIATICOS #########
    $("button#add_ref").click(function (e) {
            e.preventDefault();
            var detalle = $("tr td input.detalle[name='detalle']").val(); 
            var monto = $("input.monto").val(); 
            if(detalle ==='' || monto ==='' ) {
                alert("Debe ingresar detalle y monto");
                return false;
            }
            var id_reference = $("select.referencias").val();
            var form1_id = $(".form1").attr("id");
            var form1_ides = $(".form1").attr("id").split('-');
            var id_proc = form1_ides[1];
            jQuery.ajax({
                    type: "POST",
                    url: "http://sitekirke/form1.html",
                    dataType: "text",
                    data: {
                        id_reference: id_reference,
                        detalle: detalle,
                        monto: monto,
                        id_proc: id_proc
                    }, 
                    success:function(response){
                        location.reload();
                        $("input.detalle").focus();
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
            });
    });


    //##### ELIMINAR EN GASTOS DE LOS VIATICOS #########
    $("body").on("click", ".del_gasto", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto_del = clickedID[1];
        var selector = "tr#id_gast-" + id_gasto_del + " input[name='monto']";
        var monto_val = $(selector).val();
        var monto = parseFloat(monto_val);
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "http://sitekirke/form1.html",
                        dataType: "text",
                        data: {
                            id_gasto_del: id_gasto_del
                        },
                        success:function(response){
                            $('tr#id_gast-'+id_gasto_del).fadeOut("slow");
                            monto_anterior = $("span.monto").text();
                            monto_ant = parseFloat(monto_anterior);
                            nuevo_monto = monto_ant - monto;
                            $("span.monto").text(nuevo_monto);
                            $("input.detalle").val('');
                            $("input.monto").val('');
                            $("input.detalle").focus();
                            location.reload();
                            // $("html").append(response);
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
        $("#campodoble").focus(); // este focus no me está funcionando. cuando borra no debe ir arriba.
        
    });

    
    //##### EDITAR EN GASTOS DE LOS VIATICOS SOLICITADOS #########
    $("body").on("click", ".edit_gasto", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto = id_gasto_del = clickedID[1];
        var selector = "tr#id_gast-" + id_gasto + " input[name='ref']";
        var id_ref_all = $(selector).attr("id").split('-');
        var id_ref = id_ref_all[1];
        var selector = "tr#id_gast-" + id_gasto + " input[name='detalle']";
        var detalle = $(selector).val();
        var selector = "tr#id_gast-" + id_gasto + " input[name='monto']";
        var monto = $(selector).val();
        jQuery.ajax({
                type: "POST", 
                url: "http://sitekirke/form1.html",
                dataType: "text",
                data: {
                    id_gasto_del: id_gasto_del
                },
                success:function(response){
                    selector = "select.referencias option[value=" + id_ref + "]";
                    $(selector).attr('selected', 'selected');
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