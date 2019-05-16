<?php

    session_start();  //bootstrap moet sessie hebben om te zien of er een sessie lopende is.
    
    spl_autoload_register(function ($class) {
        require_once __DIR__.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$class.'.class.php';
    });
