<link href="/css/ven_cliente.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Alta de Clientes</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania">
                            <label> Empresa: </label>
                            <input name="empresa" type="text" value="{$empresa}"  />
                        </div>
                        <div class="campania">
                            <label> Sitio Web: </label>
                            <input name="sitioWeb" type="text" value="{$sitioWeb}"  />
                        </div>
                        <div class="campania">
                            <label> CUIT: </label>
                            <input name="cuit" type="text" value="{$cuit}"  />
                        </div>
                    </div>
                    <div class="der">
                        <div class="campania">
                            <label> Teléfono: </label>
                            <input name="telefono" type="text" value="{$telefono}"  />
                        </div>
                        <div class="campania">
                            <label> Mail solicitante: </label>
                            <input name="mail" type="text" value="{$mail}"  />
                        </div>
                        <div class="campania">
                            <label> País / Ciudad: </label>
                            <select name="pais">
                                <option>OPTION 1</option>
                                <option>OPTION 1</option>
                                <option>OPTION 1</option>
                            </select>
                        </div>
                    </div>
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                    <input type="submit" id="agregar" value="Agregar"/>
                </div>    
        </form>
        <p>Sucursales</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="188" bgcolor="#4685CA"><p class="blanco">Nombre </p></td>
                <td width="310" align="left" bgcolor="#4685CA"><p class="blanco">Dirección</p></td>
                <td width="149" align="left" bgcolor="#4685CA"><p class="blanco">Teléfono</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[nombre]}</span></td>
                        <td><span>{$$ts[direccion]}</span></td>
                        <td> <span>{$$ts[telefono]}</span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania">
                            <label> Nombre: </label>
                            <input name="nomre" type="text" value="{$nombre}"  />
                        </div>
                        <div class="campania">
                            <label> Teléfono: </label>
                            <input name="telefono" type="text" value="{$telefono}"  />
                        </div>
                    </div>
                    <div class="der">
                        <div class="campania">
                            <label> Dirección: </label>
                            <input name="direccion" type="text" value="{$direccion}"  />
                        </div>
                    </div>
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                    <input type="submit" id="agregar" value="Agregar"/>
                </div>    
        </form>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Apellido</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sucursal</p></td>
                <td width="120" align="left" bgcolor="#4685CA"><p class="blanco">Mail</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sector</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Puesto</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[apellido]}</span></td>
                        <td> <span>{$$ts[sucursal]}</span></td>
                        <td> <span>{$$ts[mail]}</span></td>
                        <td> <span>{$$ts[sector]}</span></td>
                        <td> <span>{$$ts[puesto]}</span></td>
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
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania">
                            <label> Nombre: </label>
                            <input name="nomre" type="text" value="{$nombre}"  />
                        </div>
                        <div class="campania">
                            <label> Apellido: </label>
                            <input name="telefono" type="text" value="{$telefono}"  />
                        </div>
                        <div class="campania">
                            <label> Sucursal:  </label>
                            <select name="pais">
                                <option>OPTION 1</option>
                                <option>OPTION 1</option>
                                <option>OPTION 1</option>
                            </select>
                        </div>
                        <div class="campania">
                            <label> Mail: </label>
                            <input name="nomre" type="text" value="{$nombre}"  />
                        </div>
                    </div>
                    <div class="der">
                        <div class="campania">
                            <label> Teléfono: </label>
                            <input name="direccion" type="text" value="{$direccion}"  />
                        </div>
                        <div class="campania">
                            <label> Celular: </label>
                            <input name="nomre" type="text" value="{$nombre}"  />
                        </div>
                        <div class="campania">
                            <label> Nombre: </label>
                            <input name="nomre" type="text" value="{$nombre}"  />
                        </div>
                        <div class="campania">
                            <label> Nombre: </label>
                            <input name="nomre" type="text" value="{$nombre}"  />
                        </div>

                    </div>
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                    <input type="submit" id="agregar" value="Agregar"/>
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
