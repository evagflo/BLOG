<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/redireccion.inc.php';


if (isset($_POST['borrar_entrada']))
    {
        $id_entrada = $_POST['id_borrar'];
        
        Conexion::abrir_conexion();
        
        repositorioEntrada::eliminar_comentarios_y_entrada(Conexion::obtener_conexion(),$id_entrada);
        
        Conexion::cerrar_conexion();
        
        redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
       
    }

?>
