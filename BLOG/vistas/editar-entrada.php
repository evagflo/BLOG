<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/ValidadorEntrada.inc.php';
include_once 'app/ValidadorEntradaEditada.inc.php';

include_once 'app/ControlSesion.inc.php';
include_once 'app/redireccion.inc.php';

Conexion:: abrir_conexion();
if (isset($_POST['guardar-cambios-entrada']))
{

    $entrada_publica_nueva=0;
    if (isset ($_POST['publicar']) && $_POST['publicar']== 'si')
    {
        $entrada_publica_nueva=1;
    }


    $validador_new= new ValidadorEntradaEditada($_POST['titulo'], $_POST['titulo-original'],
            $_POST['url'], $_POST['url-original'],
            htmlspecialchars($_POST['texto']), $_POST['texto-original'],
            $entrada_publica_nueva, $_POST['checkbox-original'], Conexion::obtener_conexion()
            );
    // si tot es correcte EDITAR CANVIS BD
    
    if (!$validador_new -> hay_cambios()) // no hi ha canvis-> redirigeixo al gestor
    {
         redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
    }
    else
    {
            
        if( $validador_new -> entrada_valida())
        {
            
            $cambio_efectuado = repositorioEntrada::actualizar_entrada(Conexion::obtener_conexion(),$_POST['id-entrada'],
                $validador_new-> obtener_titulo(),$validador_new->obtener_url(),$validador_new->obtener_texto(),
                $entrada_publica_nueva);
         
            if ($cambio_efectuado)
            {
               redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
            }
        }
    }
}
            
    

$titulo= "Editar entrada";

// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Editar entrada</h1>
    </div>
</div> 

<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <form class="form-nueva-entrada" method="post" action="<?php echo RUTA_EDITAR_ENTRADA;?>">
            <?php
                if (isset($_POST['editar_entrada']))
                {
                   //echo 'vol editar';
                   $id_entrada = $_POST['id_editar'];

                   $entrada_recuperada= repositorioEntrada::obtener_entrada_por_id(Conexion::obtener_conexion(),$id_entrada);
                   
                   include_once 'plantillas/form_entrada_recuperada.inc.php';
                  Conexion::cerrar_conexion();
                 
                    
                }
                else if (isset ($_POST['guardar-cambios-entrada']))
                {
                    //validar i guardar info
                    $id_entrada = $_POST['id-entrada'];
                    $entrada_recuperada= repositorioEntrada::obtener_entrada_por_id(Conexion::obtener_conexion(),$id_entrada);
                    
                   
                    //plantilla validada
 
                    include_once 'plantillas/form_entrada_recuperada_validada.inc.php';
                }
            ?>
            </form>
        </div>
    </div>
</div>
    






<?php
include_once 'plantillas/documento-cierre.inc.php';
?>




