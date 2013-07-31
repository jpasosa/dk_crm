$(document).ready(function() {

	//##### ELIMINAR producto #########
	$("body").on("click", ".del_prod", function(e) {
		e.returnValue = false;
		var clickedID = this.id.split('-'); //separa por -
		var id_prod = id_prod_del = clickedID[1];
		if (confirm('Seguro de eliminarlo?')) {
			jQuery.ajax({
				type: "POST",
				url: '/tra_packing_list.html',
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



	//##### EDITAR PRODUCTO  #########
	$("body").on("click", ".edit_prod", function(e) {
		e.returnValue = false;
		var clickedID = this.id.split('-');
		var id_prod = id_prod_edit = clickedID[1];
		var selector 	= "tr#id_prod-" + id_prod + " td span.nro_caja_tpl";
		var nro_caja 	= $(selector).text();
		var selector 	= "tr#id_prod-" + id_prod + " td span.productos_por_caja_tpl";
		var productos_por_caja = $(selector).text();
		var selector 	= "tr#id_prod-" + id_prod + " td span.peso_tpl";
		var peso 		= $(selector).text();
		var alto 		= $('input[name="alto_tpl"]').val();
		var ancho 		= $('input[name="ancho_tpl"]').val();
		var fondo 		= $('input[name="fondo_tpl"]').val();
		var producto = $("tr#id_prod-" + id_prod + " td span.referencia").attr('id');
		var selector_producto = "select.referencia option[value=" + producto + "]";
		jQuery.ajax({
			type: "POST",
			url: "/tra_packing_list.html",
			dataType: "text",
			data: {
				id_prod_edit: id_prod_edit
			},
			success:function(response){
				$("input.nro_caja").val(nro_caja);
				$("input.productos_por_caja").val(productos_por_caja);
				$("input.alto").val(alto);
				$("input.ancho").val(ancho);
				$("input.fondo").val(fondo);
				$("input.peso").val(peso);
				$(selector_producto).attr('selected','selected');
				$("input.nro_caja").focus();
				$('tr#id_prod-' + id_prod).fadeOut("slow");
				// $(".registros").append(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	});

});