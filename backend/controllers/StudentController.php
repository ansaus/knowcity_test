<?php
namespace app\controllers;

use app\models\services\AuthService;
use app\models\services\BaseController;
use app\models\TableGateways\StudentGateway;
use app\system\Application;

class StudentController extends AuthController
{
    private $studentGateway;

    public function __construct($db = null)
    {
        parent::__construct($db);
        $db = (!$db) ? Application::getInstance()->getDb() : $db;
        $this->studentGateway = new StudentGateway($db);
    }

    public function processRequest($requestMethod, $params = [])
    {
        $checkAuthResult = $this->checkAuth();

        if (!$checkAuthResult['status']) {
            $this->sendResponse($this->foundResponse($checkAuthResult));
        }

        switch ($requestMethod) {
            case 'GET':
                $response = $this->getAllUsers();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        $this->sendResponse($response);
    }

    private function getAllUsers()
    {
        $params = $_GET;
        if (!isset($params['page'])) {
            $page = 1;
        } else {
            $page = intval($params['page']);
        }
        $this->studentGateway->paginationService->setCurrentPage($page);
        $result = $this->studentGateway->findAll($params);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['data'] = json_encode(array_merge(['rows' => $result], [
            'currentPage' => $this->studentGateway->paginationService->getCurrentPage(),
            'pageCount' => $this->studentGateway->paginationService->getPageCount(),
            'rowCount' => $this->studentGateway->paginationService->getRowCount(),
            'status' => 1
        ]));
        return $response;
    }

}
