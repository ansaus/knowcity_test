<?php
namespace app\controllers;

use app\models\services\AuthService;
use app\models\services\BaseController;
use app\system\Application;

class AuthController extends BaseController
{
    private $authService;

    public function __construct($db = null)
    {
        $db = (!$db) ? Application::getInstance()->getDb() : $db;
        $this->authService = new AuthService($db);
    }

    public function processRequest($requestMethod, $params = [])
    {
        switch ($requestMethod) {
            case 'GET':
            case 'POST':
                $response = $this->authUser();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        $this->sendResponse($response);
    }

    protected function checkAuth() {
        $input = $_REQUEST;
        $status = 0;
        if (!$result = $this->authService->authenticate($input)) {
            $msg = 'Invalid credentials';
        } else {
            $msg = 'Successful login';
            $status = 1;
        }
        return array_merge($result, ['msg' => $msg, 'status' => $status]);
    }

    protected function authUser()
    {
        return $this->foundResponse($this->checkAuth());
    }

}
