<?php

function __autoload($class_name){
    if(file_exists( __DIR__.'/'.$class_name.'.php')) {
        require __DIR__ . '/' . $class_name . '.php';
    }
    elseif (file_exists(__DIR__.'/../Controllers/'.$class_name.'.php')){
        require __DIR__.'/../Controllers/'.$class_name.'.php';
    }
    elseif (file_exists(__DIR__.'/../Models/'.$class_name.'.php')){
    require __DIR__.'/../Models/'.$class_name.'.php';
}
}

