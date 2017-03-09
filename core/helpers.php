<?php

function view($file, $params){

    foreach($params as $key => $param){
        $$key = $param;
    }

    include('views/'.$file.'.php');

}