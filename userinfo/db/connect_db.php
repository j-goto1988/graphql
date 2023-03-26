<?php
namespace GraphQL\userinfo\db;

class connect_db {

    protected $dbh = '';

    public function __construct() {
        $dsn = '';
        $user = '';
        $password = '';
        try {
            $this->dbh = new \PDO($dsn, $user, $password);
        } catch (\PDOException $e) {
            echo '接続失敗';
            exit();
        }
    }
}

