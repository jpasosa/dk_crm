<link href="/css/tra_aprob_consolidaciones.css" rel="stylesheet" type="text/css" />

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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p>Sector:<span class="azul">{$area_inicio}</span></p>
        <p>Nombre:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq clear"><p class="azul bold">PACKING LIST</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label>Cliente:</label>
                        <select title='{$tabla[0]["apellido"]}, {$tabla[0]["nombre"]}  |  {$tabla[0]["nombre_sucursal"]}' class="ultimoElement" disabled="disabled">
                            <option >
                                {$tabla[0]["apellido"]}, {$tabla[0]["nombre"]}  |  {$tabla[0]["nombre_sucursal"]}
                            </option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Contacto (persona):</label>
                        <input readonly="readonly" name="contacto" type="text" value='{$tabla[0]["contacto"]}'  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label>Teléfono:</label>
                        <input readonly="readonly" name="telefono" type="text" value='{$tabla[0]["telefono_cons"]}'  alt="Teléfono" />
                    </div>
                    <div class="campania">
                        <label>Mail:</label>
                        <input class="ultimoElement" readonly="readonly" name="mail" type="text" value='{$tabla[0]["mail_cons"]}'  alt="Mail" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>Dirección:</label>
                        <input readonly="readonly" name="direccion" type="text" value='{$tabla[0]["direccion"]}'  alt="Dirección" />
                    </div>
                    <div class="campania">
                        <label>Fecha:</label>
                        {if $tabla[0]['fecha'] == '' }
                            <input readonly="readonly" type="text" value=''  alt="Fecha" />
                        {else}
                            <input readonly="readonly" type="text" value='{$tabla[0]["fecha"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        {/if}
                    </div>
                    <div class="campania">
                        <label>Hora:</label>
                        <input readonly="readonly" class="ultimoElement" name="hora" type="text" value='{$tabla[0]["hora"]}'  alt="Hora" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label class="primerElement"> Observaciones: </label>
                    <textarea readonly="readonly" name="observaciones">{$tabla[0]['observaciones_cons']}</textarea>
                </div>
            </div>
        </form>
        <form class="box-coment" name="box_coment" action="/tra_aprob_consolidaciones_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
