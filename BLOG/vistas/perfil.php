<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: ". gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache. must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//phpinfo();
include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/Usuari.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/redireccion.inc.php';

if (!ControlSesion::sesion_iniciada())
{
    redireccion::redirigir(SERVIDOR_LOGIN);
}
else
{
    Conexion::abrir_conexion();
    $id=$_SESSION['id_usuario'];
    $usuario=repositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$id);
}

if (isset($_POST['guardar-imagen']) && $_FILES['archivo-subido']['tmp_name'])
{
    
    $directorio=DIRECTORIO_RAIZ."/subidas/";
    $carpeta_objectivo=$directorio.basename($_FILES['archivo-subido']['name']);
    $subida_correcta=1;
    $tipo_imagen=pathinfo($carpeta_objectivo,PATHINFO_EXTENSION);
    
    
    $comprobacion=getimagesize($_FILES['archivo-subido']['tmp_name']);
    
    if ($comprobacion !== false)
    {
        $subida_correcta=1;
       
    }
    else
    {
        $subida_correcta=0;
       // echo 'no penjat';
    }
}
    
   

$titulo='Perfil de usuario';

// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>

<div class=" container perfil">
    <div class="row">
        <div class="col-md-3">
            <?php
            
            if (file_exists(DIRECTORIO_RAIZ."/subidas/".$usuario->obtener_id()))
            {
                
            ?>
             <img src="<?php echo SERVIDOR.'/subidas/'.$usuario->obtener_id()?>" class="img-responsive">
            <?php
            } else
            {
                ?>
                <img src="img/usuario.png" class="img-responsive">
                <?php
            }
            ?>
            
            <br>
            <form class="text-center" action="<?php echo RUTA_PERFIL;?>" method="post"
                  enctype="multipart/form-data">
                <label for="archivo-subido" id="label-archivo">Penja una imatge</label>
                <input type="file" name="archivo-subido" id="archivo-subido" class="boton-subir">
                <br>
                <br>
                <input type="submit"  value="Guardar" name="guardar-imagen" class="form-control">
  
            </form>
        </div>
        <div class="col-md-9">
            <h4><small>Nom d'usuari</small></h4>
            <h4><?php echo $usuario -> obtener_nombre();?></h4>
            <br>
            <h4><small>Email</small></h4>
            <h4><?php echo $usuario -> obtener_email();?></h4>
            <br>
            <h4><small>Usuari des de</small></h4>
            <h4><?php echo $usuario -> obtener_data_registro();?></h4>
            
        </div>
    </div> 
    <div class="row">
        <br>
        
    </div>
    <div class="row">
                      <?php //ALERTS
                    if (isset($_POST['guardar-imagen']) && $_FILES['archivo-subido']['tmp_name'])
                    {
                        if ($_FILES['archivo-subido']['size'] > 500000)//bytes
                        {
                            //echo "L'arxiu no pot ocupar més de 500kb" ;//notificacio bootsrap
                            $subida_correcta=0;
                            ?>
                            
                            <div class="alert alert-danger alert-dismissible" role="alert"> 
                                L'arxiu no pot ocupar més de <strong>500kb</strong>. 
                            </div>
                            <?php
                        }

                        if ($tipo_imagen != "JPG" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif")
                        {
                            //echo "Format incorrecte. Només s'admet format JPG,PNG,JPEG o GIF" ;//notificacio bootsrap
                            $subida_correcta=0;
                            ?>
                            <div class="alert alert-danger" role="alert"> 
                                Format incorrecte. Només s'admet format <strong>JPG</strong>,<strong>PNG</strong>,<strong>JPEG</strong> o <strong>GIF</strong>. 
                            </div> 
                            <?php
                        }
    
                        if ($subida_correcta == 0)
                        {
                            ?>

                            <div class="alert alert-danger alert-dismissible" role="alert"> 
                                El teu arxiu <strong>NO</strong> s'ha pogut pujar correctament. 
                            </div> 
        
                        <?php
                        }
                        else
                        {
                            if(move_uploaded_file($_FILES['archivo-subido']['tmp_name'],
                            DIRECTORIO_RAIZ."/subidas/".$usuario->obtener_id()))//.".".$tipo_imagen
                            {
                               // echo "L'arxiu ". basename($_FILES['archivo_subido']['name']). "s'ha pujat amb èxit.";// ventana notiicacion verde bootsrap check

                                ?>

                                <div class="alert alert-success alert-dismissible" role="alert"> 
                                    L'arxiu <strong><?php echo basename($_FILES['archivo-subido']['name'])?></strong> s'ha pujat correctament.
                                </div> 

                                <?php
                            }   
                            else
                            {
                                echo "hi ha hagut un error";

                            }
                        }
                    }
                    
   
                ?>
    </div>
</div>

               
        
                        

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>