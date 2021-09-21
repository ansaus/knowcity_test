<?php
/**
 * User: ansaus
 * Date: 20.09.2021
 */

namespace app\models\services;


use app\controllers\ControllerInterface;

class BaseController implements ControllerInterface
{

    public function processRequest($requestMethod, $params = [])
    {

    }

    protected function foundResponse($data)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['data'] = json_encode($data);
        return $response;

    }

    protected function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['data'] = null;
        return $response;
    }

    protected function sendResponse($response) {
        header($response['status_code_header']);
        if ($response['data']) {
            echo $response['data'];
        }
        die();
    }

}
