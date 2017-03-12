<?php

function view($file, $params = null){

    foreach($params as $key => $param){
        $$key = $param;
    }

    include('views/'.$file.'.php');

}