<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p><span class="texto_rojo_negrita">Etiquetas HTML<br />
        </span><br />
        Para ver las etiquetas HTML integradas con la clase Formulario, ver el archivo /_php/clase_formulario, descripto en <a href="{#link/clase_formulario}" class="texto_rojo">link</a><br /><br />
    </p>
    
    {* todos los tributos de las etiquetas son obligatorios *}

    Select:
    <br />
    {html_select name="campo_nombre_new" options=$opciones selected=$seleccionado_uno style="input2" separator="<br />"}
    <br />
    Select (parametros obligatorios):
    <br />
    {html_select name="campo_nombre2"}

    <br /><br />  
    Checkboxes:
    <br />

    {html_checkboxes name="campo_checkboxes" options=$opciones selected=$seleccionado style="input2" separator="<br />"}
    <br />
    Checkboxes (parametros obligatorios):
    <br />
    {html_checkboxes name="campo_checkboxes2" options=$opciones}

    <br /><br />    
    Radios:
    <br />

    {html_radios name="campo_radios" options=$opciones selected=$seleccionado_uno style="input3" separator="<br />"}
    <br />
    Radios (parametros obligatorios):
    <br />
    {html_radios name="campo_radios2" options=$opciones}

    <br /><br />
    Input:
    <br />

    {html_input name="campo_input" value=$valor_inicial style="input2" width="100"}
    <br />
    Input (parametros obligatorios):
    <br />
    {html_input name="campo_input2"}

    <br /><br />
    Password:
    <br />
    
    {html_password name="campo_password" style="input2" width="100"}
    <br />
    Password (parametros obligatorios):
    <br />
    {html_password name="campo_password2"}

    <br /><br />
    File:
    <br />

    {html_file name="campo_file" style="input2" width="100"}
    <br />
    File (parametros obligatorios):
    <br />
    {html_file name="campo_file2"}

    <br /><br />
    Textarea:
    <br />
    
    {html_textarea name="campo_textarea" value=$valor_inicial style="input2" width="100" height="100"}
    <br />
    Textarea (parametros obligatorios):
    <br />
    {html_textarea name="campo_textarea2"}

    <br /><br />
    Error:
    <br />
    
    {html_error name="campo_textarea"}

    </td>
  </tr>
</table>
