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
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
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
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cuenta:</label>
                        <select name="cuenta" alt="Cuenta" />
                            <option>OPTION 1</option>
                            <option>OPTION 2</option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Descripción:</label>
                        <select name="descripcion" alt="Descripción" />
                            <option>OPTION 1</option>
                            <option>OPTION 2</option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Detalle:</label>
                        <input name="detalle" type="text" value=''  alt="Detalle" />
                    </div>
                    <div class="campania">
                        <label>Proveedor:</label>
                        <select name="proveedor" alt="Proveedor" />
                            <option>OPTION 1</option>
                            <option>OPTION 2</option>
                        </select>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement" >Factura:</label>
                        <input name="factura" type="text" value=''  alt="Factura" />
                    </div>
                    <div class="campania">
                        <label>Area:</label>
                        <select name="area" alt="Area" />
                            <option>OPTION 1</option>
                            <option>OPTION 2</option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Monto:</label>
                        <input name="monto" type="text" value=''  alt="Monto" />
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
