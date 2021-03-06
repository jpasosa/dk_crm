<link href="/css/ven_solicitud_viaticos_viajes.css" rel="stylesheet" type="text/css" />

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Formulario de Ejemplo</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/form_example.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="fecha_inicio">
                    <label> Fecha Inicio: </label>
                        {if $tabla[0]['fecha_inicio'] == '' }
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value=''  alt="Fecha Inicio" />
                        {else}
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha Inicio" />
                        {/if}
                </div>
                <div class="fecha_fin">
                    <label> Fecha Fin: </label>
                    {if $tabla[0]['fecha_fin'] == '' }
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value=''  alt="Fecha fin" />
                    {else}
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha fin" />
                    {/if}
                </div>
                <div class="observaciones">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar_fechas" type="submit" value="Agregar" />
            </div>
        </form>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="350" bgcolor="#4685CA"><p class="blanco">Cliente </p></td>
                <td width="122" align="left" bgcolor="#4685CA"><p class="blanco">País</p></td>
                <td width="123" align="center" bgcolor="#4685CA"><p class="blanco">Ciudad</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[usuario]}</span></td>
                        <td><span class="pais">{$$ts[pais]}</span></td>
                        <td> <span>{$$ts[provincia]}</span></td>
                        <td align="center">
                            <a href="#" ><img id="id_cl-{$$ts[solicit_cliente]}" class="del_client" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>

        <!-- AGREGAR PROVEEDOR -->
        <form class="box-entrada" name="agregar_cliente" action="/form_example.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="proveedor">
                    <label> Proveedor: </label>
                    <select name="proveedor" class="proveedor">
                        {foreach item=pr from=$proveedores}
                            <option value="{$$pr[id_valor]}" {if $$pr['id_valor'] == $proveedor } selected {/if}> {$$pr[valor]} </option>
                        {/foreach}    
                    </select>
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_cliente" class="agregar_cliente" type="submit" value="Agregar Cliente" />
            </div>
        </form>
        
        <p>Monto: <span class="monto_total azul">{$suma_de_montos[0][MontoTot]}</span></p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="145" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                <td width="358" align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=gast from=$clientes_gastos }
                    <tr id="id_gast-{$$gast[id]}">
                        <td><span id="ref-{$$gast[id_ref]}" class="referencia">{$$gast[referencia]}</span></td>
                        <td><span class="detalle">{$$gast[detalle]}</span></td>
                        <td><span class="monto">{$$gast[monto]|number_format:2:",":""}</span></td>
                        <td align="center">
                            <a href="#"><img id="id_gast-{$$gast[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                            <a href="#"><img id="id_gast-{$$gast[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <!-- AGREGAR REFERENCIAS DE LOS DETALLES DE LOS GASTOS -->
        <form class="box-entrada" name="add_hotel" action="/form_example.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="referencia">
                    <label> Referencia: </label>
                    <select name="referencia" class="referencia">
                            {foreach item=ref from=$referencias}
                                <option value="{$$ref[id]}" {if $$ref['id'] == $referencia } selected {/if}> {$$ref[ref]} </option>
                            {/foreach}    
                    </select>
                </div>
                <div class="detalle">
                    <label> Detalle: </label>
                    <input name="detalle" class="detalle" type="text" value="{$detalle}"  />
                </div>
                <div class="monto">
                    <label> Monto: </label>
                    <input name="monto" class="monto" type="text" value="{$monto}" alt="decimal" />
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_ref" class="agregar_ref" type="submit" value="Agregar Referencia" />
            </div>
        </form>

        <form class="box-entrada" name="add_hotel" action="/form_example.html" method="post" enctype="multipart/form-data" >
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
