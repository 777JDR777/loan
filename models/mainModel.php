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
        
        /*--------- Funcion encriptar cadenas ---------*/
        #procesa por hast cualquier texto plano
        public function encryption($string){
            $output=FALSE;
            $key=hash('sha256', SECRET_KEY);
            $iv=substr(hash('sha256', SECRET_IV), 0, 16);
            $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
            $output=base64_encode($output);
            return $output;
        }
        /*--------- Funcion desencriptar cadenas ---------*/
        #esta devuelve de hast a un texto plano
        protected static function decryption($string){
            $key=hash('sha256', SECRET_KEY);
            $iv=substr(hash('sha256', SECRET_IV), 0, 16);
            $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
            return $output;
        }

        /*--------- Funcion códigos aleatorios para los prestamos ---------*/
        protected static function generateRandomCode($letter,$length,$number){
            for($i=1; $i<=$length; $i++){
                $random= rand(0,9);
                $letter.=$random;
            }
            return $letter."-".$number;
        }

    }

   

