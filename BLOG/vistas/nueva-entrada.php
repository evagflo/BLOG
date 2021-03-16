<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/ValidadorEntrada.inc.php';

include_once 'app/ControlSesion.inc.php';
include_once 'app/redireccion.inc.php';

$entrada_publica= 0;

if(isset($_POST['guardar']))
{
    
    Conexion:: abrir_conexion();
    
    
    $validador = new ValidadorEntrada($_POST['titulo'],$_POST['url'], ($_POST['texto']), Conexion::obtener_conexion());
 
    if (isset($_POST['publicar']) && $_POST['publicar'] == 'si')
    {
       
        $entrada_publica= 1;
    }
    
    
    
    if ($validador -> entrada_valida())
    {
        
        if (ControlSesion::sesion_iniciada())
        {
            $entrada = new Entrada ('',$_SESSION['id_usuario'], $validador->obtener_url(),
                    $validador->obtener_titulo(),$validador->obtener_texto(),'',$entrada_publica);
            
            $entrada_insertada = repositorioEntrada::insertar_entrada(Conexion::obtener_conexion(),$entrada);
           
            
            if($entrada_insertada)
            {
                echo' if';
                redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
            } 
            else
            {
                echo'else if';
                redireccion::redirigir(RUTA_LOGIN);
            }
        
        }
        
        Conexion::cerrar_conexion();
    }
}


$titulo = 'Entrada nova';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Nova entrada</h1>
    </div>
</div> 

<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <form class="form-nueva-entrada" method="post" action="<?php echo RUTA_NUEVA_ENTRADA;?>">
            <?php
            if (isset($_POST['guardar']))
            {
              // include_once 'plantillas/form_nueva_entrada_vacia.inc.php';  
                include_once 'plantillas/form_nueva_entrada_validado.inc.php';
            }
            else
            {
              include_once 'plantillas/form_nueva_entrada_vacia.inc.php';  
            }
            ?>
            </form>
        </div>
    </div>
</div>
    
    


<?php
include_once 'plantillas/documento-cierre.inc.php';
?>


