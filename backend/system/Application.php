<?php
/**
 * User: ansaus
 * Date: 05.09.2021
 */

namespace app\system;

/**
 * Application singleton class
 */
class Application
{
    private static $instance;

    private $config;
    private $db;

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config): void
    {
        $this->config = $config;
    }

    /**
     * @return \PDO || mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->db = $db;
    }

    protected function __construct() { }

    public static function getInstance() {
        if (!self::$instance) {
            // new self() will refer to the class that uses the trait
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __clone() { }
    protected function __sleep() { }
    protected function __wakeup() { }

}
