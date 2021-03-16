<?php



class repositorioUsuario
{
    public static function obtener_todos($conexion)
    {
        $usuarios= array();
        if (isset($conexion))
        {
            
            try
            {
              
               include_once 'Usuari.inc.php'; 
               $sql= "SELECT * FROM usuarios";
               $sentencia = $conexion-> prepare($sql); // treure caracters estranys com #' i coses daquestes q permetrien hackejar
               $sentencia -> execute();
               $resultado= $sentencia -> fetchAll();
               
               
               if (count($resultado))// comporvar que hi ha usuaris
               {
                    
                 
                   foreach($resultado as $fila)
                   {
                       
                       $usuarios[]=new Usuari(
                               $fila['id'],$fila['nombre'],
                               $fila['email'],$fila['password'],
                               $fila['data_registre'], $fila['activo']);
                       
                    } 
                    
               }
                 
               else
                {
                  //  print ' No hi ha usuaris';
                }  
            
 

            } 
            
            catch (PDOException $ex) 
            {
                print "ERROR1". $ex -> getMessage();
            }
           
        }
        
      
         RETURN $usuarios;  
         
    }
    
   public static function obtener_numero_usuarios ($conexion)
   {
       $total_usuarios=null;
       if (isset($conexion))
       {
           try
           {
              $sql= 'SELECT COUNT(*) as total FROM usuarios';
              $sentencia = $conexion -> prepare($sql);
              $sentencia -> execute();
              $resultado= $sentencia -> fetch();
              
              $total_usuarios =$resultado['total'];
           } catch (PDOException $ex) {
                print "ERROR2". $ex -> getMessage();
           }
       }
       return $total_usuarios;
   }
   
   public static function insertar_usuario($conexion, $usuario)
   {
       $usuario_insertado = false;    
       if (isset ($conexion))
       {
           
           try {
              
               $sql= "INSERT INTO usuarios(nombre, email, password, fecha_registro, activo) VALUES (:nombre, :email, :password, NOW(), 0)";
               $sentencia= $conexion -> prepare($sql);
               $nombre = $usuario ->obtener_nombre();
               $email = $usuario ->obtener_email();
               $password = $usuario ->obtener_password();   
 
              
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->bindParam(':password', $password, PDO::PARAM_STR);
                       
               $usuario_insertado = $sentencia -> execute();
            
           } 
           catch (PDOException $ex) 
           {
               print "ERROR3". $ex -> getMessage();
           }
       }
       return  $usuario_insertado;
   }

    public static function nombre_existe($conexion,$nombre)
    {
        $nombre_existe=true;
               
        if (isset($conexion))
        {
            try
            {
                
                $sql= "SELECT * FROM usuarios WHERE nombre = :nombre";
                $sentencia= $conexion-> prepare($sql);
                              
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado= $sentencia -> fetchAll();//execute();
                
                if (count($resultado))
                {
                    $nombre_existe=true;
                }
                else
                {
                    $nombre_existe=false;
                }
            } 
            catch (PDOException $ex) 
            {
                print 'ERROR4' . $ex -> getMessage();
            }
        }
        return $nombre_existe;
    }
    
