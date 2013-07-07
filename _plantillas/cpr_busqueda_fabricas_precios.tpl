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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Proveedor:</label>
                        <input name="proveedor" type="text" value=''  alt="Proveedor" />
                    </div>
                    <div class="campania">
                        <label>País / Ciudad:</label>
                        <select name="paisCiudad">
                            <option>OPTION 1</option>
                            <option>OPTION 1</option>
                            <option>OPTION 1</option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Dirección:</label>
                        <input name="direccion" type="text" value=''  alt="Dirección" />
                    </div>    
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement" >Contacto:</label>
                        <input name="contacto" type="text" value=''  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label >Teléfono:</label>
                        <input name="telefono" type="text" value=''  alt="Teléfono" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
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
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[producto]}</span></td>
                        <td> <span>{$$ts[detalle]}</span></td>
                        <td> <span>{$$ts[precio]}</span></td>
                        <td> <span>{$$ts[cantMin]}</span></td>
                        <td>
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a> 
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                    </td>
                    </tr>
                {/foreach}
            {/if}
            <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>15498524</span></td>
                        <td> <span>Chupetines</span></td>
                        <td> <span>$1.5</span></td>
                        <td> <span>100</span></td>
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
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Producto:</label>
                        <select>
                            <option>OPTION1</option>
                            <option>OPTION1</option>
                            <option>OPTION1</option>
                            <option>OPTION1</option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Detalle:</label>
                        <input class="ultimoElement" name="detalle" type="text" value=''  alt="Detalle" />
                    </div>    
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement" >Precio:</label>
                        <input name="precio" type="text" value=''  alt="Precio" />
                    </div>
                    <div class="campania">
                        <label >Cantidad Mínima:</label>
                        <input class="ultimoElement" name="cantMin" type="text" value=''  alt="Cantidad Mínima" />
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
