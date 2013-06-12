<link href="css/logueo.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="ger_planificacion_gastos" id="proc-{$id_proces}"> <!-- lo uso para ver el id del proceso -->
        <div class="flash_error"></div> <!-- estos van a saltar por AJAX -->
        <div class="flash_notice"></div>
        {if $flash_error != '' }
            <div class="disp_error"> {$flash_error} </div> <!-- estos vienen del controlador -->                    
        {/if}
        {if $flash_notice != '' }
            <div class="disp_notice"> {$flash_notice} </div> <!-- estos vienen del controlador -->                    
        {/if}
        {template tpl="menu_izq_vacio"}
        <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <hr />
            <h1 class="azul bold"><span class="txt22 normal">ERROR: SE PRODUJO ALGÚN TIPO DE ERROR DESCONOCIDO.</span></h1>

            <hr />
        </div>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>

