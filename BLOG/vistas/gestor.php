<?php
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
// panel de control
include_once 'plantillas/panel-control-declaracion.inc.php';

// GESTOR
switch($gestor_actual)
{
     case '':
        $cantidad_entradas_activas= repositorioEntrada::contar_entradas_activas_usuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
        $cantidad_entradas_inactivas= repositorioEntrada::contar_entradas_inactivas_usuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
        $cantidad_comentarios= repositorioComentario::contar_comentarios_usuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
        include_once 'plantillas/gestor-generico.inc.php';
        break;
    
    case 'entradas':
        $array_entradas=repositorioEntrada::obtener_entradas_usuario_fecha_descendente(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
        include_once 'plantillas/gestor-entradas.inc.php';
        break;
    
    case 'comentarios':
        include_once 'plantillas/gestor-comentarios.inc.php';
        break;
    
    case 'favoritos':
        include_once 'plantillas/gestor-favoritos.inc.php';
        break;
        
}
// panel de control
include_once 'plantillas/panel-control-cierre.inc.php';
?>


<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

