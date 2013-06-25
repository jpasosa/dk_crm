<link href="/css/cpr_visitas_expo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha_inicio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script> $(function() {$( "#fecha_fin" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('input[name="costo"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="costo"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Visitas a Expo</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" action="/cpr_visitas_expo.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Exposición:</label>
                        <input name="expo" type="text" value="{$tabla[0]['exposicion']}"  alt="Exposición" />
                    </div>
                    <div class="campania">
                        <label>País / Ciudad:</label>
                        <select name="provincia">
                            {foreach item=pais from=$paises}
                                <option value="{$$pais[id_sis_provincia]}" {if $$pais['id_sis_provincia'] == $tabla[0]['id_sis_provincia'] } selected {/if}>
                                    {$$pais[pais]} | {$$pais[provincia]}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="campania">
                        <label>Costo:</label>
                        <input name="costo" type="text" value='{$tabla[0]["costo"]|number_format:2:",":""}'  alt="decimal"/>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Fecha Inicio:</label>
                        {if $tabla[0]['fecha_inicio'] == '' }
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value=''  alt="Fecha Inicio" />
                        {else}
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        {/if}
                    </div>
                    <div class="campania">
                        <label>Fecha Fin:</label>
                        {if $tabla[0]['fecha_fin'] == '' }
                            <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value=''  alt="Fecha Fin" />
                        {else}
                            <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        {/if}
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" action="/cpr_visitas_expo.html" method="post" enctype="multipart/form-data" >
            <div class="enviar_proceso">
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
            </div>
        </form>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>
