<?php

function __autoload($class_name){

    if(file_exists( __DIR__.'/../'.$class_name.'.php')) {
        require __DIR__.'/../'.$class_name.'.php';
    }else{
        throw new Exception('File ' . __DIR__.'/../'.$class_name .'.php not found',404);
    }

}

