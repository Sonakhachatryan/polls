<?php
namespace Models;

class User extends DB
{

    private $tableName = 'users';

    public function __construct()
    {
        parent::__construct();
    }

}