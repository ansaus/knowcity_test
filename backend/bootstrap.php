<?php
/**
 * User: ansaus
 * Date: 05.09.2021
 */

use app\models\TableGateways\StudentGateway;
use app\system\Application;
use app\system\Database;

$loader = require 'vendor/autoload.php';
$loader->addPsr4('app\\', __DIR__);

$cfg = include("config/config.php");

$dbConnection = (new Database($cfg['db']))->getConnection();

$app = Application::getInstance();
$app->setConfig($cfg);
$app->setDb($dbConnection);
