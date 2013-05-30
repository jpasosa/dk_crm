<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p class="texto_rojo_negrita">Variables<br /></p>

	{* esta etiqueta es de comentario *}
    
    {* la siguiente veriable fué asignada en el archivo /_php/variables.php *}
    
    {$texto}
    
    <br />
    <br />
    
    {* la siguiente veriable fué asignada en el archivo /_php/variables.php y puede ser utilizada en otras plantillas *}
    
    {$#general}
    
    <br />
    <br />
    
    {* la siguiente veriable fué configurada en el archivo de varibles del sitio desde /_configuraciones/variables.php *}
    
    {$#variable_prueba}
    
    <br />
    <br />

    {foreach item=nombres from=$nombre}
    
	    {* la siguiente veriable que fué generada dentro del template *}

        {$$nombres}
        
    {/foreach}

    <br />
    <br />
    
    {* la siguiente veriable es una matriz, es importante destacar que en la plantilla sus elementos se llaman sin usar comillas dobles ni simples *}
    
    {$numero[0][valor]}

    </td>
  </tr>
</table>
