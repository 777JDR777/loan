<?php

    class viewsModel{
        /*--------- Modelo para obtener las vistas -----------*/
        #todos los modelos van a ser protegidos es decir solamente
        #se van a poder ejecutar en las mismas clases y/o en clases que hereden
        protected static function getViewsModel($view){

            #vamos a crear una lista blanca de palabras que se pueden llamar en la url
            $whiteList=["home","clientList","clientNew","clientSearch","clientUpdate","company",
            "itemList","itemNew","itemSearch","itemUpdate","loanList","loanNew","loanReservation",
            "loanPending","loanSearch","loanUpdate","userList","userNew",
            "userSearch","userUpdate"];
            if(in_array($view, $whiteList)){
                if(is_file("./views/contents/".$view."View.php")){
                    $content="./views/contents/".$view."View.php";
                }else{
                    $content="404";
                }
            }elseif($view=="login" || $view=="index"){
                $content="login";
            }else{
                $content="404";
            }
            return $content;
        }
    }