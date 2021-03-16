<?php

//inlcude_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';

class repositorioEntrada 
{
    public static function insertar_entrada($conexion,$entrada)
    {
        $entrada_insertada = false;    
       if (isset ($conexion))
       {
           
           try {
              
               $sql= "INSERT INTO entradas (autor_id, url, titulo, texto, fecha, activa) VALUES (:autor_id, :url, :titulo, :texto, NOW(), :activa)";
               $sentencia= $conexion -> prepare($sql);
//               $nombre = $usuario ->obtener_nombre();
//               $email = $usuario ->obtener_email();
//               $password = $usuario ->obtener_password();   
 
              
                $sentencia->bindParam(':autor_id', $entrada -> obtener_autor_id(), PDO::PARAM_STR);
                $sentencia->bindParam(':url', $entrada -> obtener_url(), PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $entrada -> obtener_titulo_entrada(), PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $entrada -> obtener_texto_entrada(), PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $entrada -> esta_activa_entrada(), PDO::PARAM_STR);
                       
               $entrada_insertada = $sentencia -> execute();
            
           } 
           catch (PDOException $ex) 
           {
               print "ERROR3". $ex -> getMessage();
           }
       }
       return  $entrada_insertada;
    }
    
    public static function obtener_todas_por_fecha_descendiente($conexion)
    {
        $entradas=[];
        if (isset($conexion))
        {
            
            try
            {
                $sql= "SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia ->fetchAll();
                
                
                if (count($resultado))
                {
                    foreach ($resultado as $fila)
                    {
                        
                        $entradas[] = new Entrada (
                                $fila['id'],
                                $fila['autor_id'],
                                $fila['url'],
                                $fila['titulo'],
                                $fila['texto'],
                                $fila['fecha'],
                                $fila['activa']);
     
                    }
                    
               
                   
                 
                  
                 
                }
               
            } 
            catch (PDOException $ex) 
            {
                print "ERROR4" . $ex -> getMessage();
            }
        }
        
        return $entradas;
    }
    
    public static function obtener_entrada_por_url($conexion,$url)
    {
        $entrada=null;
        if (isset($conexion))
        {
            
            try 
            {
                
                $sql ="SELECT * FROM entradas WHERE url LIKE :url" ;
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':url',$url,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetch();
                
                if (!empty($resultado))
                {
                    
                    $entrada = New Entrada (
                          $resultado['id'],$resultado['autor_id'],
                                $resultado['url'],$resultado['titulo'],
                                $resultado['texto'], $resultado['fecha'],
                                $resultado['activa']);
                }
            }
            catch (PDOException $ex) 
            {
                print "ERROR7" . $ex -> getMessage();
                
            }
        }
        return $entrada;
    }
    
    public static function obtener_entradas_al_azar($conexion,$limite)
    {
        $entradas=[];
        if (isset($conexion))
        {
            try
   
            {
             
                $sql= "SELECT * FROM entradas ORDER BY RAND() LIMIT $limite";
                 $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia ->fetchAll();
                
               if (count($resultado))
                {
                    foreach ($resultado as $fila)
                    {
                        
                        $entradas[] = new Entrada (
                                $fila['id'],
                                $fila['autor_id'],
                                $fila['url'],
                                $fila['titulo'],
                                $fila['texto'],
                                $fila['fecha'],
                                $fila['activa']);
     
                    }
   
                }
                
            } 
            catch (PDException $ex) 
            {
                print "ERROR8" . $ex -> getMessage();
            }
            
        }

            return $entradas;
    }
  
     public static function contar_entradas_activas_usuario($conexion,$id_usuario)
    {
        $total_entradas='';
        
        if (isset($conexion))
        {
            try 
            {
                $sql ="SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autor_id AND activa = 1" ;
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':autor_id',$id_usuario,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetch();
                
                if (!empty($resultado))
                {
                    
                   $total_entradas= $resultado[total_entradas]; 
                  
                }
            }
            catch (PDOException $ex) 
            {
                print "ERROR9" . $ex -> getMessage();
                
            }
        }
        return $total_entradas;
    }
    
    public static function contar_entradas_inactivas_usuario($conexion,$id_usuario)
    {
        $total_entradas_in=0;
        
        if (isset($conexion))
        {
            try 
            {
                $sql ="SELECT COUNT(*) as total_entradas_in FROM entradas WHERE autor_id = :autor_id AND activa = 0" ;
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':autor_id',$id_usuario,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetch();
                
                
                if (!empty($resultado))
                {
                   
                   $total_entradas_in= $resultado[total_entradas_in]; 
                }
            }
            catch (PDOException $ex) 
            {
                print "ERROR9" . $ex -> getMessage();
                
            }
        }
        return $total_entradas_in;
    }
    