     public static function email_existe($conexion,$email)
    {
        $email_existe=true;
        
        if (isset($conexion))
        {
            try
            {
                $sql= "SELECT * FROM usuarios WHERE email = :email";
                $sentencia= $conexion-> prepare($sql);
               
                $sentencia -> bindParam(':email',$email,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado= $sentencia -> fetchAll();//execute();
                
                if (count($resultado))
                {
                    $email_existe=true;
                }
                else
                {
                    $email_existe=false;
                }
            } 
            catch (PDOException $ex) 
            {
                print 'ERROR5' . $ex -> getMessage();
            }
        }
        return $email_existe;
    }
    
    public static function obtener_usuario_por_email($conexion, $email)
    {
       
        $usuario=null;
        
        if (isset($conexion))
        {
           
            try
            {
                include_once 'app/Usuari.inc.php';
                
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $sentencia= $conexion-> prepare($sql);
                $sentencia -> bindParam(':email',$email,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado= $sentencia -> fetch();//execute();
                
               
                if (!empty($resultado))
                {
                    $usuario = New Usuari ( $resultado['id'],
                            $resultado['nombre'],
                            $resultado['email'],
                            $resultado['password'],
                            $resultado['fecha_registro'],
                            $resultado['activo']);
                }
                
                
            } catch (PDOException $ex) 
            {
                echo 'ERROR6'. $ex->getMessage();
            }
        }
        return $usuario;
    }
    
    public static function obtener_usuario_por_id($conexion, $id)
    {
        $usuario=null;
        
        if (isset($conexion))
        {
            try
            {
                include_once 'app/Usuari.inc.php';
                
                $sql = "SELECT * FROM usuarios WHERE id = :id";
                $sentencia= $conexion-> prepare($sql);
                $sentencia -> bindParam(':id',$id,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado= $sentencia -> fetch();//execute();
                
               
                if (!empty($resultado))
                {
                    
                    $usuario = New Usuari ( $resultado['id'],
                            $resultado['nombre'],
                            $resultado['email'],
                            $resultado['password'],
                            $resultado['fecha_registro'],
                            $resultado['activo']);
                }
                
                
            } catch (PDOException $ex) 
            {
                echo 'ERROR6'. $ex->getMessage();
            }
        }
        return $usuario;
    }
    
    public static function actualizar_clave($conexion, $id_usuario,$clave)
    {
        
        $actualizacion_correcta=false;
        if(isset($conexion))
        {
            try 
            {
              
              $sql = "UPDATE usuarios SET password = :clave WHERE id = :id"  ;
              $sentencia= $conexion-> prepare($sql);
              
              $sentencia -> bindParam(':id',$id_usuario,PDO::PARAM_STR);
              $sentencia -> bindParam(':clave',$clave,PDO::PARAM_STR);
              
              $sentencia -> execute();
              $resultado= $sentencia -> rowCount();/// quantes files d la taula shan actualitzat
              
              
              if (count($resultado))
              {
                  echo count($resultado);
                  $actualizacion_correcta=true;
              }
              else
              {
                  $actualizacion_correcta=false;
              }
              
            } 
            catch (PDOException $ex) 
            {
                echo 'ERROR16'. $ex->getMessage();
            }
        }
        
        return $actualizacion_correcta;
    }
    
    
    public static function actualizar_clave_borrar_url($conexion, $id_usuario,$clave,$url_secreta)
    {
        
        $actualizacion_correcta=false;
        if(isset($conexion))
        {
            try 
            {
              $conexion -> beginTransaction(); //conjunt doperacions que es realitzen totes a lhora, pero que si no fem comit no es realitzen
            
              $sql1 = "UPDATE usuarios SET password = :clave WHERE id = :id"  ;
              $sentencia1= $conexion-> prepare($sql1);
              
              $sentencia1 -> bindParam(':id',$id_usuario,PDO::PARAM_STR);
              $sentencia1 -> bindParam(':clave',$clave,PDO::PARAM_STR);
              
              $sentencia1 -> execute();
              
              $sql2 = "DELETE FROM recuperacion_clave WHERE url_secreta = :url_secreta"  ;
              $sentencia2= $conexion-> prepare($sql2);
              
              
              $sentencia2 -> bindParam(':url_secreta',$url_secreta,PDO::PARAM_STR);
              
              $sentencia2 -> execute();
              
              if ($conexion -> commit())
              {
                  $actualizacion_correcta=true;
              }
              else
              {
                  $actualizacion_correcta=false;
              }
              
            } 
            catch (PDOException $ex) 
            {
                $conexion -> rollBack(); //tornar a enrere si alguna cosa no ha sortit be
            }
        }
        
        return $actualizacion_correcta;
    }
}

?>
