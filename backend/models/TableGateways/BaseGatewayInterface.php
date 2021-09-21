<?php
/**
 * User: ansaus
 * Date: 06.09.2021
 */

namespace app\models\TableGateways;


interface BaseGatewayInterface
{
    public function findAll($params = []);
    public function findOne($id);
    public function insert(array $input);
    public function update($id, array $input);
    public function delete($id);
}
