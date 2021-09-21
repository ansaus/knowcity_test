<?php
/**
 * User: ansaus
 * Date: 05.09.2021
 */

namespace app\system;

trait SingletonTrait {

    private $instance;

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
