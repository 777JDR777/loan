<?php

    const SERVER="127.0.0.1";
    const DB="loans";
    const USER="root";
    const PASS="";
    #conexion a base de datos
    const SGBD="mysql:host=".SERVER.";dbname=".DB;

    # variables para encriptar por hash contraseñas y otros parametros
    const METHOD="AES-256-CBC";
    #definiendo llave secreta SE LE coloca cualquier nombre en comillas simples
    const SECRET_KEY='$PRESTAMOS@2024';
    #identificador unico LAS VARIABLES DE ESTAS DOS CONTANTES NO SE PUEDEN CAMBIAR 
    #DESPUES DE QUE SE HAGA UN REGISTRO EN LA BASE DE DATOS
    const SECRET_IV='123654';
