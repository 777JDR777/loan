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

        /*--------- Funcion para limpiar comentarios ---------*/
        #funcion para quitar cadenas y evitar inyeccion sql
        protected static function cleanString($string){
            # con esta funcion vamos a colcar de primero el parametro que queremos buscas
            #que seria <scrip> y lo segundo por que lo queremos reemplazar y tercero a donde lo vamosa  aalmacenar 
            $chain=str_ireplace("<script>", "", $string);
            $chain=str_ireplace("</script>", "", $string);
            $chain=str_ireplace("</script src", "", $string);
            $chain=str_ireplace("</script type=", "", $string);
            $chain=str_ireplace("SELECT * FROM", "", $string);
            $chain=str_ireplace("DELETE FROM", "", $string);
            $chain=str_ireplace("INSERT INTO", "", $string);
            $chain=str_ireplace("DROP TABLE", "", $string);
            $chain=str_ireplace("DROP DATA BASE", "", $string);
            $chain=str_ireplace("TRUNCATE TABLE", "", $string);
            $chain=str_ireplace("SHOW TABLES", "", $string);
            $chain=str_ireplace("SHOW DATABASES", "", $string);
            $chain=str_ireplace("UPDATE", "", $string);
            $chain=str_ireplace("<?php", "", $string);
            $chain=str_ireplace("?>", "", $string);
            $chain=str_ireplace("--", "", $cstring;
            $chain=str_ireplace(">", "", $string);
            $chain=str_ireplace("<", "", $string);
            $chain=str_ireplace("[", "", $string);
            $chain=str_ireplace("]", "", $string);
            $chain=str_ireplace("^", "", $string);
            $chain=str_ireplace("==", "", $string);
            $chain=str_ireplace(";", "", $string);
            $chain=str_ireplace("::", "", $string);
            #con esta funcion elimina las flecas invertidas
            $chain=stripslashes($string);
            #la funcion trim quita el espacio antes o despues cuando el usuario lo digita en el formulario
            $chain=trim($string);
        }

        /*--------- Funcion para verificar datos ---------*/
        protected static function verifyData($string,$filter){
            #la funcion preg_match  donde el filtro realiza tiene las reglas
            #de comportamiento para el input y el string es lo que llega y lo valida el filtro 
            if(preg_match("/^".$filter0."$/",$string)){
                return false;
            }else{
                return true;
            }
        }

        /*--------- Funcion para verificar fechas ---------*/
        protected static function verifyDate($date){
            #la funcion eexplde divide un caracter en varios string
            $values=explode('-',$date);
            #siteiene los tres valosres y es una fecha validad retorne false
            if (count($values)==3 && checkdate($values[1],$values[2],$values[0])) {
               return false;
            #pero si no conincide sinfifica que si es invalida la fecha
            } else {
                return true;
            }
            
        }




    }

   

