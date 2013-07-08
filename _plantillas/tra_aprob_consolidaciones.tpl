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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cliente:</label>
                        <select name="cliente" class="ultimoElement">
                            <option>OPTION1</option>
                            <option>OPTION2</option>
                        </select>
                    </div>
                </div>
                <div class="izq clear"><p class="azul bold">PACKING LIST</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label >Contacto:</label>
                        <input name="contacto" type="text" value=''  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label>Teléfono:</label>
                        <input name="telefono" type="text" value=''  alt="Teléfono" />
                    </div>
                    <div class="campania">
                        <label>Mail:</label>
                        <input name="mail" type="text" value=''  alt="Mail" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label >Dirección:</label>
                        <input name="direccion" type="text" value=''  alt="Dirección" />
                    </div>
                    <div class="campania">
                        <label>Fecha:</label>
                        <input name="fecha" type="text" value=''  alt="Fecha" />
                    </div>
                    <div class="campania">
                        <label>Hora:</label>
                        <input class="ultimoElement" name="hora" type="text" value=''  alt="Hora" />
                    </div>                    
                </div>
                <div class="izq clear"><p class="azul bold">DONDE CONSOLIDA</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label >Empresa:</label>
                        <input name="empresa" type="text" value=''  alt="Empresa" />
                    </div>
                    <div class="campania">
                        <label>Contacto:</label>
                        <input name="contacto" type="text" value=''  alt="Contacto" />
                    </div>
                    <div class="campania">
                        <label>Teléfono:</label>
                        <input name="telefono" type="text" value=''  alt="Teléfono" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label >Mail:</label>
                        <input name="mail" type="text" value=''  alt="Mail" />
                    </div>
                    <div class="campania">
                        <label>Dirección:</label>
                        <input name="direccion" type="text" value=''  alt="Dirección" />
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
