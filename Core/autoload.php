<?php

function __autoload($class_name){
    $fileName = __DIR__.'/../'.$class_name.'.php';
    $fileName = str_replace('\\','/',$fileName);
    if(file_exists( $fileName)) {
        require $fileName;
    }else{
        throw new Exception($fileName . ' not found',404);
    }

}

