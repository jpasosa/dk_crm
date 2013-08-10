<link href="/css/bod_entrada_mercaderia.css" rel="stylesheet" type="text/css" />

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
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="campania">
                    <label class="primerElement">Proveedor:</label>
                    <select class="ultimoElement">
                        <option>OPTION1</option>
                        <option>OPTION1</option>
                        <option>OPTION1</option>
                        <option>OPTION1</option>
                    </select>
                </div>
                <div class="izq clear">
                    <p class="azul bold">ENTREGA    </p>
                    <div class="campania">    
                        <label class="primerElement">Fecha Llegada:</label>
                        <input readonly="yes" name="fecha_llegada" type="text" value=''  alt="Fecha Llegada" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea readonly="yes" class="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>
        <p class="izq clear azul bold">CONTROL DE PRODUCTOS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
        <tr>
            <td bgcolor="#4685CA"><p class="blanco">Referencia</p></td>
            <td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
            <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
            <td align="center" bgcolor="#4685CA"><p class="blanco">Piso</p></td>
            <td align="center" bgcolor="#4685CA"><p class="blanco">Pared</p></td>
            <td width="60" align="center" bgcolor="#4685CA"><p class="blanco">Nivel Estantería</p></td>
            <td width="60" align="center" bgcolor="#4685CA"><p class="blanco">Cuadrante</p></td>
            <td align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
        </tr>
        {if $tabla_sec['error'] == false }
            {foreach item=gast from=$clientes_gastos }
                <tr id="id_gast-{$$gast[id]}">
                    <td><span class="detalle">{$$gast[referencia]}</span></td>
                    <td><span id="ref-{$$gast[id_ref]}" class="referencia">{$$gast[producto]}</span></td>
                    <td ><span class="detalle">{$$gast[detalle]}</span></td>
                    <td align="center"><span >{$$gast[piso]}</span></td>
                    <td align="center"><span >{$$gast[pared]}</span></td>
                    <td align="center"><span >{$$gast[nvlEstanteria]}</span></td>
                    <td align="center"><span class="detalle">{$$gast[cuadrante]}</span></td>
                    <td align="center"><span class="monto">{$$gast[unidades]|number_format:2:",":""}</span></td>
                    <td align="center">
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                    </td>
                </tr>
            {/foreach}
        {/if}
        <tr id="id_gast-{$$gast[id]}">
                    <td><span id="ref-{$$gast[id_ref]}" class="referencia">215487</span></td>
                    <td ><span class="detalle">Chupetines</span></td>
                    <td ><span class="detalle">Azul</span></td>
                    <td align="center"><span class="detalle">1</span></td>
                    <td align="center"><span class="detalle">54</span></td>
                    <td align="center"><span class="detalle">52</span></td>
                    <td align="center"><span class="detalle">1</span></td>
                    <td align="center">
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                        <a href="#"><img id="id_gast-{$$gast[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                    </td>
                </tr>
        </table>
        <form class="box-coment" name="box_coment" action="/form_example_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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