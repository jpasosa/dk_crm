<link href="/css/tra_packing_list.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Packing List</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Proveedor:</label>
                        <select class="ultimoElement" name="pais">
                            <option>OPTION 1</option>
                            <option>OPTION 1</option>
                            <option>OPTION 1</option>
                        </select>
                    </div>
                </div>
                <div class="izq clear"><p class="azul bold">ENTREGA</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label class="primerElement" >Fecha Envío:</label>
                        <input name="cantidad_dias" type="text" value=''  alt="Cantidad Días" />
                    </div>
                </div><div class="der">
                    <div class="campania">
                        <label class="primerElement">Fecha Llegada:</label>
                        <input name="fecha_fin" type="text" value=''  alt="Fecha Fin" />
                    </div>
                </div>
                <div class="observacionesChico">
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
                <td align="left" bgcolor="#4685CA"><p class="blanco">Referencia</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Nro. Caja</p></td>
                <td width="40" align="left" bgcolor="#4685CA"><p class="blanco">x caja</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Volumen</p></td>
                <td width="40" align="left" bgcolor="#4685CA"><p class="blanco">Peso Kg.</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[referencia]}</span></td>
                        <td> <span>{$$ts[producto]}</span></td>
                        <td> <span>{$$ts[detalle]}</span></td>
                        <td> <span>{$$ts[nro]}</span></td>
                        <td> <span>{$$ts[cantCaja]}</span></td>
                        <td> <span>{$$ts[volumen]}</span></td>
                        <td> <span>{$$ts[peso]}</span></td>
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
        </table>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania">
                            <label class="primerElement"> Referencia: </label>
                            <input name="referencia" type="text" value="{$referencia}"  />
                        </div>
                        <div class="campania">
                            <label> Producto: </label>
                            <input name="producto" type="text" value="{$producto}"  />
                        </div>
                        <div class="campania">
                            <label> Detalle:  </label>
                            <input name="detalle" type="text" value="{$detalle}"  />
                        </div>
                        <div class="campania">
                            <label> Nro. Caja: </label>
                            <input name="nro" type="text" value="{$nro}"  />
                        </div>
                        <div class="campania">
                            <label> x caja: </label>
                            <input class="ultimoElement" name="cantCaja" type="text" value="{$cantCaja}" />
                        </div>
                    </div>
                    <div class="der">
                        <div class="campania">
                            <label class="primerElement">Alto: </label>
                            <input name="alto" type="text" value="{$alto}"  />
                        </div>
                        <div class="campania">
                            <label>Ancho: </label>
                            <input name="ancho" type="text" value="{$ancho}"  />
                        </div>
                        <div class="campania">
                            <label> Fondo: </label>
                            <input name="fondo" type="text" value="{$fondo}"  />
                        </div>
                        <div class="campania">
                            <label> Peso Kg.: </label>
                            <input name="peso" type="text" value="{$peso}"  />
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
