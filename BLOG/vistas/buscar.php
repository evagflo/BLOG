<?php

include_once 'app/escritorEntradas.inc.php';

$busqueda=null;
$resultados=null;

//$resultados_multiples=null;

$buscar_titulo=false;
$buscar_contenido=false;
$buscar_tags=false;
$buscar_autor=false;

//BUSQUEDA SENZILLA
if (isset( $_POST['busca']) && isset( $_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) 
{
  //  $resultados_multiples=false;
    $busqueda=$_POST['termino-buscar'];
    // validar el terme $busqueda
    
    Conexion::abrir_conexion();
    
    $resultados=repositorioEntrada::buscar_entradas_todos_los_campos(Conexion::obtener_conexion(),$busqueda);
     
    Conexion::cerrar_conexion();  
}


//BUSQUEDA AVANÇADA
if (isset( $_POST['buscar_avanzat']) && isset($_POST['campos']))

{
    if (in_array("titulo",$_POST['campos']))
    {
        $buscar_titulo=true;
       // echo $buscar_titulo;
    }
 
    if (in_array("contenido",$_POST['campos']))
    {
        $buscar_contenido=true;
    }
    
    if (in_array("tags",$_POST['campos']))
    {
        $buscar_tags=true;
    }
    
   if (in_array("autor",$_POST['campos']))
    {
        $buscar_autor=true;
    }
    
    if ($_POST['fecha'] == "recientes")
    {
        $orden= "DESC";
    }
    
    if ($_POST['fecha'] == "antiguas")
    {
        $orden= "ASC";
    }
    
    if (isset( $_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) 
    {
       // $resultados_multiples=true;
        $busqueda=$_POST['termino-buscar'];
        
        Conexion::abrir_conexion();
        
        if($buscar_titulo)
        {
            $entradas_por_titulo=repositorioEntrada::buscar_entradas_por_titulo(Conexion::obtener_conexion(),$busqueda,$orden);
        
//            echo print_r ($entradas_por_titulo);

        }
        
        if($buscar_contenido)
        {
            $entradas_por_contenido=repositorioEntrada::buscar_entradas_por_contenido(Conexion::obtener_conexion(),$busqueda,$orden);
        
//            echo print_r ($entradas_por_contenido);

        }
        
        if($buscar_tags)
        {
//           echo ' todavia no implementado';
        }
        
        if($buscar_autor)
        {
            $entradas_por_autor=repositorioEntrada::buscar_entradas_por_autor(Conexion::obtener_conexion(),$busqueda,$orden);
        
//            echo print_r ($entradas_por_autor);

        }
                
//        echo print_r ($_POST['campos']);

//        echo $_POST['fecha'];
    }
  
}



$titulo = 'Buscador';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>


<div class="row">
<div class="container">
    <div class="jumbotron text-center">
        <h1>BUSCADOR</h1>
        <br>
        <div class='row'>
            <div class='col-md-2'>

            </div>
            <div class='col-md-8'>
                <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>"> 
                    <div class="form-group">
                        <input type="search" name="termino-buscar" class="form-control" placeholder="Què busques?" 
                               required  <?php echo "value = '" . $busqueda . "'"; ?>>
                    </div>
                    <button type="sumbit" name="busca" class="form-control btn btn-primary">
                        Buscar
                    </button>
                </form>
            </div>

        </div>
    </div>
    </div> 
</div>

<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="form-control btn btn-large" data-toggle="collapse" href="#avanzada" role="button" >
                            Búsqueda avançada
                        </a>
                    </h4> 
                </div>
                <div id="avanzada" class="collapse">
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                        <div class="form-group">
                            <input type="search" name="termino-buscar" class="form-control" placeholder="Què busques?" required  <?php echo "value = '" . $busqueda . "'"; ?>>
                        </div>
                            
                            <p>Buscar en els següents camps:</p>
                            
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="titulo"
                                <?php
                                if (isset($_POST['buscar_avanzat']))
                                {
                                    if($buscar_titulo)
                                    {
                                        echo "checked";
                                    }
                                }
                                else
                                {
                                    echo "checked";
                                }
                                
                                ?>     
                                > Títol
                            </label>
                            
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="contenido" 
                                <?php
                                if (isset($_POST['buscar_avanzat']))
                                {
                                    if($buscar_contenido)
                                    {
                                        echo "checked";
                                    }
                                }
                                else
                                {
                                    echo "checked";
                                }
                                
                                ?> 
                                > Contingut
                            </label>
                            
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="tags"
                                
                                <?php
                                if (isset($_POST['buscar_avanzat']))
                                {
                                    if($buscar_tags)
                                    {
                                        echo "checked";
                                    }
                                }
                                else
                                {
                                    echo "checked";
                                }
                                
                                ?> 
                            > Tags
                            </label>
                            
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="autor" 
                                
                                <?php
                                if (isset($_POST['buscar_avanzat']))
                                {
                                    if($buscar_autor)
                                    {
                                        echo "checked";
                                    }
                                }
                               
                                
                                ?> 
                            > Autor
                            </label>
                            <hr>
                            
                            <p>Ordenar per:</p>
                            
                            <label class="radio-inline">
                                <input type="radio" name="fecha" value="recientes"   
                                 <?php
                                 if (isset($_POST['buscar_avanzat']) && isset($orden) && $orden== 'DESC')
                                 {
                                     echo "checked";
                                 }
                                 if (!isset($_POST['buscar_avanzat']))
                                 {
                                     echo "checked";
                                 }
                                 
                                 ?>
                                > Entrades més recents primer
                            </label>
                            
                            <label class="radio-inline">
                                <input type="radio" name="fecha" value="antiguas" 
                                 <?php
                                 if (isset($_POST['buscar_avanzat']) && isset($orden) && $orden== 'ASC')
                                 {
                                     echo "checked";
                                 }
                                 ?>
                                       
                                > Entrades més antigues primer
                            </label>
                            
                            <hr>
                            <button type="sumbit" name="buscar_avanzat" class="btn btn-primary btn">
                                Búsqueda avançada
                            </button>
                            
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class='container' id ='resultados' >
    <div class='row'>
        <div class='col-md-12'>
            <div class='page-header'>
                <h1>
                    Resultats de la búsqueda 
                    
                    <?php
                    if (isset($_POST['busca']) && count($resultados))   
                    {
                        echo " ";  
                        ?>
                            <small> <?php echo count ($resultados); ?></small>
                        <?php
                    }
                    else if ($_POST['buscar_avanzat'])
                    {
                        //
                    }
                    ?>
                </h1>
            </div>
        </div>
    </div>    
    
    <?php
        if (isset($_POST['busca'])) //busqueda senzilla
        {
            if (count($resultados))
            {
                escritorEntradas::mostrar_entradas_busqueda($resultados);
            }
            else
            {
                ?>
                    <h3>Sense coincidencies</h3>
                    <br>
                <?php
            }
        }
        else if (isset($_POST['buscar_avanzat'])) // busqueda multiple
        {
            if (count($entradas_por_titulo) || count($entradas_por_contenido) || count($entradas_por_autor))
            {
                $parametros = count($_POST['campos']);//validar -> que estiguin incialitzats-> q no siguin 0

                $ancho_columnas= 12 / $parametros;
                ?>
                <div class="row">
                    <?php
                    for($i=0; $i <$parametros; $i++)
                   {
                    ?>
                        <div class= "<?php echo 'col-md-'.$ancho_columnas; ;?> text-center">
                            <h4><?php echo 'Coincidencies en '. $_POST['campos'][$i]; ?></h4>
                            <br>
                            <?php
                            switch ($_POST['campos'][$i])
                            {
                                case "titulo":
                                    escritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_titulo);
                                break;
                            
                                case "contenido":
                                    escritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_contenido);
                                break;
                            
                                case "tags":
                                    //codi
                                break;
                            
                                case "autor":
                                    escritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_autor);
                                break;
                                    
                            }
                            ?>
                            </div>
                            <?php
                   }
                   ?>
                    </div>

                    <?php
                         }
                         else
                             {
                             ?>
                             <h3> Sense coincidencies</h3>
                             <br>
                            <?php
                             }
        }
        
       ?>

</div>
                

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>