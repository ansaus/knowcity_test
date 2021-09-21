<?php
namespace app\models\TableGateways;

class ApiUserGateway extends BaseGateway
{
    protected $tableName = 'api_users';

    public function auth($username, $password) {
        $statement = "
            SELECT 
                *
            FROM
                $this->tableName
            where username = ? and password = ?    
                ;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([
                $username,
                md5($password)
            ]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (isset($result[0])) {
                $row = $result[0];
                // generate token
                $token = $this->generateToken();
                $this->update($row['id'], ['token' => $token]);
                return [
                    'username' => $row['username'],
                    'token' => $token
                ];
            } else {
                return [];
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function authByToken($token) {
        $statement = "
            SELECT 
                *
            FROM
                $this->tableName
            where token = ?    
                ;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([
                $token,
            ]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (isset($result[0])) {
                $row = $result[0];
                return [
                    'username' => $row['username'],
                ];
            } else {
                return [];
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function generateToken() {
        return hash('sha256', uniqid());
    }
}
