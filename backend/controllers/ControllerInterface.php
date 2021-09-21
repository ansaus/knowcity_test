<?php

namespace app\controllers;

interface ControllerInterface
{
    public function processRequest($requestMethod, $params = []);
}
