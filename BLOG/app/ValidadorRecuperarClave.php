<?php

include_once 'app/repositorioUsuario.inc.php';
include_once "ValidadorRegistro.inc.php";

class ValidadorRecuperarClave
{

    private $aviso_inicio;
    private $aviso_cierre;
    
   
    private $password;
    

    private $error_clave1;
    private $error_clave2;
    
    public function __construct ($clave1, $clave2)
    {
        $this->aviso_inicio = "<br> <div class='alert alert-danger' role='alert'> ";
        $this->aviso_cierre = "</div>";

       
        $this->password = "";

       
        $this->error_clave1 = $this->validar_clave1($clave1);
        $this->error_clave2 = $this->validar_clave2($clave1, $clave2);
        
        if ($this -> error_clave1 === "" && $this -> error_clave2 === "")
        {
            $this -> password = $clave1;
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
        private function validar_clave1($clave1) {
        if (!$this->variable_iniciada($clave1)) {
            return "Has d'escriure una contrasenya.";
        }
        if (strlen($clave1) < 6) 
        {
            return "La contrasenya ha de ser més llarga de 6 caràcters.";
        }

        return "";
    }

    private function validar_clave2($clave1, $clave2) {
        if (!$this->variable_iniciada($clave1)) {
            return "Primer has d'escriure una contrasenya.";
        }

        if (!$this->variable_iniciada($clave2)) {
            return "Has de repetir la teva contrasenya.";
        }

        if ($clave1 !== $clave2) {
            return "Les dues contranseyes han de ser iguals.";
        }

        return "";
    }
    public function obtener_clave() {
        return $this->password;
    }
    public function obetener_error_clave1() {
        return $this->error_clave1;
    }

    public function obetener_error_clave2() {
        return $this->error_clave2;
    }
    
    public function mostrar_error_clave1() {
        if ($this->error_clave1 !== "") {
            echo $this->aviso_inicio . $this->error_clave1 . $this->aviso_cierre;
        }
    }
    
    public function mostrar_error_clave2() {
        if ($this->error_clave2 !== "") {
            echo $this->aviso_inicio . $this->error_clave2 . $this->aviso_cierre;
        }
    }
    
    public function registro_valido()
    {
        if ($this -> error_clave1 === "" && $this -> error_clave2 === "")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
}
            

?>

