<?php
/**
 * User: ansaus
 * Date: 06.09.2021
 */

namespace app\models\TableGateways;


use app\models\services\PaginationService;

class BaseGateway implements BaseGatewayInterface
{
    protected $db = null;

    protected $tableName;

    /**
     * @var PaginationService
     */
    public $paginationService;

    public function __construct($db, $paginationService = null)
    {
        if (empty($this->tableName)) throw new \Exception('tableName is not set');
        $this->db = $db;
        $this->paginationService = $paginationService ?? new PaginationService();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function findAll($params = [])
    {
        $where = '';
        $statement = "
            SELECT 
                count(*)
            FROM
                {$this->tableName}
            $where
        ";

        try {
            $rowCount = $this->db->query($statement)->fetchColumn();
            $this->paginationService->setRowCount($rowCount);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        if ($this->paginationService->getLimit()) {
            $offset = '';

            $limit = ' limit '.intval($this->paginationService->getLimit());
            if ($this->paginationService->getOffset()) {
                $offset = ' offset '.intval($this->paginationService->getOffset());
            }

            $statement = "
            SELECT 
                *
            FROM
                {$this->tableName}
            $where
            $limit  
            $offset  
        ";
            try {
                $statement = $this->db->prepare($statement);
                $statement->execute();
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }

        } else {
            try {
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOne($id)
    {
        $statement = "
            SELECT 
                *
            FROM
                $this->tableName
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

    }

    /**
     * @param array $input as $input[$columnName] => $columnValue
     * @return mixed
     */
    public function insert(array $input)
    {
        $colNameStr = '';
        $colValStr = '';
        $arrValues = [];
        foreach ($input as $col => $value) {
            $colNameStr .= $col.',';
            $colValStr .= ':'.$col.',';
            $arrValues[$col] = $value;
        }
        $colNameStr = substr($colNameStr, 0, strlen($colNameStr)-1);
        $colValStr = substr($colValStr, 0, strlen($colValStr)-1);

        $statement = "
            INSERT INTO person 
                ($colNameStr)
            VALUES
                ($colValStr);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute($arrValues);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

    }

    /**
     * @param $id
     * @param array $input as $input[$columnName] => $columnValue
     * @return mixed
     */
    public function update($id, array $input)
    {
        $inputStr = $this->getInputUpdateStr($input);

        $statement = "
            UPDATE $this->tableName
            SET $inputStr 
            WHERE id = :id;
        ";
        $arrValues['id'] = (int) $id;
        foreach ($input as $col => $value) {
            $arrValues[$col] = $value;
        }
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute($arrValues);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $statement = "
            DELETE FROM $this->tableName
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

    }

    /**
     * @param array $input
     * @return bool|string
     */
    protected function getInputUpdateStr(array $input)
    {
        $result = '';

        foreach ($input as $col => $value) {
            $result .= $col.' = :'.$col.',';
        }
        $result = substr($result, 0, strlen($result)-1);

        return $result;
    }
}