    public static function obtener_entradas_usuario_fecha_descendente($conexion,$id_usuario)
    {
        $entradas_obtenidas=[];
        if (isset($conexion))
        {
            try
   
            {
             
                $sql= "SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id) AS 'cantidad_comentarios' "
                        . "FROM entradas a LEFT JOIN comentarios b ON a.id = b.entrada_id WHERE a.autor_id = :autor_id "
                        . "GROUP BY a.id ORDER BY a.fecha DESC";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':autor_id',$id_usuario,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia ->fetchAll();
                
               if (count($resultado))
                {
                    foreach ($resultado as $fila)
                    {
                        $entradas_obtenidas []=array(
                            new Entrada ($fila['id'],$fila['autor_id'],$fila['url'],$fila['titulo'],$fila['texto'],$fila['fecha'],$fila['activa']
                                        ),
                            $fila['cantidad_comentarios']
                            );
                        
                     
     
                    }
   
                }
                
            } 
            catch (PDException $ex) 
            {
                print "ERROR8" . $ex -> getMessage();
            }
            
        }

            return $entradas_obtenidas;
    }
    
    public static function titulo_existe($conexion, $titulo)
    {
       
        $titulo_existe =false;
        if (isset($conexion))
        {
           
            try
            {
                
                $sql= "SELECT * FROM entradas WHERE titulo = :titulo";
               
                $sentencia = $conexion -> prepare($sql);
              
                $sentencia -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
              
                $sentencia -> execute();
               
                $resultado = $sentencia -> fetchAll();
                
               
                if (count($resultado))
                {
                  
                   $titulo_existe=true; 
                }
                else
                {
                 
                   $titulo_existe=false;  
                }
                
            } 
            catch (PDOException $ex) 
            {
                print 'ERROR10'. $ex -> getMessage();
            }
        }
        return $titulo_existe;
    }
  
     public static function url_existe ($conexion, $url)
    {
        $url_existe =false;
        
        if ( isset($conexion))
        {
            
            try
            {
                $sql= "SELECT * FROM entradas WHERE url = :url";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':url',$url,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia ->fetchAll();
                
                if (count($resultado))
                {
                   $url_existe=true; 
                  
                }
                else
                {
                   $url_existe=false;  
                  
                }
                
            } 
            catch (PDOException $ex) 
            {
                print 'ERROR10'. $ex -> getMessage();
            }
        }
        return $url_existe;
    }
    
    public static function eliminar_comentarios_y_entrada($conexion,$entrada_id)
    {
        if (isset($conexion))
        {
            $conexion -> beginTransaction(); //conjunt doperacions que es realitzen totes a lhora, pero que si no fem comit no es realitzen
            
            $sql1 = "DELETE FROM comentarios WHERE entrada_id=:entrada_id";
            $sentencia1= $conexion-> prepare($sql1);
            $sentencia1 -> bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
            $sentencia1 -> execute();
            
            $sql2 = "DELETE FROM entradas WHERE id=:entrada_id";
            $sentencia2= $conexion-> prepare($sql2);
            $sentencia2 -> bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
            $sentencia2 -> execute();
            
            $conexion -> commit(); //fi transaccio
            try
            {
                
            } 
            catch (PDOException $ex) 
            {
                $conexion -> rollBack(); //tornar a enrere si alguna cosa no ha sortit be
            }
        }
    }
    
    public static function obtener_entrada_por_id($conexion,$id_entrada)
    {
        $entrada=null;
        if (isset($conexion))
        {
            
            try 
            {
                
                $sql ="SELECT * FROM entradas WHERE id = :id_entrada" ;
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':id_entrada',$id_entrada,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetch();
                
                if (!empty($resultado))
                {
                    
                    $entrada = New Entrada (
                          $resultado['id'],$resultado['autor_id'],
                                $resultado['url'],$resultado['titulo'],
                                $resultado['texto'], $resultado['fecha'],
                                $resultado['activa']);
                }
            }
            catch (PDOException $ex) 
            {
                print "ERROR7" . $ex -> getMessage();
                
            }
        }
        return $entrada;
    }
    
    public static function actualizar_entrada($conexion, $id, $titulo, $url, $texto ,$activa)

    {
        
       
        $actualizacion_correcta=false;
        
        if( isset($conexion))
        {
           
            try
            {
                
                $sql= "UPDATE entradas SET titulo = :titulo, url= :url, texto = :texto, activa = :activa WHERE id = :id";
                $sentencia = $conexion-> prepare($sql);
                
                $sentencia -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
                $sentencia -> bindParam(':url',$url,PDO::PARAM_STR);
                $sentencia -> bindParam(':texto',$texto,PDO::PARAM_STR);
                $sentencia -> bindParam(':activa',$activa,PDO::PARAM_STR);
                $sentencia -> bindParam(':id',$id,PDO::PARAM_STR);
                
                $sentencia -> execute();
                $resultado = $sentencia-> rowCount();
                
                if ($resultado)
                {
                    $actualizacion_correcta=true;
                }
                
                
            } catch (PDOException $ex) 
            {
                print "ERROR11" . $ex -> getMessage();
            }
        }
        return $actualizacion_correcta;
    }
    
