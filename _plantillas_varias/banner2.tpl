<link href="_css/estilos.css" rel="stylesheet" type="text/css">
<link href="_css/formulario.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td bgcolor="#FFFFCC" class="texto_azul">
        Este es el template<span class="texto_negrita"> &quot;banner2&quot;</span>, que corresponde al archivo<span class="texto_negrita"> /banner2.tpl</span>, al existir un archivo <span class="texto_negrita">/_php/banner2.php</span>, es tomado por el sistema, y procesado.<br /> <br />
        
        {foreach item=nombre from=$nombres}
            {$$nombre[1]}, {$$nombre[0]}<br />
        {/foreach}

         <br /> COSAS <br />   
        {foreach item=cos from=$cosas}
            {$$cos}<br />
        {/foreach}

    
    </td>
  </tr>
</table>
