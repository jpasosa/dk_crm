<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p class="texto_rojo_negrita">Modificadores<br /></p>

	{* esta etiqueta es de comentario *}
    
    {$texto|upper}

    <br /><br />

    {$texto|lower}

    <br /><br />
    
    {$texto|capitalize}

    <br /><br />
    
    {$texto|nl2br}

    <br /><br />
    
    {$texto|truncate:30:'...'}

    <br /><br />

    {$texto|upper|nl2br|truncate:40:"..."}


    <br /><br />

    {$texto|upper|nl2br|truncate:18:"...":true}

    <br /><br />
    
    {$texto|regex_replace:"/([0-3]+)/":"-numero-"}
    
    <br /><br />
    
    {$texto|replace:"10":"diez"}

    <br /><br />
    {* similar a la funcion date de PHP *}

	{$fecha_unix|date_format:"d/m/Y h:i:s"}

    <br /><br />
	{* similar a la funcion sprintf de PHP *}

	{$numero|string_format:"%.2f"}

    <br /><br />
	{* similar a la funcion number_format de PHP *}

	{$numero|number_format:2:",":" "}

    <br /><br />

	{$variable_vacia|default:"Esta variable no tiene un valor asignado."}

    <br /><br />
    {* similar a la funcion html_entity_decode de PHP *}
    
  	{$html|escape:"html"}  
    
    <br /><br />
    {* similar a la funcion htmlspecialchars de PHP *}
    
  	{$html|escape:"htmlall"}  

    <br /><br />
    {* similar a la funcion addslashes de PHP *}
    
  	{$html|escape:"quotes"}  

    <br /><br />
    {* similar a la funcion urlencode de PHP *}
    
  	{$url|escape:"url"}  

    </td>
  </tr>
</table>
