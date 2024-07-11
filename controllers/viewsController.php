<?php
    # va a ser requerido una vez el archivo para poder heredarlo
    require_once "./models/viewsModel.php";
    
    class viewsController extends viewsModel{
        /*--------- Controlador para obtener plantillas template-----------*/
        #todos los controladores van aser prublicos para acceder fuera de las clases
        #heredadas 
        public function getControllerTemplate(){
            return  require_once "./views/template.php";
        }

        /*--------- Controlador para obtener vistas----------*/

        public function getControllerViews(){
            #vamos a comprovar si viene la variable en la url
            #si existe views
            if(isset($_GET['views'])){
                #la variable routa antepone / y tra el nombre que tra e esa ruta
                $route=explode("/",$_GET['views']);
                #en la variable  answer  llama el modelo viweaMOdel y la funcions
                #getviewsModl y le pone el parametro $route
                $answer=viewsModel::getViewsModel($route[0]);
            }else{
                $answer="login";
            }
            return $answer;
        }

    }