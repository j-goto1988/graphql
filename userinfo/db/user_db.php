<?php
namespace GraphQL\userinfo\db;

require_once(dirname(__FILE__).'/connect_db.php');

use GraphQL\userinfo\db\connect_db;


class user_db extends connect_db {
    public int $id;
    public string $name;
    public int $age;
    public string $comment;
    public bool $active_flg;

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $sql = 'SELECT * FROM user';
        $prepare = $this->dbh->prepare($sql);
        $prepare->execute();
        $ret = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return $ret;
    }

    public function get_by_id($id) {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $prepare = $this->dbh->prepare($sql);
        $prepare->bindValue(':id', $id, \PDO::PARAM_INT);
        $prepare->execute();
        $ret = $prepare->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($ret))
        {
            return [];
        }

        return $ret[0];
    }

    public function add($name, $age, $comment, $active_flg) {
        $sql = 'INSERT INTO user (name, age, comment, active_flg, created_at, updated_at) VALUES(:name, :age, :comment, :active_flg, :created_at, :updated_at)';
        $prepare = $this->dbh->prepare($sql);
        $prepare->bindValue(':name', $name, \PDO::PARAM_STR);
        $prepare->bindValue(':age', $age, \PDO::PARAM_INT);
        $prepare->bindValue(':comment', $comment, \PDO::PARAM_STR);
        $prepare->bindValue(':active_flg', $active_flg, \PDO::PARAM_INT);
        $now = date('Y-m-d H:i:s');
        $prepare->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $prepare->bindValue(':updated_at', $now, \PDO::PARAM_STR);
        $ret = $prepare->execute();
        if ($ret !== true) {
            return false;
        }

        $id = $this->dbh->lastInsertId();
        if ($id === false) {
            return false;
        }

        return (int)$id;
    }

    public function edit($id, $name = null, $age = null, $comment = null, $active_flg = null) {
        $update_sql = '';

        if (isset($name)) {
            $update_sql .= 'name = :name,';
        }
        if (isset($age)) {
            $update_sql .= 'age = :age,';
        }
        if (isset($comment)) {
            $update_sql .= 'comment = :comment,';
        }
        if (isset($active_flg)) {
            $update_sql .= 'active_flg = :active_flg,';
        }

        if (empty($update_sql)) {
            return false;
        }
        $update_sql .= 'updated_at = :updated_at';

        $sql = 'UPDATE user SET '.$update_sql.' WHERE id = :id';
        $prepare = $this->dbh->prepare($sql);
        $prepare->bindValue(':id', $id, \PDO::PARAM_INT);

        if (isset($name)) {
            $prepare->bindValue(':name', $name, \PDO::PARAM_STR);
        }
        if (isset($age)) {
            $prepare->bindValue(':age', $age, \PDO::PARAM_INT);
        }
        if (isset($comment)) {
            $prepare->bindValue(':comment', $comment, \PDO::PARAM_STR);
        }
        if (isset($active_flg)) {
            $prepare->bindValue(':active_flg', $active_flg, \PDO::PARAM_INT);
        }

        $now = date('Y-m-d H:i:s');
        $prepare->bindValue(':updated_at', $now, \PDO::PARAM_STR);
        $ret = $prepare->execute();
        if ($ret !== true) {
            return false;
        }

        return true;
    }
}

