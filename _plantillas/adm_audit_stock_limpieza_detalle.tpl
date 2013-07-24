<link href="/css/adm_auditorias_stock_limpieza_detalle.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Resultados de auditorias físicas Stock y limpieza, detalle</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Nombre:<span class="azul">{$nombre}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="campania">
                    <label class="primerElement">Bodega:</label>
                    <input class="ultimoElement" name="bodega" type="text" value=''  alt="Bodega" />
                </div>
                <div class="izq clear">
                    <p class="azul bold">LIMPIEZA</p>
                    <div class="campania">    
                        <label class="primerElement">Detalle:</label>
                        <select>
                            <option>Muy Bueno</option>
                            <option>Bueno</option>
                            <option>Normal</option>
                            <option>Mala</option>
                            <option>Muy Mala</option>
                        </select>
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea class="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <p class="izq clear azul bold">CONTROL DE PRODUCTOS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
        <tr>
            <td bgcolor="#4685CA"><p class="blanco">Artículo </p></td>
            <td align="left" bgcolor="#4685CA"><p class="blanco">Referencia de Artículo</p></td>
            <td width="200" align="center" bgcolor="#4685CA"><p class="blanco">Problema</p></td>
            <td width="50" align="center" bgcolor="#4685CA"><p class="blanco">Unidades por Bulto</p></td>
            <td align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            <td align="center" bgcolor="#4685CA"><p class="blanco">Foto</p></td>
        </tr>
        {if $tabla_sec['error'] == false }
            {foreach item=gast from=$clientes_gastos }
                <tr id="id_gast-{$$gast[id]}">
                    <td><span class="detalle">{$$gast[articulo]}</span></td>
                    <td><span id="ref-{$$gast[id_ref]}" class="referencia">{$$gast[referencia]}</span></td>
                    <td align="center" ><span class="detalle">{$$gast[problema]}</span></td>
                    <td align="center"><span class="monto">{$$gast[unidades]|number_format:2:",":""}</span></td>
                    <td align="center">
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                    </td>
                    <td><span id="ref-{$$gast[id_ref]}" class="referencia">[ver]</span></td>
                </tr>
            {/foreach}
        {/if}
        <tr id="id_gast-{$$gast[id]}">
                    <td><span class="detalle">ART2541</span></td>
                    <td><span id="ref-{$$gast[id_ref]}" class="referencia">Producto 1 / azul</span></td>
                    <td align="center"><span class="detalle">Faltante</span></td>
                    <td align="center"><span class="monto">2</span></td>
                    <td align="center">
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                    </td>
                    <td><span id="ref-{$$gast[id_ref]}" class="referencia">[ver]</span></td>
                </tr>
        </table>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq clear">
                    <div class="campania">    
                        <label class="primerElement">Articulo:</label>
                        <select>
                            <option>OPTION 1</option>
                            <option>OPTION 2</option>
                        </select>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">    
                        <label class="primerElement">Problemas:</label>
                        <select>
                            <option>Mercadería Rota</option>
                            <option>Faltante</option>
                            <option>Sobrante</option>
                            <option>Mercadería en mal estado de fabrica</option>
                            <option>Mercadería en mal estado</option>
                            <option>Muy Sucio</option>
                            <option>Difiere con la foto</option>
                            <option>Otros (Cargar a Mano)</option>
                        </select>
                    </div>               
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
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
