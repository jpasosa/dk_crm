/**
 * Se utiliza como sistema de template, que muestre las acciones de los botones.
 *
 * @category   Funciones_Sitios_Institucionales
 * @package    Sitios_Institucionales
 * @copyright  2010 KIRKE
 * @license    GPL
 * @version    Release: 2.0
 * @link       http://kirke.ws
 * @since      Function available since Release 1.0
 * @deprecated
 */

function no_nulo(campo_nombre,cadena){
    if( $("#"+campo_nombre).val().length > 0 ){
        $("#VC_"+campo_nombre).hide('slow');
        $("#VC_"+campo_nombre).html('');
        return true;
    }else{
        $("#VC_"+campo_nombre).html(cadena);
        $("#VC_"+campo_nombre).show('slow');
        return false;
    }
    return false;
}

function es_mail(campo_nombre,cadena){
	if( $("#"+campo_nombre).val() != '' ){
		if( $("#"+campo_nombre).val().match(/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/) ){
			$("#VC_"+campo_nombre).hide('slow');
			$("#VC_"+campo_nombre).html('');
			return true;
		}else{
			$("#VC_"+campo_nombre).html(cadena);
			$("#VC_"+campo_nombre).show('slow');
			return false;
		}
	}
}

function control_captcha(campo_nombre,cadena,cadena2,cadena3){
     var respuesta = null;
     var scriptUrl = 'index.php?kk_captcha=captcha&codigo='+$("#"+campo_nombre).val();
     $.ajax({
        url: scriptUrl,
        type: 'get',
        dataType: 'html',
        async: false,
        success: function(datos) {
            respuesta = datos;
        } 
     });
	if( respuesta == 'ok' ){ 
        $("#VC_"+campo_nombre).hide('slow');
        $("#VC_"+campo_nombre).html('');
		return true;
	}else if(respuesta == '10'){
		$("#VC_"+campo_nombre).html(cadena2);
		$("#VC_"+campo_nombre).show('slow');
		return false;
	}else if( $("#"+campo_nombre).val() != '' ){
		$("#VC_"+campo_nombre).html(cadena);
		$("#VC_"+campo_nombre).show('slow');
		return false;
	}else{
		$("#VC_"+campo_nombre).html(cadena3);
		$("#VC_"+campo_nombre).show('slow');
		return false;
	}
}

function solo_texto_permitido(campo_nombre,cadena){

    $("#"+campo_nombre).keypress(function(e) {

		/*
		obtener el objeto de evento: o bien window.event para IE
		o el parámetro e para otros navegadores
		*/
		var evt = window.event ? window.event : e;
		/*
		obtener el valor numérico de la tecla pulsada:
		event.keyCode para IE. o e.which para otros navegadores
		*/
		var keyCode = evt.keyCode ? evt.keyCode : e.which;

		if (
			(navigator.appVersion.indexOf("MSIE") == -1)
			&& (
				e.keyCode == 8  // backspace
			||  e.keyCode == 9  // tab
			||  e.keyCode == 13 // enter
			||  e.keyCode == 16 // shift
			||  e.keyCode == 17 // ctrl
			||  e.keyCode == 18 // alt
			||  e.keyCode == 20 // caps lock 
			||  e.keyCode == 27 // escape 
			||  e.keyCode == 33 // page up  
			||  e.keyCode == 34 // page down  
			||	e.keyCode == 35 // end
			||  e.keyCode == 36 // home
			||  e.keyCode == 37 // left arrow
			||  e.keyCode == 38 // up arrow 
			||  e.keyCode == 39 // right arrow
			||  e.keyCode == 40 // down arrow 
			||  e.keyCode == 45 // insert
			||	e.keyCode == 46 // delete
			)
		) {
		        // no realizar nada es para poder borrar: backspace y delete
				return true;
        }else{
            if( cadena.indexOf(String.fromCharCode(keyCode)) == -1 ){
                e.preventDefault();
            }
        }
    });
}

function control_de_valores(campo_nombre){
    // async hace que primero lea el archivo y después siga con el resto.
    var control = $.ajax({
        type: "GET",
        url: "control.php?prefijo=1&valor="+$("#"+campo_nombre).val(),
        async: false
    }).responseText;
    if( control == ''){
        alert('OK');
    }
}
