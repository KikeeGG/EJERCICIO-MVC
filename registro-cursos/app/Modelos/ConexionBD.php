<?php
    class ConexionBD{
        private static $conexion=null;
        public static function obtenerConexion(){
            if(self::$conexion===null){
                $host="localhost";
                $baseDatos="formacion";
                $usuario="root";
                $password="curso";

                try{
                    $dsn="mysql:host=$host;dbname=$baseDatos;cherset=utf8mb4";
                    self::$conexion=new PDO($dsn, $usuario, $password);
                    //LOS ERRORES SQL LANCEN EXCEPCIONES
                    self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    die("Error deconexion con la base de datos.");
                }
            }
            return self::$conexion;
        }
    }
?>