<link href="/css/cpr_busqueda_fabricas_precios.css" rel="stylesheet" type="text/css" />
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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p>Sector:<span class="azul">{$area_inicio}</span></p>
        <p>Nombre:<span class="azul">{$nombre_inicio}</span></p>

        <form class="box-entrada" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Proveedor:</label>
                        <input readonly="readonly" name="proveedor" type="text" value='{$tabla[0]["proveedor"]}'  alt="Proveedor" />
                    </div>
                    <div class="campania">
                        <label>País / Ciudad:</label>
                        <select name="pais_ciudad" class="pais_ciudad" disabled=disabled>
                            <option> {$tabla[0]["pais"]} | {$tabla[0]["provincia"]}  </option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Dirección:</label>
                        <input readonly="readonly" name="direccion" type="text" value='{$tabla[0]["direccion"]}'  alt="Dirección" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement" >Contacto:</label>
                        <input readonly="readonly" name="contacto" type="text" value='{$tabla[0]["contacto"]}'  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label >Teléfono:</label>
                        <input readonly="readonly" name="telefono" type="text" value='{$tabla[0]["telefono"]}'  alt="Teléfono" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea readonly="readonly" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>

        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="100" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td width="80"align="left" bgcolor="#4685CA"><p class="blanco">Precio Unit.</p></td>
                <td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Cant. Min.</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr>
                        <td><span>{$$ts[producto]}</span></td>
                        <td> <span>{$$ts[detalle]}</span></td>
                        <td> <span>{$$ts[precio]}</span></td>
                        <td> <span>{$$ts[cantidad_min]}</span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>

        <form class="box-coment" name="box_coment" action="/cpr_busqueda_fabricas_precios_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            <div class="title"> Comentarios: </div>
            {if $all_comments['error'] != true }
                {foreach item=com from=$all_comments }
                    <div class="coment_ant">
                        <div class="fecha"> {$$com[fecha_alta]} </div>
                        <div class="area"> {$$com[area]} </div>
                        <div class="estado"> {$$com[estado]} </div>
                        <div class="comentario"> {$$com[comentario]} </div>
                    </div>
                {/foreach}
            {else}
                No existen comentarios
            {/if}
            <div class="coment_actual">
                <div class="comentario">
                    <div class="fecha"> {$date} </div>
                    <div class="area"> {$area[0]['area']} </div>
                    <label> Comentario: </label>
                    <textarea name="comentario" rows="2" redonly="true"></textarea>
                </div>
                <div class="aceptar">
                    <input name="aprobar" class="aprobar" type="submit" value="Aprobar" />
                    {if $first_process != true}
                        {if $repeat_process != true}
                            <input name="solicitar_correccion" class="solicitar_correccion" type="submit" value="Solicitar Corrección" />
                        {/if}
                    {/if}
                    {if $first_process != true }
                        <input name="desaprobar" class="desaprobar" type="submit" value="Desaprobar" />
                    {/if}
                </div>
            </div>
        </form>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>
