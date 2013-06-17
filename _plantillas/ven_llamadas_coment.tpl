<link href="/css/ven_llamadas.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Formulario de Llamadas</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ger_planificacion_gastos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label> Campaña: </label>
                        <input readonly="yes" name="campania" type="text" value="{$campaña}"  />
                    </div>
                    <div class="vendedor">
                        <label> Vendedor: </label>
                        <input readonly="yes" name="vendedor" type="text" value="{$vendedor}"  />
                    </div>
                    <div class="cliente">
                        <label> Cliente: </label>
                        <input readonly="yes" name="cliente" type="text" value="{$cliente}"  />
                    </div>
                </div>
                <div class="der">
                    <div class="sucursal">
                        <label> Sucursal: </label>
                        <input readonly="yes" name="sucursal" type="text" value="{$sucursal}"  />
                    </div>
                    <div class="contacto">
                        <label> Contacto: </label>
                        <input readonly="yes" name="contacto" type="text" value="{$contacto}"  />
                    </div>
                    <div class="tipoLlamada">
                        <label> Tipo de Llamada: </label>
                        <select name="tipoLlamada">
                            <option value="E">Entrante</option>
                            <option value="S">Saliente</option>   
                        </select>
                    </div>
                    <div class="prioridad">
                        <label> Prioridad: </label>
                        <select name="prioridad">
                            <option value="MB">Muy Baja</option>
                            <option value="B">Baja</option>
                            <option value="M">Media</option>
                            <option value="A">Alta</option>
                            <option value="MA">Muy Alta</option>
                        </select>
                    </div>
                </div>
                <div class="temas marginTop20">
                    <div class="telefono">
                        <label> Telefono: </label>
                        <input readonly="yes" name="telefono" type="text" value="{$telefono}"  />
                    </div>
                    <div class="observaciones">
                        <label class="block"> Temas a Tocar: </label>
                        <textarea readonly="yes" id="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                    </div>
                </div>  
            </div>    
        </form>
        <form class="box-entrada" name="add_hotel" action="/ger_planificacion_gastos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="temas observaciones">
                    <label> Temas a Tocados: </label>
                    <textarea readonly="yes" ></textarea>
                </div>
                <div class="clear">
                    <div class="prioridad">
                        <label> Fecha: </label>
                        <input readonly="yes" name="fecha" type="text" value="{$fecha}"  />
                    </div>
                    <div class="prioridad">
                        <label> Hora: </label>
                        <input readonly="yes" name="hora" type="text" value="{$hora}"  />
                    </div>
                </div>
                <div class="observaciones">
                    <label class="block"> Observaciones: </label>
                    <textarea readonly="yes" id="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>                 
            </div>    
        </form>

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
