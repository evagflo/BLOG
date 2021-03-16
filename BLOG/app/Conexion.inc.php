<?php

class Conexion {

    private static $conexion;

    // self:: serveix per cridar latribut
    //obrir connexio
    public static function abrir_conexion() {
        if (!isset(self::$conexion)) {//mirar si la conexio existeix

            try {

                include_once 'config.inc.php'; // same que copiar el text que tinc dins d'aquest arxiu
                self::$conexion = //new PDO(mysql:host=localhost ;dbname=blog, eva, eva);
                                new PDO('mysql:host=localhost;dbname=blog', 'eva', 'eva');
                ////new PDO('mysql:host='.NOMBRE_SERVIDOR.'; dbname='.NOMBRE_DB, NOMBRE_USUARIO, PASSWORD);
// mysqli nomes treballa amb la database de mysql
// pdo treballa amb mes database
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //que ens mostren els errors
                self::$conexion->exec("SET CHARACTER SET utf8");

               // echo "Conexio oberta" . "<br>";
            } catch (PDOException $ex) {
                print "ERROR: " . $ex->getMessage() . "<br>";
                die();
            }
        }
    }

    //tancar connexio
    public static function cerrar_conexion() {
        if (isset(self::$conexion)) {
            self::$conexion = null;
           // echo "Conexio tancada" . "<br>";
        }
    }

    public static function obtener_conexion() {
        return self::$conexion;
    }

}
