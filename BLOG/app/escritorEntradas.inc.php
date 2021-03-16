<?php
include_once 'app/Conexion.inc.php';

include_once 'app/Usuari.inc.php';
include_once 'app/Entrada.inc.php';


include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioEntrada.inc.php';


class escritorEntradas {
    
    public static function escribir_entradas() {
       
        $entradas = repositorioEntrada::obtener_todas_por_fecha_descendiente(Conexion::obtener_conexion());
        
        if (count($entradas)) {
            
            foreach ($entradas as $entrada) {
               
                 self::escribir_entrada($entrada); 
                 
// pq estem a la mateixa classe
            }
        }
    }

    public static function escribir_entrada($entrada) {
        if (!isset($entrada)) 
        {
            return;
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class=" panel panel-default">
                    <div class="panel-heading">
                        <strong>
                        <?php
                        Conexion:: abrir_conexion();
                        $ident= $entrada -> obtener_autor_id();
                        $autor= repositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$ident) ;
                       
                            echo $entrada -> obtener_titulo_entrada();
                            echo ' per ';
                            ?>
                            <a href="#"> <?php echo $autor -> obtener_nombre(); ?> </a>
                         
              
                    </strong>
                    </div>
                    <div class="panel-body " >
                        <p>
                            <strong>
                                <?php
                                    echo $entrada -> obtener_fecha_entrada();
                                ?>
                            </strong>
                        </p> 
                        <div class="text-justify"> 
                        <?php
                            echo self::resumir_texto(nl2br($entrada -> obtener_texto_entrada()));
                        ?>
                            <br>
                            <div class='text-center'>
                                 <a class='btn btn-primary' href="
                                     <?php echo RUTA_ENTRADA. '/'.$entrada -> obtener_url() ?>" text-center role='button'> Llegir més </a>
                           </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <?php
    }
    
    public static function mostrar_entradas_busqueda($entradas)
    {
        for($i=1; $i <= count($entradas); $i++)
        {
//            if ($i % 3 == 0) // per mostrarho en blocs de 3
//            {
//                ?>
                    <div class='row'>
                <?php
//                
//            }
            
            $entrada= $entradas[$i-1];
            self::mostrar_entrada($entrada);
//            
//            if ($i % 3 == 0) // per mostrarho en blocs de 3
//            {
//                ?>
                    </div>
                <?php
//                
//            }
        }
    }
    
    public static function mostrar_entradas_busqueda_multiple($entradas)
    {
        for($i=0; $i < count($entradas); $i++)
        {
            ?>
                <div class='row'>
            <?php
               
            $entrada= $entradas[$i];
            self::mostrar_entrada_multiple($entrada);
            
            ?>
                </div>
            <?php
        }
    }
    
     public static function mostrar_entrada($entrada) {
        if (!isset($entrada)) 
        {
            return;
        }
        ?>
        
            <div class="col-md-12">
                <div class=" panel panel-default">
                    <div class="panel-heading">
                        <strong>
                        <?php
                        Conexion:: abrir_conexion();
                        $ident= $entrada -> obtener_autor_id();
                        $autor= repositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$ident) ;
                       
                            echo $entrada -> obtener_titulo_entrada();
                            echo ' per ';
                            ?>
                            <a href="#"> <?php echo $autor -> obtener_nombre(); ?> </a>
                         
              
                    </strong>
                    </div>
                    <div class="panel-body " >
                        <p>
                            <strong>
                                <?php
                                    echo $entrada -> obtener_fecha_entrada();
                                ?>
                            </strong>
                        </p> 
                        <div class="text-justify"> 
                        <?php
                            echo self::resumir_texto(nl2br($entrada -> obtener_texto_entrada()));
                        ?>
                            <br>
                            <div class='text-center'>
                                 <a class='btn btn-primary' href="
                                     <?php echo RUTA_ENTRADA. '/'.$entrada -> obtener_url() ?>" text-center role='button'> Llegir més </a>
                           </div>
                        </div>
                    </div>  
                </div>
            </div>
  
        <?php
    }
    
    public static function mostrar_entrada_multiple($entrada) {
        if (!isset($entrada)) 
        {
            return;
        }
        ?>
        
            <div class="col-md-12">
                <div class=" panel panel-default">
                    <div class="panel-heading">
                        <strong>
                        <?php
                        Conexion:: abrir_conexion();
                        $ident= $entrada -> obtener_autor_id();
                        $autor= repositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$ident) ;
                       
                            echo $entrada -> obtener_titulo_entrada();
                            echo ' per ';
                            ?>
                            <a href="#"> <?php echo $autor -> obtener_nombre(); ?> </a>
                         
              
                    </strong>
                    </div>
                    <div class="panel-body " >
                        <p>
                            <strong>
                                <?php
                                    echo $entrada -> obtener_fecha_entrada();
                                ?>
                            </strong>
                        </p> 
                        <div class="text-justify"> 
                        <?php
                            echo self::resumir_texto(nl2br($entrada -> obtener_texto_entrada()));
                        ?>
                            <br>
                            <div class='text-center'>
                                 <a class='btn btn-primary' href="
                                     <?php echo RUTA_ENTRADA. '/'.$entrada -> obtener_url() ?>" text-center role='button'> Llegir més </a>
                           </div>
                        </div>
                    </div>  
                </div>
            </div>
  
        <?php
    }
    
    public static function resumir_texto($texto)
    {
        $longitud_maxima=400; //caracters
        $resultado='';
        if ( strlen($texto) >= $longitud_maxima)
        {
//           for ($i = 0; $i<$longitud_maxima; $i++)
//           {
//               $resultado.=substr($texto,$i,1);
//           }
//           
            $resultado=substr($texto,0,$longitud_maxima);
            $resultado.= '...';
        }
        else
        {
            $resultado = $texto;
        }
        
        return $resultado;
    }

}
?>
