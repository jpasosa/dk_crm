<link href="_css/estilos.css" rel="stylesheet" type="text/css">


<link href="/css/ger_mantenimiento.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ger_mantenimiento/del_file.js"></script>
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha_inicio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>

<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq_vacio"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto">
    	<p class="texto_rojo_negrita">Error: Se produjo algún tipo de error desconocido. . . </p>
    </td>
  </tr>
</table>

    </div>


