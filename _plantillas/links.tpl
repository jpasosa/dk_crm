<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p class="texto_rojo_negrita">Links<br /></p>

    Los valores de las etiqueta de Links, están separado por barras inclinadas, al igual que las URL.<br />
    <br />
    La etiqueta se ve como <strong>{#</strong><strong>link</strong><span class="texto_rojo">/</span>$valores_get[0]['valor']<span class="texto_rojo">/</span>$valores_get[1]["valor"]<span class="texto_rojo">/</span>valores_get<strong>}</strong><br />
    
    <br />
    <br />
    
    {#link/$valores_get[0]['valor']/$valores_get[1]["valor"]/valores_get}

    <br />
    <br />

    {foreach item=valores from=$valores_get}

    	{#link/$$valores['valor']}<br />
        
    {/foreach}

    </td>
  </tr>
</table>
