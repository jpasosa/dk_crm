<link href="/css/ven_store_check.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Formularios de Store Check</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul">NOMBRE Y APELLIDO</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="campania">
                    <label class="primerElement">Sucursal:</label>
                    <input name="sucursal" type="text" value=''  alt="Sucursal" />
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Archivo: </label>
                    <input type="file" class="inline"name="archivo" value="quepasavieja" />
                    <input type="submit" class="inline" name="archivo"value="Subir Archivo" />
                </div>
                <div class="archivos clear">
                    {foreach item=n from=$nombres_mail}
                        <div class="file marginLat10">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                            <span>Mail: Mail 1</span>
                            </a>
                            <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/foreach}
                </div>   
            </div>
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
            <tr>
                <td width="275" bgcolor="#4685CA"><p class="blanco">Informe </p></td>
                <td align="center" bgcolor="#4685CA"><p class="blanco">Excelente</p></td>
                <td align="center" bgcolor="#4685CA"><p class="blanco">Muy Bueno</p></td>
                <td align="center" bgcolor="#4685CA"><p class="blanco">Bueno</p></td>
                <td align="center" bgcolor="#4685CA"><p class="blanco">Malo</p></td>
                <td align="center" bgcolor="#4685CA"><p class="blanco">Muy Malo</p></td>
            </tr>
            <tr>
                <td align="left"><p>Se esta exhibiendo la mercadería</p></td>
                <td align="center"><input name="input1" type="radio" value="" /></td>
                <td align="center"><input name="input1" type="radio" value="" /></td>
                <td align="center"><input name="input1" type="radio" value="" /></td>
                <td align="center"><input name="input1" type="radio" value="" /></td>
                <td align="center"><input name="input1" type="radio" value="" /></td>
            </tr>
            <tr>
                <td align="left" bgcolor="#D2E1F2"><p>La mercadería esta en un lugar importante en el negocio</p></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input2" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input2" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input2" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input2" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input2" type="radio" value="" /></td>
            </tr>
            <tr>
                <td align="left" bgcolor="#D2E1F2"><p>Hay una buena cantidad de productos</p></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input3" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input3" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input3" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input3" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input3" type="radio" value="" /></td>
            </tr>
            <tr>
                <td bgcolor="#4685CA"></td>
                <td align="center" bgcolor="#4685CA"><p name="input4" class="blanco">SI</p></td>
                <td align="center" bgcolor="#4685CA"><p name="input4" class="blanco">NO</p></td>
                <td align="center" bgcolor="#4685CA"></td>
                <td align="center" bgcolor="#4685CA"></td>
                <td align="center" bgcolor="#4685CA"></td>
            </tr>
            <tr>
                <td align="left" bgcolor="#D2E1F2"><p>Se puede poner un punto de venta</p></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input5" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input5" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"></td>
                <td align="center" bgcolor="#D2E1F2"></td>
                <td align="center" bgcolor="#D2E1F2"></td>
            </tr>
            <tr >
                <td align="left" bgcolor="#D2E1F2"><p>Se puede poner un banner</p></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input6" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"><input name="input6" type="radio" value="" /></td>
                <td align="center" bgcolor="#D2E1F2"></td>
                <td align="center" bgcolor="#D2E1F2"></td>
                <td align="center" bgcolor="#D2E1F2"></td>
            </tr>
        </table>
        <div class="box-entrada">
            <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
            <input name="id_tabla" type="hidden" value="{$id_tabla}" />
            <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
        </div>
        </form>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario marginTop20">
            <tr>
                <td width="145" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                <td width="358" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Precio</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=gast from=$clientes_gastos }
                    <tr id="id_gast-{$$gast[id]}">
                        <td><span id="ref-{$$gast[id_ref]}" class="referencia">{$$gast[referencia]}</span></td>
                        <td><span class="detalle">{$$gast[producto]}</span></td>
                        <td><span class="monto">{$$gast[precio]|number_format:2:",":""}</span></td>
                        <td align="center">
                            <a href="#"><img id="id_gast-{$$gast[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                            <a href="#"><img id="id_gast-{$$gast[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Referencia:</label>
                        <select name="referencia" value=''  alt="Referencia">
                            <option>OPTION1</option>
                            <option>OPTION1</option>
                        </select>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Producto:</label>
                        <select name="producto" value=''  alt="Producto">
                            <option>OPTION1</option>
                            <option>OPTION1</option>
                        </select>
                    </div>
                </div>
                <div class="inputChico">
                    <label >Precio:</label>
                    <input name="precio" type="text" value=''  alt="Precio" />
                </div>
                <div class="inputChico">
                    <label >Cantidad:</label>
                    <input name="cantidad" type="text" value=''  alt="Cantidad" />
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