    public static function buscar_entradas_todos_los_campos ($conexion, $termino_busqueda)
    {
        $entradas=[];
        $termino_busqueda = '%'.$termino_busqueda.'%';
        
        if( isset($conexion))
        {
           
            try
            {
                $sql= "SELECT * FROM entradas WHERE titulo LIKE :busqueda OR texto LIKE :busqueda ORDER BY fecha DESC LIMIT 30";
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':busqueda',$termino_busqueda,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetchAll();
                
                if (count($resultado))
                {
                   foreach ($resultado as $fila)
                    {
                        
                        $entradas[] = new Entrada (
                                $fila['id'],
                                $fila['autor_id'],
                                $fila['url'],
                                $fila['titulo'],
                                $fila['texto'],
                                $fila['fecha'],
                                $fila['activa']);
     
                    }
                }
            } 
            catch (PDOException $ex) 
            {
                  print "ERROR11" . $ex -> getMessage();
            }
        }
        return $entradas;
    }
    
     public static function buscar_entradas_por_titulo ($conexion, $termino_busqueda, $orden)
    {
        $entradas=[];
        $termino_busqueda = '%'.$termino_busqueda.'%';
        
        if( isset($conexion))
        {
           
            try
            {
                $sql= "SELECT * FROM entradas WHERE titulo LIKE :busqueda ORDER BY fecha $orden LIMIT 30";
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':busqueda',$termino_busqueda,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetchAll();
                
                if (count($resultado))
                {
                   foreach ($resultado as $fila)
                    {
                        
                        $entradas[] = new Entrada (
                                $fila['id'],
                                $fila['autor_id'],
                                $fila['url'],
                                $fila['titulo'],
                                $fila['texto'],
                                $fila['fecha'],
                                $fila['activa']);
     
                    }
                }
            } 
            catch (PDOException $ex) 
            {
                  print "ERROR11" . $ex -> getMessage();
            }
        }
        return $entradas;
    }
    
    public static function buscar_entradas_por_contenido ($conexion, $termino_busqueda,$orden)
    {
        $entradas=[];
        $termino_busqueda = '%'.$termino_busqueda.'%';
        
        if( isset($conexion))
        {
           
            try
            {
                $sql= "SELECT * FROM entradas WHERE texto LIKE :busqueda ORDER BY fecha $orden LIMIT 30";
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':busqueda',$termino_busqueda,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetchAll();
                
                if (count($resultado))
                {
                   foreach ($resultado as $fila)
                    {
                        
                        $entradas[] = new Entrada (
                                $fila['id'],
                                $fila['autor_id'],
                                $fila['url'],
                                $fila['titulo'],
                                $fila['texto'],
                                $fila['fecha'],
                                $fila['activa']);
     
                    }
                }
            } 
            catch (PDOException $ex) 
            {
                  print "ERROR11" . $ex -> getMessage();
            }
        }
        return $entradas;
    }
    
     public static function buscar_entradas_por_autor ($conexion, $termino_busqueda,$orden)
    {
        $entradas=[];
        $autor = '%'.$termino_busqueda.'%';
        
        if( isset($conexion))
        {
           
            try
            {
                $sql= "SELECT * FROM entradas e JOIN usuarios u ON u.id = e.autor_id WHERE u.nombre LIKE :autor ORDER BY e.fecha $orden LIMIT 30";
                $sentencia = $conexion-> prepare($sql);
                $sentencia -> bindParam(':autor',$autor,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia-> fetchAll();
                
                if (count($resultado))
                {
                   foreach ($resultado as $fila)
                    {
                        
                        $entradas[] = new Entrada (
                                $fila['id'],
                                $fila['autor_id'],
                                $fila['url'],
                                $fila['titulo'],
                                $fila['texto'],
                                $fila['fecha'],
                                $fila['activa']);
     
                    }
                }
            } 
            catch (PDOException $ex) 
            {
                  print "ERROR11" . $ex -> getMessage();
            }
        }
        return $entradas;
    }
    
    
}
?>

<!--SELECT * FROM entradas e JOIN usuarios u ON u.id = e.autor_id WHERE u.nombre LIKE 'nD8fZdFU18' ORDER BY e.fecha DESC LIMIT 25-->

<!--SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT (b.id) AS 'cantidad_comentarios'
FROM entradas a 
LEFT JOIN comentarios b ON a.id=b.entrada_id
WHERE a.autor_id = 1
GROUP BY a.id
ORDER BY a.fecha DESC-->