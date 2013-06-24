<link href="/css/ger_planificacion_gastos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ger_planificacion_gastos/abm-search.js"></script>
<script type="text/javascript" src="js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    // call setMask function on the document.ready event
    jQuery(function($) {
        $('input[name="monto"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="monto"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>



<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
        <div class="flash_error"></div>
        <div class="flash_notice"></div>
        {if $flash_error != '' }
            <div class="disp_error"> {$flash_error} </div> <!-- estos vienen del controlador -->
        {/if}
        {if $flash_notice != '' }
            <div class="disp_notice"> {$flash_notice} </div> <!-- estos vienen del controlador -->
        {/if}
        {template tpl="menu_izq"}
        <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
            <hr />
            <h1 class="azul bold"><span class="txt22 normal">GERENCIA</span> | Planificación de Gastos</h1>
            <hr />
            <p class="txt10 uppercase">Fecha de inicio del trámite: <span class="azul">{$date}</span></p>
            <hr />

            <form class="box-entrada" name="add_observaciones" action="/ger_planificacion_gastos.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                    <div class="observaciones">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" rows="2">{$observaciones[0][observaciones]}</textarea>
                    </div>
                    <input name="first_time" type="hidden" value="{$first_time}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="agregar" class="agregar_observaciones" type="submit" value="Agregar" />
                </div>
            </form>
            <hr />
            <p class="azul txt18" style="margin:0px 0 10px 0;">Planilla de Gastos:</p>
            <p>
                Monto: <span class="monto_total azul">{$montos[monto_total]}</span>
            </p>
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
                <tr>
                    <td  width="100" bgcolor="#4685CA"><p class="blanco">Cuenta </p></td>
                    <td  width="100" align="left" bgcolor="#4685CA"><p class="blanco">Descripción</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Proveedor</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Mes</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                    <td  width="42"  bgcolor="#4685CA"><p class="blanco">Acción</p></td>
                </tr>

                <!-- traigo de la base de datos, los gastos cargados, si ex que existen -->
                {if $gast_detalles['error'] == false }
                    {foreach item=gd from=$gast_detalles }
                    <tr id="id_gastos-{$$gd[id_ger_planificacion_gastos_detalle]}">
                        <td> <span class="cuenta">{$$gd[cuenta]}</span> </td>
                        <td> <span class="descripcion">{$$gd[descripcion]}</span> </td>
                        <td> <span class="detalle">{$$gd[detalle]}</span> </td>
                        <td> <span class="proveedor" id="{$$gd[id_cpr_proveedores]}" >{$$gd[nombre]}</span> </td>
                        <td> <span class="mes">{$$gd[mes]}</span> </td>
                        <td> <span class="monto">{$$gd[monto]|number_format:2:",":""}</span> </td>
                        <td>
                            <a href="#">
                                <img id="id_gastos-{$$gd[id_ger_planificacion_gastos_detalle]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                            </a>
                            <a href="#">
                                <img id="id_gastos-{$$gd[id_ger_planificacion_gastos_detalle]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" />
                            </a>
                        </td>
                    </tr>
                    {/foreach}
                {/if}
            </table>
            <form class="box-entrada" name="add_hotel" action="/ger_planificacion_gastos.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="cuenta">
                            <label> Cuenta: </label>
                            <input name="cuenta" class="cuenta" type="text" value="{$cuenta}"  />
                        </div>
                        <div class="detalle">
                            <label> Detalle: </label>
                            <input name="detalle" class="detalle" type="text" value="{$detalle}" />
                        </div>
                        <div class="mes">
                            <label> Mes: </label>
                            <input name="mes" class="mes" type="text" value="{$mes}" />
                        </div>
                        <div class="monto">
                            <label> Monto: </label>
                            <input name="monto" id="decimal" class="monto" type="text" value="{$monto}" alt="decimal" />
                        </div>
                    </div>
                    <div class="der">
                        <div class="descripcion">
                            <label> Descripción: </label>
                            <input name="descripcion" class="descripcion" type="text" value="{$descripcion}" />
                        </div>
                        <div class="proveedor">
                            <label> Proveedor: </label>
                            <select name="proveedor" class="proveedor">
                                    {foreach item=pr from=$proveedores}
                                        <option value="{$$pr[id_valor]}" {if $$pr['id_valor'] == $proveedor } selected {/if}> {$$pr[valor]} </option>
                                    {/foreach}
                            </select>
                        </div>
                        <input name="first_time" type="hidden" value="{$first_time}" />
                        <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                        <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                        <input name="agregar_gasto" class="agregar_gasto" type="submit" value="Agregar" />
                    </div>
                </div>
            </form>
            <form class="box-entrada" name="add_hotel" action="/ger_planificacion_gastos.html" method="post" enctype="multipart/form-data" >
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

