<link href="/css/adm_ytd_gastos_costos.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">YTD Gastos / Costos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul">NOMBRE Y APELLIDO</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="observacionesChico">
                    <label class="primerElement"> Observaciones: </label>
                    <textarea class="ultimoElement" readonly="yes" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>    
        <p class="azul bold">MONTO TOTAL : <span>$1587</span></p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Cuenta</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Descripción</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Proveedor</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Factura</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Area</p></td>
                <td width="45" align="left" bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                <td width="45" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[cuenta]}</span></td>
                        <td> <span>{$$ts[descripcion]}</span></td>
                        <td> <span>{$$ts[detalle]}</span></td>
                        <td> <span>{$$ts[proveedor]}</span></td>
                        <td> <span>{$$ts[factura]}</span></td>
                        <td> <span>{$$ts[area]}</span></td>
                        <td> <span>{$$ts[monto]}</span></td>
                        <td>
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a> 
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                        </td>
                        <td> <span><a>[VER]</a></span></td>
                    </tr>
                {/foreach}
            {/if}
            <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>25441</span></td>
                        <td> <span>Campaña</span></td>
                        <td> <span>Hotel Panama</span></td>
                        <td> <span>Papeleria H1</span></td>
                        <td> <span>6584</span></td>
                        <td> <span>Diseño</span></td>
                        <td> <span>1234</span></td>
                        <td>
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a> 
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
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
