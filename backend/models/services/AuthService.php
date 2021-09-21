<?php
/**
 * User: ansaus
 * Date: 20.09.2021
 */

namespace app\models\services;


use app\models\TableGateways\ApiUserGateway;
use app\system\Application;

class AuthService
{
    private $apiUserGateway;

    public function __construct($db = null)
    {
        $db = (!$db) ? Application::getInstance()->getDb() : $db;
        $this->apiUserGateway = new ApiUserGateway($db);
    }

    public function authenticate($input)
    {
        if (isset($input['api_key']) && strlen($input['api_key'])) {
            return $this->apiUserGateway->authByToken($input['api_key']);
        } else {
            return $this->apiUserGateway->auth($input['username'], $input['password']);
        }
    }
}
