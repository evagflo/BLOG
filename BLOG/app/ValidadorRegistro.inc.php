<?php

include_once "repositorioUsuario.inc.php";


class ValidadorRegistro {
  
    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;
    private $email;
    private $password;
    
    private $error_nombre;
    private $error_email;
    private $error_clave1;
    private $error_clave2;

    public function __construct($nombre, $email, $clave1, $clave2 ,$conexion) {
        $this->aviso_inicio = "<br> <div class='alert alert-danger' role='alert'> ";
        $this->aviso_cierre = "</div>";

        $this->nombre = "";
        $this->email = "";
        $this->password = "";

        $this->error_nombre = $this->validar_nombre($conexion,$nombre);
        $this->error_email = $this->validar_email($conexion,$email);
        $this->error_clave1 = $this->validar_clave1($clave1);
        $this->error_clave2 = $this->validar_clave2($clave1, $clave2);
        
        if ($this -> error_clave1 === "" && $this -> error_clave2 === "")
        {
            $this -> password = $clave1;
        }
    }

    private function variable_iniciada($variable) { // la variable s'ha completat?
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_nombre($conexion,$nombre) {
        
        if (!$this->variable_iniciada($nombre)) 
        { // nom == buit
            return "Has d'escriure un nom d'usuari.";
        } else 
        {
            $this->nombre = $nombre;
        }
        if (strlen($nombre) < 6) 
        {
            return "El nom ha de ser més llarg de 6 caràcters.";
        }
        if (strlen($nombre) > 24) 
        {
            return "El nom no pot  ser més llarg de 24 caràcters.";
        }
        
       
        if (repositorioUsuario:: nombre_existe($conexion,$nombre))
        {
            return "Aquest nom d'usuari ja està en us, sisplau prova un altre nom.";
        }
        
        return "";
        
        
        
    }
    

    private function validar_email($conexion,$email) {
        if (!$this->variable_iniciada($email)) {
            return "Has d'escriure un email.";
        } else {
            $this->email = $email;
        }
        
        if (repositorioUsuario:: email_existe ($conexion,$email))
        {
            return "Aquest email ja està en us, sisplau prova un altre o <a href '#'> recupera la contrasenya</a>.";
        }
        
        return "";
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

    //GETTERS per obtenir dades privades des de fora pero sense poderles modificar

    public function obtener_nombre() {
        return $this->nombre;
    }

    public function obtener_email() {
        return $this->email;
    }
    
    public function obtener_clave() {
        return $this->password;
    }

    public function obetener_error_nombre() {
        return $this->error_nombre;
    }

    public function obetener_error_email() {
        return $this->error_email;
    }

    public function obetener_error_clave1() {
        return $this->error_clave1;
    }

    public function obetener_error_clave2() {
        return $this->error_clave2;
    }

    public function mostrar_nombre() {
        if ($this->nombre !== "") {
            echo 'value="' . $this->nombre . '"';
        }
    }

    public function mostrar_error_nombre() {
        if ($this->error_nombre !== "") {
            echo $this->aviso_inicio . $this->error_nombre . $this->aviso_cierre;
        }
    }
    
    public function mostrar_email() {
        if ($this->email !== "") {
            echo 'value="' . $this->email . '"';
        }
    }
    
    public function mostrar_error_email() {
        if ($this->error_email !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
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
        if ($this -> error_nombre === "" && 
                $this -> error_email === "" && 
                $this -> error_clave1 === "" && 
                $this -> error_clave2 === "")
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