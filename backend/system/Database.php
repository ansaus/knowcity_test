<?php
/**
 * User: ansaus
 * Date: 05.09.2021
 */

namespace app\system;

class Database
{

    private $dbConnection = null;

    public function __construct(array $cfg = [])
    {
        try {
            $this->dbConnection = new \PDO(
                "mysql:host=".$cfg['host'].";port=".$cfg['port'].";charset=".$cfg['charset'].";dbname=".$cfg['name']."",
                $cfg['username'],
                $cfg['password']
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}
