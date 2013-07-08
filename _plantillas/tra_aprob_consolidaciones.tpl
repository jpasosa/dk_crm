<link href="/css/tra_aprob_consolidaciones.css" rel="stylesheet" type="text/css" />

<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>


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
        <h1 class="azul bold"><span class="txt22 normal">Aprobación de consolidaciones</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul"> {$date}</span></p>
        <p>Sector:<span class="azul"> {$area}</span></p>
        <p>Nombre:<span class="azul"> {$nombre_empleado}</span></p>
        <form class="box-entrada" name="add_hotel" action="/tra_aprob_consolidaciones.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cliente:</label>
                        <select name="ven_cliente_contacto" class="ultimoElement">
                            {foreach item=vcc from=$ven_cliente_contacto}
                                <option value="{$$vcc[id_ven_cliente_contacto]}" {if $$vcc['id_ven_cliente_contacto'] == $tabla[0]['id_ven_cliente_contacto'] } selected {/if}>
                                    {$$vcc[apellido]}, {$$vcc[nombre]}  |  {$$vcc[nombre_sucursal]}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="izq clear"><p class="azul bold">PACKING LIST</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label >Contacto:</label>
                        <input name="contacto" type="text" value='{$tabla[0]["contacto"]}'  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label>Teléfono:</label>
                        <input name="telefono" type="text" value='{$tabla[0]["telefono_cons"]}'  alt="Teléfono" />
                    </div>
                    <div class="campania">
                        <label>Mail:</label>
                        <input name="mail" type="text" value='{$tabla[0]["mail_cons"]}'  alt="Mail" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label >Dirección:</label>
                        <input name="direccion" type="text" value='{$tabla[0]["direccion"]}'  alt="Dirección" />
                    </div>
                    <div class="campania">
                        <label>Fecha:</label>
                        {if $tabla[0]['fecha'] == '' }
                            <input id="fecha" name="fecha" type="text" value=''  alt="Fecha" />
                        {else}
                            <input id="fecha" name="fecha" type="text" value='{$tabla[0]["fecha"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        {/if}
                    </div>
                    <div class="campania">
                        <label>Hora:</label>
                        <input class="ultimoElement" name="hora" type="text" value='{$tabla[0]["hora"]}'  alt="Hora" />
                    </div>
                </div>
                <div class="izq clear"><p class="azul bold">DONDE CONSOLIDA (se autocompleta segun cliente)</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label >Empresa:</label>
                        <input readonly="readonly" type="text" value='{$tabla[0]["empresa"]}'  alt="Empresa" />
                    </div>
                    <div class="campania">
                        <label>Contacto:</label>
                        <input readonly="readonly" type="text" value='{$tabla[0]["apellido"]}, {$tabla[0]["nombre"]}'  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label>Teléfono:</label>
                        <input readonly="readonly" type="text" value='{$tabla[0]["telefono"]}'  alt="Teléfono" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label >Mail:</label>
                        <input readonly="readonly" type="text" value='{$tabla[0]["mail_solicitante"]}'  alt="Mail" />
                    </div>
                    <div class="campania">
                        <label>Dirección:</label>
                        <input readonly="readonly" type="text" value='{$tabla[0]["direccion"]}'  alt="Dirección" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones_cons']}</textarea>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/tra_aprob_consolidaciones.html" method="post" enctype="multipart/form-data" >
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
