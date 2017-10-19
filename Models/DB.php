<?php
namespace Models;

use PDO;
use Core\Config;

/**
 * Class DB
 * @package Models
 *
 * @property string $dsn
 * @property string $user
 * @property string $password
 * @property PDO $dbh
 * @property string $tableName
 */

class DB
{
    private $dsn;
    private $user;
    private $password;
    protected $dbh;

    private $tableName;

    public function __construct()
    {
        $db = Config::get('db');
        $this->dsn = "mysql:dbname=" . $db['dbName'] . ";host=" . $db['host'];
        $this->user = $db['user'];
        $this->password = $db['password'];
        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Failed to connect: ' . $e->getMessage();
        }
    }

    /**
     * Get all the records from table
     *
     * @return array
     */
    public function all()
    {
        $sql = "SELECT * FROM $this->tableName";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();

        return $res;
    }
}