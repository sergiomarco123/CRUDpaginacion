<?php
// Controlador
require_once('app/Cliente.php');
require_once('app/AccesoDatos.php');
require_once('app/funciones.php');
define ('FPAG',10); // Número de filas por página

session_start();

$midb = AccesoDatos::getModelo();
$totalfilas = $midb->numClientes();
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];

// Proceso la ordenes
if ( isset($_GET['orden'])) {

    switch ( $_GET['orden']) {
        case "Primero"  : $posAux = 0; break;
        case "Siguiente": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
        case "Anterior" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
        case "Ultimo"   : $posAux = $posfin;break;
        case "Nuevo"    : accionNuevo(); break;
        case "Borrar"   : accionBorrar   ($_GET['id']); break;
        case "Modificar": accionModificar($_GET['id']); break;  
    }
}
else {

    if (isset($_GET['orden2'])) {
        switch ($_GET['orden2']) {
            case "Nuevo":accionPostAlta();break;
            case "Modificar":accionPostModificar();break;
            case "Volver":;break;
        }
    }
}
 
$_SESSION['posini'] = $posAux;

// Accedo al Modelo
$tvalores = $midb->getClientes($posAux,FPAG);
// Invoco la vista
include_once('app/plantillas/principal.php');

