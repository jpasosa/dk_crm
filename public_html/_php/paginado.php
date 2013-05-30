<?php

$tpl = new PlantillaReemplazos();

$paginado = new ArmadoPaginado;
$paginado->cantidadTotal( 50 );
$paginado->cantidadPorPagina( 3 );
$paginado->textoAnterior( 'anterior' );
$paginado->textoSiguiente( 'siguiente' );
$paginado->textoInicio( 'inicio' );
$paginado->textoFin( 'fin' );
$paginado->textoEstilo( 'link_paginas' );
$paginado->textoEstiloActual( 'texto_rojo' );
$paginado->separacion( ' - ' );
$paginado->linksPorLado( 3 );

$tpl->asignar('limiteInicial', $paginado->limiteInicialConsulta());
$tpl->asignar('paginado', $paginado->obtenerPaginado());
$tpl->asignar('obtCantidad', $paginado->obtCantidadPaginas());
$tpl->obtenerPlantilla();
