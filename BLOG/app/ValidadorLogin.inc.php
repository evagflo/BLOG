<?php

include_once 'app/repositorioUsuario.inc.php';
include_once "ValidadorRegistro.inc.php";

class ValidadorLogin
{
    private $usuario;
    private $error;
    
    public function __construct ($email, $clave, $conexion)
    {
        $this -> error = "";
        if (!$this -> variable_iniciada($email) || !$this -> variable_iniciada($clave))
        {
            $this -> usuario =null;
            $this -> error = "Has dintroduir el teu email i contrasenya ";
        }
        else
        {
           $this -> usuario = repositorioUsuario::obtener_usuario_por_email($conexion,$email);// fos punts static function
            
            if (is_null($this->usuario) || !password_verify($clave, $this-> usuario -> obtener_password()))
            {
                $this -> error = "Dades incorrectes";
            }
            
        }
    }
        private function variable_iniciada($variable) 
        { // la variable s'ha completat?
        if (isset($variable) && !empty($variable)) {
            return true;
        } 
        else 
        {
            return false;
        }
    }
    
    public function obtener_usuario()
    {
        return $this -> usuario;
    }
    
    public function obtener_error()
    {
        return $this -> error;
    }
    
    public function mostrar_error()
    {
        if ($this -> error !== '')
        {
            echo " <br> <div class='aler alert-danger' role='alert'>";
            echo $this -> error;
            echo " </div> <br> ";
        }
        
    }
}
            

?>
