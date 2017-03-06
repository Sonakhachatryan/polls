<?php

function view($file_path, $params){

    foreach($params as $key => $param){
        $$key = $param;
    }

    include('views/'.$file_path);

}