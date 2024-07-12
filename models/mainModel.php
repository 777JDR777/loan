<?php
    #vamos a verificar si estamos haicendo una condiconal jax
    #si es una peticion ajax va a ser true quiere decir que los archivos que incluimos estan en la carpetaajax
    if($ajaxRequest){
        require_once "../config/server.php";
    #cuando no es una peticion ajax vamos ahacerlo desde index.php por eso ponemos ./
    }else{
        require_once "./config/server.php";
    }


    #esta clase va atener funciones como conexion a la base de datos
    #querys y prevenccion a inyeccion sql otra para peinadores etc
    /*--------- Modelo para obtener lconectar a la base de datos-----------*/
    class mainModel{

        /*--------- Funcion para conectar a la base de datos-----------*/
        protected static function connect(){
            #se intancia en el objeto connnectio la clase PDO y se traen los parametros
            # de conexcion que tenemos en el archivo server.php
            $conecction = new PDO(SGBD, USER, PASS);
            #este comando hace que en nuestra base de datos podamos tener Ññs
            $conecction->exec("SET CHARACTER SET utf8");
            return $conecction;
        }

        /*--------- Funcion para ejecutar consulta siemple----------*/
        protected static function runSimpleQuery($query){
            #CON SELF accedemos a un metodo o funcion statica padre
            $sql=self::connect()->prepare($query);
            $sql->execute();
            return $sql;
        }
    }

