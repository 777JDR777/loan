<?php

    require_once "./config/app.php";
    require_once "./controllers/viewsController.php";

    #en esta variable vamos a instanciar el controlador
    $template = new viewsController();
    #ejecutamos la funcion getControllerTemplate
    $template-> getControllerTemplate();
