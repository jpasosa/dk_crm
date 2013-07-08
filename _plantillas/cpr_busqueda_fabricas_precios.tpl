<link href="/css/cpr_busqueda_fabricas_precios.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/cpr_busqueda_fabricas_precios/abm.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    // call setMask function on the document.ready event
    jQuery(function($) {
        $('input[name="precio"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="precio"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>

<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Búsqueda de Fábricas / Precios</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p>Sector: <span class="azul">{$area}</span></p>
        <p>Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" name="add_hotel" action="/cpr_busqueda_fabricas_precios.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Proveedor:</label>
                        <input name="proveedor" type="text" value='{$tabla[0]["proveedor"]}'  alt="Proveedor" />
                    </div>
                    <div class="campania">
                        <label>País / Ciudad:</label>
                        <select name="pais_ciudad" class="pais_ciudad">
                            {foreach item=pc from=$paises}
                                <option value="{$$pc[id_sis_provincia]}" {if $$pc['id_sis_provincia'] == $tabla[0]['id_sis_provincia'] } selected {/if}> {$$pc[pais]} | {$$pc[provincia]}  </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="campania">
                        <label>Dirección:</label>
                        <input name="direccion" type="text" value='{$tabla[0]["direccion"]}'  alt="Dirección" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement" >Contacto:</label>
                        <input name="contacto" type="text" value='{$tabla[0]["contacto"]}'  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label >Teléfono:</label>
                        <input name="telefono" type="text" value='{$tabla[0]["telefono"]}'  alt="Teléfono" />
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

        <!-- LISTADO DE LOS PRODUCTOS -->
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="100" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td width="80"align="left" bgcolor="#4685CA"><p class="blanco">Precio Unit.</p></td>
                <td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Cant. Min.</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_prod-{$$ts[id_cpr_busqueda_fabricas_precios_prod]}">
                        <td><span class="producto">{$$ts[producto]}</span></td>
                        <td><span class="detalle">{$$ts[detalle]}</span></td>
                        <td><span class="precio">{$$ts[precio]}</span></td>
                        <td><span class="cantidad_min">{$$ts[cantidad_min]}</span></td>
                        <td>
                            <a href="#">
                                <img id="id_prod-{$$ts[id_cpr_busqueda_fabricas_precios_prod]}" class="del_prod" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                            </a>
                            <a href="#">
                                <img id="id_prod-{$$ts[id_cpr_busqueda_fabricas_precios_prod]}" class="edit_prod" src="/img/iconos/edit.gif" alt="editar" border="0" />
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>

        <!-- BOX DE ENTRADA DE LOS PRODUCTOS -->
        <form class="box-entrada" name="add_hotel" action="/cpr_busqueda_fabricas_precios.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Producto:</label>
                        <input name="producto" class="producto" type="text" value=''  alt="Detalle" />
                    </div>
                    <div class="campania">
                        <label>Detalle:</label>
                        <input class="detalle ultimoElement "  name="detalle" type="text" value=''  alt="Detalle" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement" >Precio:</label>
                        <input name="precio" class="precio" type="text" value=''  alt="decimal" />
                    </div>
                    <div class="campania">
                        <label >Cantidad Mínima:</label>
                        <input class="cantidad_min ultimoElement" name="cantidad_min"  type="text" value=''  alt="Cantidad Mínima" />
                    </div>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>

        <form class="box-entrada" name="add_hotel" action="/cpr_busqueda_fabricas_precios.html" method="post" enctype="multipart/form-data" >
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
