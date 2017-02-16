<?php


class DB extends PDO
{
    public $table;
    public $key;
    public $value;

    public function __construct($file = 'my_setting.ini')
    {
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');

        $dns = $settings['database']['driver'] .
            ':host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['schema'];

        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }

    public  function table($table){
        $this->table = $table;
        return $this;
    }

    public function where($key, $value){
        $this->key = $key;
        $this->value = $value;

        return $this;
    }

    public function get(){
       return $this->query("select * from users where email='dav.mnatsakanyan@gmail.com'");
    }

}