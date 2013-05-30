/**
 * Se utiliza como sistema de template, que muestre las acciones de los botones.
 *
 * @category   Funciones_Sitios_Institucionales
 * @package    Sitios_Institucionales
 * @copyright  2010 KIRKE
 * @license    GPL
 * @version    Release: 1.0
 * @link       http://kirke.ws
 * @since      Function available since Release 1.0
 * @deprecated
 */

function nav_botones(seccion) {

	var nav_divs = $(".nav_boton");

	$(".nav_boton").parent("ul").css("list-style", "none");
	$(".nav_boton").parent("ul").css("margin", 0);
	$(".nav_boton").parent("ul").css("padding", 0);	

	nav_divs.each( function() {

		if( $(this).parent("ul").attr("orientacion") == 'h' ){
			$(this).css("float", "left");
		}

		if( $(this).parent("ul").attr("fondo") == '' ){
			var ruta_imagen = "_imagenes/nav_"+urlParametrosObtener($(this).children("a").attr("href"))["kk_seccion"]+".gif";
			var this_boton = $(this);
			armarBotones(ruta_imagen,this_boton);
		}else{
			if( urlParametrosObtener($(this).children("a").attr("href"))["kk_seccion"] != seccion ){
				$(this).addClass($(this).parent("ul").attr("fondo"));
			}else{
				$(this).addClass($(this).parent("ul").attr("fondo")+'_act');
			}
		}

		if( $(this).parent("ul").attr("texto") != '' ){
			if( urlParametrosObtener($(this).children("a").attr("href"))["kk_seccion"] != seccion ){
				$(this).children("a").addClass($(this).parent("ul").attr("texto"));
			}else{
				$(this).children("a").addClass($(this).parent("ul").attr("texto")+'_act');
			}
		}

	});

	$(".nav_boton").mouseover(function() {
		if( $(this).parent("ul").attr("fondo") == '' ){
			if( urlParametrosObtener($(this).children("a").attr("href"))["kk_seccion"] != seccion ){
				$(this).css("background-position", "0px -"+$(this).height()+"px");
			}
		}else{
			$(this).removeClass($(this).parent("ul").attr("fondo"));
			$(this).addClass($(this).parent("ul").attr("fondo")+'_over');
		}
	});

	$(".nav_boton").mouseout(function() {
		if( $(this).parent("ul").attr("fondo") == '' ){
			if( urlParametrosObtener($(this).children("a").attr("href"))["kk_seccion"] != seccion ){
				$(this).css("background-position", "0px 0px");
			}
		}else{
			$(this).removeClass($(this).parent("ul").attr("clase")+'_over');
			$(this).addClass($(this).parent("ul").attr("clase"));
		}
	});

	function armarBotones(ruta_imagen,this_boton){

		$(new Image()).load(function() {
			
			var alto = this.height;
			var ancho = this.width;

			$(this_boton).css("background-image", "url("+ruta_imagen+")");
			$(this_boton).css("height", (alto/3)+"px"); 
			$(this_boton).css("width", ancho+"px"); 
			$(this_boton).css("background-repeat", "no-repeat");
			$(this_boton).css("background-position", "0px 0px");
			$(this_boton).css("cursor", "pointer");
			$(this_boton).css("list-style", "none");
			$(this_boton).css("margin", 0);
			$(this_boton).css("padding", 0);
			
			if( urlParametrosObtener($(this_boton).children("a").attr("href"))["kk_seccion"] == seccion ){
				$(this_boton).css("background-position", "0px -"+((alto/3)*2)+"px");
				$(this_boton).css("cursor", "");
			}

			if( $(this_boton).parent("ul").attr("texto") == '' ){
				$(this_boton).children("a").html('<div></div>');
			}else{
				$(this_boton).children("a").html('<div>'+$(this_boton).children("a").text()+'</div>');
			}

			$(this_boton).children("a").children("div").css("height", (alto/3)+"px");
			$(this_boton).children("a").children("div").css("width", ancho+"px");

		}).attr('src',ruta_imagen);

	}
	
	function urlParametrosObtener(url){
		
		var vars = [], hash;
		var hashes = url.slice(url.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++){
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	}

}
