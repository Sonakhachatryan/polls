<?php

class DB
{
    protected $con;

    public function __construct(){
        $con = mysqli_connect("localhost", "root", "", "employee_cms");

        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $this->con = $con;
    }

}